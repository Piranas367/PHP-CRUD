<?php
    require('config.php');
    session_start();
    if(isset($_SESSION['gebruiker_id'])){
        session_unset();
    }
    
    //gebruiken laten inloggen
    if (isset($_POST['Login'])) {
        $email         = $_POST['email'];
        $password      = $_POST['password'];
        $sql           = "SELECT * FROM Gebruiker WHERE email = ? ";
        $stmt          = $conn->prepare($sql);
        $stmt->bind_param("s", $email); 
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {    
            while ($row = $result->fetch_assoc()) {
                if (password_verify($password, $row['wachtwoord'])) { 
                    $_SESSION['gebruiker_id'] = $row['id'];
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Je wachtwoord en of email is onjuist";
                }
            }
        } 
        $stmt->close();
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="inlogpagina.css">
</head>
<body>
<div class="login-container">
    <h1>Log hier in</h1>
    <form action="inlogpagina.php" method="post">
        <div class="input-group">
            <input type="email" id="email" name="email" required>
            <label for="email">Email Address</label>
        </div>
        <div class="input-group">
            <input type="password" id="password" name="password" required>
            <label for="password">Password</label>
        </div>
        <button type="submit" name="Login">Login</button>
    </form>
    <div class="signup">
        Ben je nieuw? <a href="aanmeldingsformulier.php">Maak hier een nieuwe account aan</a>
    </div>
</div>
</body>
</html>



<?php
    require_once('config.php');
    if (isset($_POST['create'])){
        $name           = $_POST['name'];
        $achternaam     = $_POST['achternaam'];
        $email          = $_POST['email'];
        $password       = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO Gebruiker (naam, achternaam, email, wachtwoord) VALUES (?, ?, ?, ?)";
        $stmtinsert = $conn->prepare($sql);
        $stmtinsert->bind_param("ssss", $name, $achternaam, $email, $password);
        if ($stmtinsert->execute()) {
            echo "Gebruiker is nu opgeslagen";
        } else {
            echo "Er is iets mis gegaan";
        }
    }
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aanmeldingsformulier</title>
    <link rel="stylesheet" href="inlogpagina.css">
</head>
<body>
    <div>
    </div>
    <form action="inlogpagina.php" method="post">
        <div class="login-container">
            <h1 class="h1">Meld je hier aan</h1>
            <div class="input-group">
                <input type="name" id="name" name="name" required>
                <label for="name">Typ je naam</label>
            </div>
            <div class="input-group">
                <input type="achternaam" id="achternaam" name="achternaam" required>
                <label for="achternaam">Typ je achternaam</label>
            </div>
            <div class="input-group">
                <input type="email" id="email" name="email" required>
                <label for="email">Voer hier je e-mail adres</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" required>
                <label for="password">Voer hier je wachtwoord in</label>
            </div>
            <div class="input-group">
                <input type="password" id="password_confirm" name="password_confirm" required>
                <label for="password_confirm">Vul het opnieuw in</label>
            </div>
            <div id="Mydiv">
                <input type="submit" name="create" value="Sign up">
            </div>
            <div class="signup">
                Heb je al een account? <a href="inlogpagina.php">Ga terug naar login scherm.</a>
            </div>
        </div>
    </form>
    <script src="app.js"></script>
</body>
</html>

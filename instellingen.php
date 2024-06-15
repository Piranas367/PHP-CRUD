<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_changes'])) {
    $name           = $_POST['name'];
    $achternaam     = $_POST['achternaam'];
    $email          = $_POST['email'];
    $password       = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql        = "UPDATE Gebruiker SET naam=?, achternaam=?, email=?, wachtwoord=? WHERE email=?";
    $stmt       = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $achternaam, $email, $password, $email);

    if ($stmt->execute()) {
        echo "Gegevens veranderd!";
    } else {
        echo "Je hebt iets fout gedaan (niet mijn schuld :))";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verwijder'])) {
    $name           = $_POST['name'];
    $achternaam     = $_POST['achternaam'];
    $email          = $_POST['email'];
    $password       = password_hash($_POST['password'], PASSWORD_DEAFULT);

    $sql            = "DELETE FROM Gebruiker WHERE email= ?";
    $stmt           = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $achternaam, $email, $password); 
   
    if ($stmt->execute()) {
        echo "Account verwijderd!";
    } else {
        echo "Je hebt iets fout gedaan (niet mijn schuld :))";
    }
}

$sql = "SELECT * FROM Gebruiker";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account instellingen</title>
    <link rel="stylesheet" href="instellingen.css">
    <script>
        function AanpasKnop() {
            const formElements = document.querySelectorAll('.form-group input');
            formElements.forEach(element => {
                element.removeAttribute('disabled');
            });
            document.getElementById('submit_changes').style.display = 'inline';
            document.getElementById('edit_button').style.display = 'none';
        }

         function verwijderAccount() {
                if (confirm("Weet je zeker dat je je account wilt verwijderen?")) {
                    document.getElementById('verwijderen').click();
            }};
    </script>
</head>
<header>
    <nav>
        <ul>
            <li><a href="instellingen.php">instellingen</a></li>
            <li><a href="index.php">homepagina</a></li>
        </ul>
    </nav>
</header>
<body>
<div class="container">
    <div class="sidebar">
        <ul>
            <li><a href="instellingen.php">Account instellingen</a></li>
        </ul>
    </div>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="content">' . "\n";
        echo '    <h2>Account Settings</h2>' . "\n";
        echo '    <form action="instellingen.php" method="post">' . "\n";
        echo '        <div class="form-group">' . "\n";
        echo '            <label for="name">Voornaam</label>' . "\n";
        echo '            <input type="text" id="name" name="name" value="'.$row['naam'].'" disabled>' . "\n";
        echo '        </div>' . "\n";
        echo '        <div class="form-group">' . "\n";
        echo '            <label for="achternaam">Achternaam</label>' . "\n";
        echo '            <input type="text" id="achternaam" name="achternaam" value="'.$row['achternaam'].'" disabled>' . "\n";
        echo '        </div>' . "\n";
        echo '        <div class="form-group">' . "\n";
        echo '            <label for="email">Email</label>' . "\n";
        echo '            <input type="email" id="email" name="email" value="'.$row['email'].'" disabled>' . "\n";
        echo '        </div>' . "\n";
        echo '        <div class="form-group">' . "\n";
        echo '            <label for="password">Wachtwoord</label>' . "\n";
        echo '            <input type="password" id="password" name="password" value="" disabled>' . "\n";
        echo '        </div>' . "\n";
        echo '          <input type="button" id="edit_button" value="Aanpassen" onclick="AanpasKnop()">' . "\n";
        echo '          <input type="submit" id="submit_changes" name="submit_changes" value="Toepassen" style="display:none">' . "\n";
        echo '              <input type="button" id="verwijder"  value="verwijder" onclick="verwijderAccount()">' . "\n";
        echo '              <input type="submit" id="verwijderen" name="verwijderen" value="verwijderen" style="display:none">' . "\n";
        echo '    </form>' . "\n";
        echo '</div>' . "\n";
    }
}
?>
</div>
</body>
</html>









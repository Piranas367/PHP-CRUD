<?php
session_start();
if(!isset($_SESSION['gebruiker_id'])){
    header("Location: inlogpagina.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tools for ever</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="instellingen.php">instellingen</a></li>
          <li><a href="index.php">homepagina</a></li>
          <li><a href="inlogpagina.php">LogIn Pagina</a></li>
        </ul>
      </nav>
    </header>
    <H1>Tools for ever digitale distrubutie</H1>
  </body>
</html>

 

















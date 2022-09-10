<?php

    require_once './includes/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ggGames</title>
</head>
<body>
    <h1>private</h1>
    <p>Bonjour <?=$_SESSION['user']->login?></p>
    <p>
        <a href="disconnect.php">Disconnect</a>
    </p>
</body>
</html> 
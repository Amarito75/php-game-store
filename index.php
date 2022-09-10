<?php

    include_once './includes/config.php';
    include_once './includes/handleForm.php';

    // // Fetch all games
    $query = $pdo->query('SELECT * FROM games');
    $games = $query->fetchAll();

    foreach($games as $_game)
    {
        $query = $pdo->query('SELECT * FROM comments WHERE id_game = ' . $_game->id);
        $comments = $query->fetchAll();
        $_game->comments = $comments;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>ggGames</title>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <nav>
                <ul>               
                    <li>
                        <a href="index.php">
                            <span class="material-symbols-outlined">home</span> 
                        </a>
                    </li>
                    <li>
                        <a href="login.php">
                            <span class="material-symbols-outlined">account_circle</span>
                        </a>
                    </li>
                    <li>
                        <span class="material-symbols-outlined">shopping_bag</span>                
                    </li>  
                </ul>
            </nav>							
        </div>
        <div class="game-container">
            <?php foreach($games as $_game) :?>
                    <div class="game-card">
                        <a href="game.php?id=<?=$_game->id?>">
                            <div class="game-image-container">
                                <img class="pictures" src="./assets/pictures/<?=$_game->thumbnail_path?>">
                                <h4><?=$_game->rating?></h4>
                            </div>
                            <h4 class="title"><?=$_game->title?></h4>
                            <h4 class="price"><?=$_game->price?> $</h4>
                        </a>
                    </div>
            <?php endforeach ?>   
        </div>
    </div>  
</body>
</html>
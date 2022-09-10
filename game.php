<?php

    require_once './includes/config.php';
    require_once './includes/handleForm.php';

    // Fetch all games
    $query = $pdo->query('SELECT * FROM games WHERE id = '.$_GET['id']);
    $games = $query->fetchAll();

    foreach($games as $_game)
    {
        //Fetch comments
        $query = $pdo->query('SELECT * FROM comments WHERE id_game = ' . $_game->id);
        $comments = $query->fetchAll();
        $_game->comments = $comments;
        
        // Fetch developers
        $query2 = $pdo->query('SELECT * FROM developers WHERE id = ' . $_game->developer_id);
        $developers = $query2->fetchAll();
        $_game->developers = $developers;

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/style/game.css" rel="stylesheet">
    <link href="./src/style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>ggGames</title>
</head>
<body>
    <div class="container">
        <div class="container-page">
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
            <?php foreach($games as $_game) :?>
                <div class="cover">
                    <img src="./assets/pictures/<?=$_game->cover_path?>">
                </div>
                <div class="game-boxes">
                    <div class="thumbnail-picture-boxes">
                        <img style="border-radius: 32px;" src="./assets/pictures/<?=$_game->thumbnail_path?>">
                    </div>
                    <div class="infos-boxes">
                        <h1 class="big-title"><?=$_game->title?></h1>
                        <h1 class="big-title" style="text-align: start;"><?=$_game->price?> $</h1>
                        <div class="misc">
                            <h1 class="rating" style="text-align: end;"><?=$_game->rating?>/10 ⭐ </h1>
                                <h1>Release : <?=date('Y-m-d', $_game->date)?></h1>
                        </div>
                        <?php foreach($_game->developers as $_developer): ?>
                            <div class="platforms">
                                <h1><?=$_game->platforms?></h1><p style="text-align: end;"><?=$_developer->name?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="infos">
                    <div class="description">
                        <h1>Description :</h1><br>
                        <p><?=$_game->description?></p>

                    </div>
                    <div class="comments">
                        <h1>Comments :</h1><br>
                        <?php foreach($_game->comments as $_comment): ?>
                            <p><?=nl2br($_comment->text)?></p>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>
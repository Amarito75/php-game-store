<?php

    require_once './includes/config.php';
    require_once './includes/handleForm.php';


    // if(!empty($_GET['delete']))
    // {
    //     $prepare = $pdo->prepare('DELETE FROM users WHERE id = :id');
    //     $prepare->bindValue('id', (int)$_GET['delete']);
    //     $prepare->execute();
    // }

    // $query = $pdo->query('SELECT id, login, age FROM users ORDER BY login ASC');
    // $users = $query->fetchAll();

    $errorMessages = [];

    if(!empty($_POST))
    {
        // Setup
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Fetch user matching login
        $prepare = $pdo->prepare('SELECT * FROM users WHERE login = :login');
        $prepare->execute([
            'login' => $login,
        ]);
        $user = $prepare->fetch();

        // User not found
        if(!$user)
        {
            $errorMessages[] = 'Login not found';
        }

        // User found
        else
        {
            $verified = password_verify($password, $user->password);

            if($verified)
            {
                // $errorMessages[] = 'Good password';
                $_SESSION['user'] = $user;
                header('Location:profile.php');
                exit;
            }
            else
            {
                $errorMessages[] = 'Wrong password';
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/style/style.css" rel="stylesheet">
    <link href="./src/style/formular.css" rel="stylesheet">
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
                        <a href="formular.php">
                            <span class="material-symbols-outlined">account_circle</span>
                        </a>
                    </li>
                    <li>
                        <span class="material-symbols-outlined">shopping_bag</span>                
                    </li>  
                </ul>
            </nav>							
        </div>
        <div class="sign-up">
            <form action="profile.php" method="post">
                <p>Create an account</p>
                <!-- Login -->
                <div class="form-field">
                        <input type="text" id="login" name="login" placeholder="Login" value="<?= $login ?>"><br>
                </div>

                <!-- Password -->
                <div class="form-field">
                        <input type="password" id="password" name="password" placeholder="Password" value="<?= $password ?>"><br>
                </div>

                <!-- Age -->
                <div class="form-field">
                        <input type="number" id="age" name="age" value="<?= $age ?>"><br>
                </div>

                <!-- Submit -->
                <input type="submit" value="Sign Up">
                
                <!-- Messages -->
                <?php if(!empty($errorMessages)): ?>
                    <div class="errors">
                        <?php foreach($errorMessages as $message): ?>
                            <p><?= $message ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</body>
</html>
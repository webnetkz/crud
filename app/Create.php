<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'DataBase.php';

$pdo = new DataBase();
$pdo->connectDatabase($_COOKIE['login'], $_COOKIE['pass']);


?>

<!DOCTYPE html>
<html lang="ru en">
    <head>
        <title>Create</title>

        <meta charset="UTF-8">
        <meta name="author" content="TOO "WebNet">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">

        <link rel="shortcut icon" href="/view/img/miniLogo.png" type="image/png">
        <link rel="stylesheet" href="/view/css/crudStyle.css">
        <link rel="stylesheet" href="/view/css/crudMobileStyle.css">
        
    </head>
    <body>

    <div id="menu">
        <nav class="menu">
            <a href="Create.php"><button class="menuButton first">Create</button></a>
            <a href="Read.php"><button class="menuButton">Read</button></a>
            <a href="Update.php"><button class="menuButton">Update</button></a>
            <a href="Delete.php"><button class="menuButton last">Delete</button></a>
        </nav>
    </div>

    <form action="Create.php" method="POST">
    
        <input type="submit" value="Create User" name="user" class="Rbutton"><hr>

<?php

////////////////////////////
////--- CREATE USERS ---////
////////////////////////////
        
    if(!empty($_POST['user'])) {

        echo '<input type="text" name="nameUser" placeholder="Create New User" autocomplete="off" class="inp"><br>';
        echo '<input type="password" name="passUser" placeholder="Password" class="inp"><br>';
        echo '<input type="submit" value="Create" class="button"><hr>';
    }

        if(!empty($_POST['nameUser']) && !empty($_POST['passUser'])) {

            $pdo->createUser($_POST['nameUser'], $_POST['passUser']);
            echo '<p class="Rtext">User created!</p>';
        }

        ?>    

        <input type="submit" value="Create Database" name="database" class="Rbutton"><hr>

<?php
        
////////////////////////////
////-- CREATE DATABASE -////
////////////////////////////      

    if(!empty($_POST['database'])) {
                    
        echo '<input type="text" name="nameDatabase" placeholder="Create New Database" autocomplete="off" class="inp"><br>';
        echo '<input type="submit" value="Create" class="button"><hr>';
    }

        if(!empty($_POST['nameDatabase'])) {
            $resultD = $pdo->createDatabase($_POST['nameDatabase']);

            if($resultD) {
                echo '<p class="Rtext">Database created!</p><hr>';
            }
        }

?>

        <input type="submit" value="Create New Table" name="table" class="Rbutton"><hr>

<?php

////////////////////////////
////--- CREATE TABLE ---////
////////////////////////////

    if(!empty($_POST['table'])) {
                        
        echo '<input type="text" name="nameTable" placeholder="Create New Table" autocomplete="off" class="inp"><br>';
        echo '<input type="text" name="base" placeholder="For Database" autocomplete="off" class="inp"><br>';
        echo '<input type="submit" value="Create" class="button"><hr>';
    }

        if(!empty($_POST['nameTable'])) {

            $pdo->useDatabase($_POST['base']);

            $pdo->createTable($_POST['nameTable']);
            echo '<p class="Rtext">Table created!</p><hr>';
        }

?>
        
    </form>

        <script type="text/javascript" src="/view/js/read.js"></script>
    </body>
</html>











<?php 

    $servername   = "127.0.0.1";
    $username = "root";
    $password = "kali";
    $db_name   = "first";

   $link = mysqli_connect($servername, $username, $password);

   if (!$link) {
	 die('Error:' . mysqli_connect());
    }


   $sql = "CREATE DATABASE IF NOT EXISTS $db_name";

    if (!mysqli_query($link, $sql)){
	 echo "Не удалось создать БД!";
    }

    mysqli_close($link);

    $link = mysqli_connect($servername, $username, $password, $db_name);

    $sql = "CREATE TABLE IF NOT EXISTS users(
	 id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	 username VARCHAR(50) NOT NULL,
	 email VARCHAR(50) NOT NULL,
	 pass VARCHAR(50) NOT NULL
    )";

    if (!mysqli_query($link, $sql)){
	    echo "Не удалось создать таблицу users!";
    }

    $sql = "CREATE TABLE IF NOT EXISTS posts(
	 id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	 title VARCHAR(50) NOT NULL,
	 main_text VARCHAR(400) NOT NULL,
	 image_path VARCHAR(100)
    )";

    if (!mysqli_query($link, $sql)){
	 echo "Не удалось создать таблицу posts!";
    }

    mysqli_close($link);
    
?>


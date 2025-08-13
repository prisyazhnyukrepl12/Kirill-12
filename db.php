<?php 
   $server   = "127.0.0.1";
   $username = "root";
   $password = "kali";
   $dbName   = "first";
   
   // Подключение без базы
   $link = mysqli_connect($server, $username, $password);
   if (!$link) {
       die("Error connect: " . mysqli_connect_error());
   }
   
   // Создаем БД
   $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
   if (!mysqli_query($link, $sql)) {
       echo "Error create DB: " . mysqli_error($link);
   }
   mysqli_close($link);
   
   // Подключаемся уже к БД
   $link = mysqli_connect($server, $username, $password, $dbName);
   
   // Создаем таблицу users
   $sql = "CREATE TABLE IF NOT EXISTS users(
       id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
       username VARCHAR(15) NOT NULL,
       email VARCHAR(50) NOT NULL,
       pass VARCHAR(20) NOT NULL
   ) ENGINE=InnoDB;";
   
   if (!mysqli_query($link, $sql)) {
       echo "Error create table users: " . mysqli_error($link);
   }
   
   // Создаем таблицу posts
   $sql = "CREATE TABLE IF NOT EXISTS posts(
       id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
       title VARCHAR(20) NOT NULL,
       main_text VARCHAR(400) NOT NULL
   ) ENGINE=InnoDB;";
   
   if (!mysqli_query($link, $sql)) {
       echo "Error create table posts: " . mysqli_error($link);
   }
   
   mysqli_close($link);
?>
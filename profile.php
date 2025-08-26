<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirill Prysyazhnyuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="log.webp" alt="logo" class="me-2">
                <span class="text-light">History</span>
            </a>
            <?php if (isset($_COOKIE['User'])): ?>
                <form action="/logout.php" method="POST" class="d-flex">
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form> 
            <?php endif; ?>       
        </div>
    </nav>

    <div class="container mt-5">
        <div class="story-container d-flex flex-column align-items-center">
            <div class="story-text mb-3 text-center">
                <p>
                    Well, Prince, so Genoa and Lucca are now just family estates of the Buonapartes. 
                    But I warn you, if you don't tell me that this means war, if you still try to 
                    defend the infamies and horrors perpetrated by that Antichrist.
                </p>
            </div>
            <img src="hecer.webp" alt="hecer" class="hacker-img mb-3">
            <button id="toggleButton" class="btn btn-primary">Open</button>
            <div class="mt-3" id="extraImage" style="display: none;">
                <img class="hacker-img" src="herp.webp" alt="head">
            </div>
        </div>

        <div class="mt-5">
            <h2 class="text-center mb-4">
                Add New Post <?php $username1 = $_COOKIE['User']; echo "$username1";?>
            </h2>
            <form action="profile.php" method="POST" id="postForm" class="d-flex flex-column gap-3" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label" for="postTitle">Post Title</label>
                    <input type="text" class="form-control hacker-input" name="postTitle" id="postTitle" placeholder="Enter post Title" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="postContent">Post Content</label>
                    <textarea name="postContent" id="postContent" rows="5" class="form-control hacker-input" placeholder="Enter post Content" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="file">Upload file</label>
                    <input type="file" name="file" class="form-control hacker-input" id="file">
                </div>
                <button class="btn btn-success" type="submit" name="submit">Save Post</button>
            </form>
        </div>
    </div>

    <script src="JS/script.js"></script>
</body>
</html>

<?php
// Проверка авторизации
if (!isset($_COOKIE['User'])) {
    header('Location: /login.php');
    exit();
}

require_once('db.php');

// Подключение к базе
$link = mysqli_connect('127.0.0.1', 'root', 'kali', 'first');
if (!$link) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($link, $_POST['postTitle']);
    $main_text = mysqli_real_escape_string($link, $_POST['postContent']);

    // Проверка заполненности
    if (!$title || !$main_text) die("⚠ Нет данных для добавления поста");

    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $main_text = htmlspecialchars($main_text, ENT_QUOTES, 'UTF-8');

    // SQL-запрос
    $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text')";
    if (!mysqli_query($link, $sql)) die("Ошибка вставки данных в таблицу");

    // Работа с файлом
    if (!empty($_FILES["file"]["name"])) {
        $errors = [];
        $allowedTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp'];
        $maxFileSize = 102400; // 100 KB

        // Проверка ошибок загрузки
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Ошибка загрузки: " . $_FILES['file']['error'];
        }
        // Проверка фактического размера файла
        $realFileSize = filesize($_FILES['file']['tmp_name']);
        if ($realFileSize > $maxFileSize) {
            $errors[] = "Файл превышает допустимый размер (100 KB)";
        }

        // Проверка MIME-типов через finfo
        $fileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['file']['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = "Недопустимый тип файла: $fileType";
        }
        // Если ошибок нет — сохраняем
        if (empty($errors)) {
            $tempPath = $_FILES['file']['tmp_name'];
            $destinationPath = 'upload/' . uniqid() . '_' . basename($_FILES['file']['name']);
            if (move_uploaded_file($tempPath, $destinationPath)) {
                echo 'Файл загружен: ' . $destinationPath;
            } else {
                $errors[] = 'Не удалось переместить файл';
            }
        }
        // Вывод ошибок
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
        }
    }
}
?>
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
        </div>
    </nav>
    <div class="container mt-5">
        <div class="story-container">
            <p>Well, Prince, so Genoa and Lucca are now just family estates of the Buonapartes. But I warn you, if you
                don't tell me that this means war, if you still try to defend the infamies and horrors perpetrated by
                that Antichrist.</p>
            <img src="hecer.webp" alt="hecer" class="hacker-img">
        </div>
        <div class="text-center mt-4"><button id="toggleButton" class="btn btn-primary">Open</button></div>
        <div class="mt-3 text-center" id="extraImage" style="display: none;"><img src="herp.webp" alt="head"
                class="hacker-ing"></div>
        <div class="mt-5">
            <h2 class="text-center mb-4">Add New Post</h2>
            <form action="profile.php" nethod="post" id="postForm" class="d-flex flex-column gap-3"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-lable" for="postTitle">Post Title</label><input type="text"
                        class="form-control hacker-input" name="postTitle" id="postTitle" placeholder="Enter post Title"
                        required>
                </div>
                <div class="form-group">
                    <label class="form-lable" for="postContent">Post Content</label>
                    <textarea type="text" name="postContent" id="postContent" rows="5" class="form-control-hacker-input"
                        placeholder="Enter post Content" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-lable" for="file">Upload file</label><input type="file" id="file" name="file"
                        class="form-control hacker-input">
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Save Post</button>
            </form>
        </div>
    </div>
    <script src="JS/script.js"></script>
</body>

</html>
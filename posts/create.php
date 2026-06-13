<?php
session_start();
require_once "../config/database.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    global $conn;
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    if(empty($title)){
    die("Title is required");
}

if(empty($content)){
    die("Content is required");
}

    $sql = "INSERT INTO posts(user_id, title, content)
            VALUES('$user_id', '$title', '$content')";

    if(mysqli_query($conn, $sql)){
        $message = "Post Created Successfully!";
    } else {
        $message = mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
</head>
<body>

<h2>Create Blog Post</h2>

<p><?php echo $message; ?></p>

<form method="POST">

    <input
        type="text"
        name="title"
        class="form-control"
        required
        minlength="3"
    >

    <br>

    <textarea
        name="content"
        class="form-control"
        required
        minlength="10"
    ></textarea>

    <br>

    <button type="submit" class="btn btn-success">
        Create Post
    </button>

</form>

</body>
</html>
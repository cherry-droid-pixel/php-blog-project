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

    <input type="text"
           name="title"
           placeholder="Post Title"
           required><br><br>

    <textarea name="content"
              rows="8"
              cols="50"
              placeholder="Write your blog..."
              required></textarea><br><br>

    <button type="submit">
        Publish Post
    </button>

</form>

</body>
</html>
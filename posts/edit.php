<?php
session_start();
include "../config/database.php";

// Fallback: ensure $conn is defined (some setups may not populate $conn in database.php)
if (!isset($conn) || !$conn) {
    // Adjust credentials as needed for your environment
    $conn = mysqli_connect('localhost', 'root', '', 'blog');
    if (!$conn) {
        die('Database connection failed: ' . mysqli_connect_error());
    }
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
if (!$result) {
    die('Query error: ' . mysqli_error($conn));
}
$post = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: views.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>

    <style>
        body{
            font-family:Arial,sans-serif;
            padding:20px;
            background:#f4f4f4;
        }

        form{
            background:white;
            padding:20px;
            border-radius:10px;
        }

        input, textarea{
            width:100%;
            padding:10px;
            margin-bottom:10px;
        }

        button{
            padding:10px 20px;
        }
    </style>
</head>
<body>

<h2>Edit Post</h2>

<form method="POST">

    <input
        type="text"
        name="title"
        value="<?php echo htmlspecialchars($post['title']); ?>"
        required
    >

    <textarea
        name="content"
        rows="8"
        required><?php echo htmlspecialchars($post['content']); ?></textarea>

    <button type="submit">
        Update Post
    </button>

</form>

</body>
</html>
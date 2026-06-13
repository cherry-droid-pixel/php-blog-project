<?php
session_start();

if($_SESSION['role'] != 'admin'){
    die("Access Denied");
}
?>
<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Check if post ID is provided
if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    // Delete post
    $sql = "DELETE FROM posts WHERE id = $id";

    if (mysqli_query($conn, $sql)) {

        // Redirect back to posts page
        header("Location: views.php");
        exit();

    } else {

        echo "Error deleting post: " . mysqli_error($conn);

    }

} else {

    echo "Invalid Post ID";

}
?>
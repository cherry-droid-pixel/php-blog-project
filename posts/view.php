<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if (!isset($conn)) {
    die("Database connection failed.");
}

$sql = "SELECT posts.*, users.username
        FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY posts.created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Blog Posts</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f4f4;
    padding:20px;
}

h1{
    text-align:center;
    color:#333;
}

.post{
    background:#fff;
    padding:20px;
    margin:20px auto;
    max-width:800px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.author{
    color:gray;
    font-size:14px;
    margin-bottom:15px;
}

.actions{
    margin-top:15px;
}

.btn{
    text-decoration:none;
    color:white;
    padding:10px 15px;
    border-radius:5px;
    margin-right:10px;
}

.edit{
    background:#007bff;
}

.delete{
    background:#dc3545;
}

.create-btn{
    display:block;
    width:200px;
    margin:20px auto;
    text-align:center;
    background:#28a745;
    color:white;
    padding:10px;
    text-decoration:none;
    border-radius:5px;
}
</style>

</head>

<body>

<h1>All Blog Posts</h1>

<a class="create-btn" href="create.php">
    Create New Post
</a>

<?php
if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
?>

<div class="post">

```
<h2>
    <?php echo htmlspecialchars($row['title']); ?>
</h2>

<p class="author">
    By <?php echo htmlspecialchars($row['username']); ?>
    |
    <?php echo $row['created_at']; ?>
</p>

<p>
    <?php echo nl2br(htmlspecialchars($row['content'])); ?>
</p>

<div class="actions">

    <a class="btn edit"
       href="edit.php?id=<?php echo $row['id']; ?>">
        Edit
    </a>

    <a class="btn delete"
       href="delete.php?id=<?php echo $row['id']; ?>"
       onclick="return confirm('Are you sure you want to delete this post?');">
        Delete
    </a>

</div>
```

</div>

<?php
    }

}else{
    echo "<h3 style='text-align:center;'>No posts found.</h3>";
}
?>

</body>
</html>
    
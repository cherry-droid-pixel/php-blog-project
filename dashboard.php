<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>


<div class="container mt-5">

<h1>Dashboard</h1>

<h4>
Welcome,
<?php echo $_SESSION['username']; ?>
</h4>

<p>
Role:
<?php echo $_SESSION['role']; ?>
</p>

<div class="card p-4">

<h3>Welcome</h3>

<a href="posts/create.php"
class="btn btn-success">
Create Post
</a>


<br>

<a href="posts/view.php"
class="btn btn-primary">
View Posts
</a>

<br>

<a href="auth/logout.php"
class="btn btn-danger">
Logout
</a>

</div>

</div>

</body>
</html>
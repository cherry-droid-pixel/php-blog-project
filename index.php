<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
?>
<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Blog Management System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container text-center mt-5">

<h1>Blog Management System</h1>

<p>PHP & MySQL Internship Project</p>

<a href="auth/login.php" class="btn btn-primary">
Login
</a>

<a href="auth/register.php" class="btn btn-success">
Register
</a>

</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Platform</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#f8f9fa;
        }

        .hero{
            background: linear-gradient(135deg,#0d6efd,#6610f2);
            color:white;
            padding:100px 20px;
            text-align:center;
        }

        .feature-card{
            transition:0.3s;
        }

        .feature-card:hover{
            transform:translateY(-8px);
        }

        .footer{
            background:#212529;
            color:white;
            text-align:center;
            padding:20px;
            margin-top:50px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            🚀 Blog Platform
        </a>

        <div>

            <?php if(isset($_SESSION['user_id'])) { ?>

                <a href="dashboard.php" class="btn btn-success me-2">
                    Dashboard
                </a>

                <a href="posts/view.php" class="btn btn-primary me-2">
                    View Posts
                </a>

                <a href="auth/logout.php" class="btn btn-danger">
                    Logout
                </a>

            <?php } else { ?>

                <a href="auth/login.php" class="btn btn-primary me-2">
                    Login
                </a>

                <a href="auth/register.php" class="btn btn-warning">
                    Register
                </a>

            <?php } ?>

        </div>

    </div>
</nav>

<!-- Hero Section -->
<section class="hero">

    <div class="container">

        <h1 class="display-3 fw-bold">
            Welcome to My Blog Platform
        </h1>

        <p class="lead">
            Create, manage and share your blog posts with the world.
        </p>

        <?php if(isset($_SESSION['user_id'])) { ?>

            <h4 class="mt-4">
                Hello, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋
            </h4>

            <a href="posts/create.php" class="btn btn-light btn-lg mt-3">
                Create New Post
            </a>

        <?php } else { ?>

            <a href="auth/register.php" class="btn btn-light btn-lg mt-3">
                Get Started
            </a>

        <?php } ?>

    </div>

</section>

<!-- Features -->
<div class="container mt-5">

    <h2 class="text-center mb-5">
        Features
    </h2>

    <div class="row">

        <div class="col-md-4 mb-4">

            <div class="card shadow feature-card">

                <div class="card-body text-center">

                    <h3>📝 Blog Posts</h3>

                    <p>
                        Create and publish unlimited blog posts.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow feature-card">

                <div class="card-body text-center">

                    <h3>🔐 Secure Login</h3>

                    <p>
                        Authentication using password hashing and sessions.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow feature-card">

                <div class="card-body text-center">

                    <h3>⚡ CRUD Operations</h3>

                    <p>
                        Create, Read, Update and Delete blog posts.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow feature-card">

                <div class="card-body text-center">

                    <h3>👤 User Accounts</h3>

                    <p>
                        Registration, login and logout functionality.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow feature-card">

                <div class="card-body text-center">

                    <h3>📊 Dashboard</h3>

                    <p>
                        Manage posts from your personal dashboard.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow feature-card">

                <div class="card-body text-center">

                    <h3>💾 MySQL Database</h3>

                    <p>
                        Data stored securely using MySQL.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Quick Links -->
<div class="container mt-4">

    <div class="card shadow">

        <div class="card-body text-center">

            <h3>Quick Actions</h3>

            <a href="posts/create.php" class="btn btn-success m-2">
                Create Post
            </a>

            <a href="posts/view.php" class="btn btn-primary m-2">
                View Posts
            </a>

            <a href="dashboard.php" class="btn btn-dark m-2">
                Dashboard
            </a>

        </div>

    </div>

</div>

<!-- Footer -->
<footer class="footer">

    <h5>PHP Blog Project</h5>

    <p>
        Built using PHP, MySQL, Bootstrap and GitHub
    </p>

    <p>
        © 2026 Charan
    </p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
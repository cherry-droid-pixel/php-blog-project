<?php
session_start();
// Load database connection. Use absolute path based on this file's directory.
require_once __DIR__ . '/../config/database.php';

// Ensure $conn is available
if (!isset($conn) || !$conn) {
    // stop execution with a clear message
    die('Database connection not available.');
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];

            header("Location: ../dashboard.php");
            exit();

        } else {
            $message = "Invalid Password!";
        }

    } else {
        $message = "User Not Found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body{
            font-family:Arial,sans-serif;
            background:#f4f4f4;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .container{
            width:400px;
            background:#fff;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        input{
            width:100%;
            padding:10px;
            margin:10px 0;
            box-sizing:border-box;
        }

        button{
            width:100%;
            padding:10px;
            background:#007bff;
            color:white;
            border:none;
        }

        .message{
            color:red;
            text-align:center;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Login</h2>

    <?php if($message!=""){ ?>
        <p class="message"><?php echo $message; ?></p>
    <?php } ?>

    <form method="POST">

        <input
            type="email"
            name="email"
            placeholder="Enter Email"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Enter Password"
            required
        >

        <button type="submit">Login</button>

    </form>

</div>

</body>
</html>
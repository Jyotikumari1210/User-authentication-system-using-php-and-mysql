<?php
include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Project - Login</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #1d2671, #c33764);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: #ffffff;
            width: 350px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-box input[type="email"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .login-box input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #1d2671;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-box input[type="submit"]:hover {
            background: #c33764;
        }

        .login-box a {
            display: inline-block;
            margin-top: 10px;
            color: #1d2671;
            text-decoration: none;
            font-size: 14px;
        }

        .login-box a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Form</h2>

    <form method="post" action="">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>

        <a href="#">Forgot Password?</a><br><br>

        <input type="submit" value="Login" name="btnsubmit">

        <p>
            Don't have an account?
            <a href="register.php">Register</a>
        </p>
    </form>

<?php
if(isset($_POST['btnsubmit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE Email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<div class='error'>Invalid password</div>";
        }
    } else {
        echo "<div class='error'>User not found</div>";
    }
}
?>
</div>

</body>
</html>

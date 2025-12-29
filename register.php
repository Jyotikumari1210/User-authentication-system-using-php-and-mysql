<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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

        .register-box {
            background: #fff;
            width: 380px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .register-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .register-box input[type="text"],
        .register-box input[type="email"],
        .register-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .register-box input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #1d2671;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-box input[type="submit"]:hover {
            background: #c33764;
        }

        .register-box a {
            display: inline-block;
            margin-top: 12px;
            font-size: 14px;
            color: #1d2671;
            text-decoration: none;
        }

        .register-box a:hover {
            text-decoration: underline;
        }

        .message {
            margin-top: 10px;
            font-size: 14px;
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>

    <div class="register-box">
        <h2>Register Form</h2>

        <form method="post">
            <input type="text" name="user" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>

            <input type="submit" name="btnsubmit" value="Register">

            <a href="login.php">Already have an account? Login</a>
        </form>

        <?php
        if (isset($_POST['btnsubmit'])) {

            $user = $_POST['user'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($user) || empty($email) || empty($password)) {
                echo "<div class='message'>All fields are required</div>";
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class='message'>Invalid email format</div>";
                exit;
            }


            $checkSql = "SELECT id FROM users WHERE email = ?";
            $checkStmt = $con->prepare($checkSql);
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $result = $checkStmt->get_result();

            if ($result->num_rows > 0) {
                echo "<div class='message'>Email already registered</div>";
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sss", $user, $email, $hashedPassword);

            if ($stmt->execute()) {
                echo "<div class='message success'>Registration successful</div>";
            } else {
                echo "<div class='message'>Error occurred</div>";
            }
        }
        ?>
    </div>

</body>

</html>
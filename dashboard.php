<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
        }
        .navbar {
            background: #007bff;
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
        }

        .dashboard {
            width: 400px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .dashboard h2 {
            margin-bottom: 10px;
        }

        .dashboard p {
            color: #555;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #b52a37;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div>My Dashboard</div>
    <div>
        Welcome, <?php echo $_SESSION['username']; ?>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="dashboard">
    <h2>Welcome</h2>
    <p>You have successfully logged in.</p>
    <p>This is your secure dashboard.</p>

    <a href="logout.php" class="btn">Logout</a>
</div>

</body>
</html>

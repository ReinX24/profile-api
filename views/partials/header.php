<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.orange.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css" />
</head>

<body>

    <main class="container">
        <nav>
            <ul>
                <li>
                    <?php if (isset($_SESSION["user_info"])) : ?>
                        <h1><a href="dashboard.php">Profile Dashboard</a></h1>
                    <?php else : ?>
                        <h1><a href="index.php">Profile API</a></h1>
                    <?php endif; ?>
                </li>
            </ul>
            <ul>
                <?php if (isset($_SESSION["user_info"]["id"])) : ?>
                    <li><a href="logout_user.php"><button>Logout</button></a></li>
                <?php else : ?>
                    <li><a href="login_user.php">Login</a></li>
                    <li><a href="register_user.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
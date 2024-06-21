<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile API</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>

    <main>
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <?php if (isset($_SESSION["user_info"])) : ?>
                    <a href="dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                        <span class="fs-2">Profile Dashboard</span>
                    </a>
                <?php else : ?>
                    <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                        <span class="fs-2">Profile API</span>
                    </a>
                <?php endif; ?>

                <ul class="nav nav-pills">
                    <?php if (isset($_SESSION["user_info"]["id"])) : ?>
                        <li class="nav-item fs-5"><a href="logout_user.php" class="nav-link active">Logout</a></li>
                    <?php else : ?>
                        <li class="nav-item fs-5"><a href="login_user.php" class="nav-link <?= $current_page == "login_page" ? "active" : ""; ?>">Login</a></li>
                        <li class="nav-item fs-5"><a href="register_user.php" class="nav-link <?= $current_page == "register_page" ? "active" : ""; ?>">Register</a></li>
                    <?php endif; ?>
                </ul>
            </header>
        </div>
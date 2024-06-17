<?php
// DONE: implement login feature
// DONE: get the current users in database using api request
// DONE: update a user in the database using api request
// DONE: regenerate access_token, token_valid_until, and updated_at
?>

<?php require_once "../../views/partials/header.php"; ?>

<div class="container my-5">
    <div class="p-5 text-center bg-body-tertiary rounded-3 border">

        <img src="../images/index_photo.png" alt="index photo" class="bi my-3" height=150>

        <h1 class="text-body-emphasis">Profile API</h1>
        <p class="col-lg-8 mx-auto fs-5 text-muted">
            Profile API lets you create, insert, update, and delete profiles using API
            requests.
        </p>
        <div class="d-inline-flex gap-2 mb-5">
            <a href="login_user.php" class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill">Login</a>
            <a href="register_user.php" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Register</a>
        </div>
    </div>
</div>

<?php require_once "../../views/partials/footer.php"; ?>
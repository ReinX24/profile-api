<?php

$current_page = "login_page";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../../Database.php";

    $database = new Database();
    $errors = $database->login_existing_user();

    if (empty($errors)) {
        session_start();
        $_SESSION["user_logged_in"] = true;
        header("Location: dashboard.php");
    }
}
?>

<?php require_once "../../views/partials/header.php"; ?>

<?php require_once "../../views/users/login_form.php"; ?>

<?php require_once "../../views/partials/footer.php"; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../../Database.php";

    $database = new Database();
    $errors = $database->create_new_user();

    if (empty($errors)) {
        $success_message = "Successfully Registered User!";
    }
}
?>

<?php require_once "../../views/partials/header.php"; ?>

<?php require_once "../../views/users/register_form.php"; ?>

<?php require_once "../../views/partials/footer.php"; ?>
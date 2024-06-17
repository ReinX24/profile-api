<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    $id = $_SESSION["user_info"]["id"];
    $access_token = $_SESSION["user_info"]["access_token"];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../../Database.php";

    // Reset session information
    // session_unset();
    // session_destroy();

    $database = new Database();
    $database->regenerate_token();

    $user_info = $database->get_user_by_id($_POST["id"]);

    session_start();
    $_SESSION["user_info"] = $user_info;

    header("Location: dashboard.php");
} else {
    header("Location: index.php");
}

?>

<?php require_once "../../views/partials/header.php"; ?>

<form method="POST">
    <h2>Regenerate token?</h2>
    <p>Current token: <?= $access_token; ?></p>
    <input type="hidden" name="id" value="<?= $id; ?>">
    <button type="submit">Regenerate Token</button>
    <a href="dashboard.php"><button type="submit">Cancel</button></a>
</form>

<?php require_once "../../views/partials/footer.php"; ?>
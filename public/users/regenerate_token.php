<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION["user_info"])) {
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    $id = $_SESSION["user_info"]["id"];
    $access_token = $_SESSION["user_info"]["access_token"];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
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

<div class="container">
    <form method="POST">
        <h1>Regenerate token?</h1>
        <p class="my-3 fs-4"><strong>Current token:</strong> <?= $access_token; ?></p>
        <input type="hidden" name="id" value="<?= $id; ?>">
        <button type="submit" class="btn btn-primary btn-lg">Regenerate Token</button>
        <a href="dashboard.php"><button type="submit" class="btn btn-outline-secondary btn-lg">Cancel</button></a>
    </form>
</div>

<?php require_once "../../views/partials/footer.php"; ?>
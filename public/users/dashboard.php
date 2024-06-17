<?php

session_start();

if ($_SESSION["user_logged_in"]) {

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    require_once "../../Database.php";

    $database = new Database();
    $user_info = $database->get_user_by_id($_SESSION["user_id"]);

    $_SESSION["user_info"] = $user_info;

    $id = $_SESSION["user_info"]["id"];
    $name = $_SESSION["user_info"]["name"];
    $email = $_SESSION["user_info"]["email"];
    $password = $_SESSION["user_info"]["password"];
    $contact_number = $_SESSION["user_info"]["contact_number"];
    $birthdate = $_SESSION["user_info"]["birthdate"];
    $address = $_SESSION["user_info"]["address"];
    $photo = "../" . $_SESSION["user_info"]["photo"];
    $access_token = $_SESSION["user_info"]["access_token"];
    $token_valid_until = $_SESSION["user_info"]["token_valid_until"];
    $created_at = $_SESSION["user_info"]["created_at"];
    $updated_at = $_SESSION["user_info"]["updated_at"];
} else {
    header("Location: index.php");
}

?>

<?php require_once "../../views/partials/header.php"; ?>

<article>
    <header>
        <h1>Welcome back, <?= $name; ?></h1>
    </header>
    <h2>Access Token: <?= $access_token; ?></h2>
    <p>Token Valid Until: <?= $token_valid_until; ?></p>
    <form action="regenerate_token.php">
        <button type="submit">Regenerate Token</button>
    </form>
    <hr>
    <p>Name: <?= $name; ?></p>
    <p>Email: <?= $email; ?></p>
    <p>Password: <?= $password; ?></p>
    <p>Contact Number: <?= $contact_number; ?></p>
    <p>Birthdate: <?= $birthdate; ?></p>
    <p>Address: <?= $address; ?></p>
    <p>
        Profile Photo:
        <img src="<?= $photo; ?>" alt="profile photo" style="height: 12rem;">
    </p>
    <p>Created At: <?= $created_at; ?></p>
    <p>Updated At: <?= $updated_at; ?></p>

    <footer>© 2024 Rein Solis</footer>
</article>

<?php require_once "../../views/partials/footer.php"; ?>
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

    if (isset($_SESSION["user_info"]["photo"])) {
        // Checks if a user exists
        $photo = "../" . $_SESSION["user_info"]["photo"];
    } else {
        // Use a placeholder photo
        echo "Test";
        $photo = "../images/user_placeholder.png";
    }

    $access_token = $_SESSION["user_info"]["access_token"];
    $token_valid_until = $_SESSION["user_info"]["token_valid_until"];
    $created_at = $_SESSION["user_info"]["created_at"];
    $updated_at = $_SESSION["user_info"]["updated_at"];
} else {
    header("Location: index.php");
}

?>

<?php require_once "../../views/partials/header.php"; ?>

<div class="container d-flex flex-column align-items-center">
    <h2>Welcome back, <?= $name; ?></h2>
    <div class="card my-2" style="width: 28rem;">
        <img src="<?= $photo; ?>" alt="profile photo">
        <div class="card-body">
            <h2 class="card-title"><?= $name; ?></h2>
            <div class="card-text">
                <div class="mb-3">
                    <h4>Access Token: <?= $access_token; ?></h4>
                    <p class="fs-5"><strong>Token Valid Until:</strong> <?= date("m-d-Y h:i:s A", strtotime($token_valid_until)); ?></p>
                    <form action="regenerate_token.php" class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg">Regenerate Token</button>
                    </form>
                    <hr>
                </div>
                <div class="mb-3 fs-5">
                    <p><strong>Name:</strong> <?= $name; ?></p>
                    <p><strong>Email:</strong> <?= $email; ?></p>
                    <p><strong>Password:</strong> <?= $password; ?></p>
                    <p><strong>Contact Number:</strong> <?= $contact_number; ?></p>
                    <p><strong>Birthdate:</strong> <?= $birthdate; ?></p>
                    <p><strong>Address:</strong> <?= $address; ?> </p>
                    <p><strong>Created At:</strong> <?= date("m-d-Y h:i:s A", strtotime($created_at)); ?></p>
                    <p><strong>Updated At:</strong> <?= date("m-d-Y h:i:s A", strtotime($updated_at)); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../../views/partials/footer.php"; ?>
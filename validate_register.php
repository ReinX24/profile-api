<?php

declare(strict_types=1);

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$contact_number = $_POST["contact_number"];
$birthdate = $_POST["birthdate"];
$address = $_POST["address"];

$profile_image = $_FILES["image"];

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

// echo "<pre>";
// var_dump($_FILES);
// echo "</pre>";

if (!$name) {
    $errors["name_error"] = "Name is required for registering!";
}

if (!$password) {
    $errors["password_error"] = "Password is required for registering!";
}

if (!is_dir(__DIR__ . "/public/images")) {
    mkdir(__DIR__ . "/public/images");
}

// Checks if there are any errors, adds photo to a folder if there are none
if (empty($errors) && $profile_image["name"]) {

    $image_path = "images/" . random_string(8) . "/" . $profile_image["name"];

    mkdir(dirname(__DIR__ . "/public/" . $image_path));

    move_uploaded_file($profile_image["tmp_name"], __DIR__ . "/public/" . $image_path);
}

if (empty($errors)) {
    $register_user_sql =
        "INSERT INTO 
                users (name, email, password, contact_number, birthdate, address, photo, access_token, token_valid_until, created_at, updated_at)
            VALUES
                (:name, :email, :password, :contact_number, :birthdate, :address, :photo, :access_token, :token_valid_until, :created_at, :updated_at)";

    $statement = $pdo->prepare($register_user_sql);

    $statement->bindValue(":name", $name);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
    $statement->bindValue(":contact_number", $contact_number);
    $statement->bindValue(":birthdate", $birthdate);
    $statement->bindValue(":address", $address);
    $statement->bindValue(":photo", $image_path ?? null);

    // Generating access token by generating a random string
    $access_token = random_string(8);

    $statement->bindValue(":access_token", $access_token);

    // Setting token valid time, the time it was created, and when it was updated
    $valid_until = date("Y/m/d H:i:s", time() + 86400); // valid for 1 day
    $created_and_update = date("Y/m/d H:i:s", time());

    // var_dump($valid_until);
    // var_dump($created_and_update);
    // exit();

    $statement->bindValue(":token_valid_until", $valid_until);
    $statement->bindValue(":created_at", $created_and_update);
    $statement->bindValue(":updated_at", $created_and_update);

    $statement->execute();
}

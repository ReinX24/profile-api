<?php

require_once "Functions.php";

date_default_timezone_set('Asia/Manila');

class Database
{

    public $pdo;
    public $functions;

    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=localhost;port=3306;dbname=api_db",
            "root",
        );

        // Enable errors for PDO object
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->functions = new Functions();
    }

    public function get_matching_token(string $bearer_token)
    {
        $get_token_sql = "SELECT * FROM users WHERE access_token = :bearer_token";

        $statement = $this->pdo->prepare($get_token_sql);

        $statement->bindValue(":bearer_token", $bearer_token);

        $statement->execute();

        $user_info = $statement->fetch(PDO::FETCH_ASSOC);

        return $user_info["access_token"] ?? null;
    }

    public function get_token_valid_until(string $bearer_token)
    {
        $get_token_sql =
            "SELECT 
                token_valid_until 
            FROM 
                users 
            WHERE 
                access_token = :bearer_token";

        $statement = $this->pdo->prepare($get_token_sql);

        $statement->bindValue(":bearer_token", $bearer_token);

        $statement->execute();

        $user_info = $statement->fetch(PDO::FETCH_ASSOC);

        return $user_info["token_valid_until"];
    }

    public function get_all_users()
    {
        $get_users_sql = "SELECT * FROM users";

        $statement = $this->pdo->prepare($get_users_sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_user_by_id($id)
    {
        $user_info_sql = "SELECT * FROM users WHERE id = :id";

        $statement = $this->pdo->prepare($user_info_sql);

        $statement->bindValue(":id", $id);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create_new_user()
    {
        $errors = [];

        $name = $_POST["name"] ?? null;
        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;
        $contact_number = $_POST["contact_number"] ?? null;
        $birthdate = $_POST["birthdate"] ?? null;
        $address = $_POST["address"] ?? null;

        $profile_image = $_FILES["photo"] ?? null;

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

        if (!$email) {
            $errors["email_error"] = "Email is required for registering!";
        }

        if (!is_dir(__DIR__ . "/public/images")) {
            mkdir(__DIR__ . "/public/images");
        }

        // Checks if there are any errors, adds photo to a folder if there are none
        if (empty($errors) && !empty($profile_image)) {

            $image_path = "images/" . $this->functions->random_string(8) . "/" . $profile_image["name"];

            mkdir(dirname(__DIR__ . "/public/" . $image_path));

            move_uploaded_file($profile_image["tmp_name"], __DIR__ . "/public/" . $image_path);
        }

        if (empty($errors)) {
            $register_user_sql =
                "INSERT INTO 
                    users (name, email, password, contact_number, birthdate, address, photo, access_token, token_valid_until, created_at, updated_at)
                VALUES
                    (:name, :email, :password, :contact_number, :birthdate, :address, :photo, :access_token, :token_valid_until, :created_at, :updated_at)";

            $statement = $this->pdo->prepare($register_user_sql);

            $statement->bindValue(":name", $name);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
            $statement->bindValue(":contact_number", $contact_number);
            $statement->bindValue(":birthdate", $birthdate);
            $statement->bindValue(":address", $address);
            $statement->bindValue(":photo", $image_path ?? null);

            // Generating access token by generating a random string
            $access_token = $this->functions->random_string(8);

            $statement->bindValue(":access_token", $access_token);

            // Setting token valid time, the time it was created, and when it was updated
            $valid_until = date("Y/m/d H:i:s", time() + 86400); // valid for 1 day
            $created_and_update = date("Y/m/d H:i:s", time());

            $statement->bindValue(":token_valid_until", $valid_until);
            $statement->bindValue(":created_at", $created_and_update);
            $statement->bindValue(":updated_at", $created_and_update);

            $statement->execute();
        }

        return $errors;
    }

    public function create_new_user_with_api()
    {
        $errors = [];

        $name = $_POST["name"] ?? null;
        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;
        $contact_number = $_POST["contact_number"] ?? null;
        $birthdate = $_POST["birthdate"] ?? null;
        $address = $_POST["address"] ?? null;

        $profile_image = $_FILES["photo"] ?? null;

        if (!$name) {
            $errors["name_error"] = "Name is required for registering!";
        }

        if (!$password) {
            $errors["password_error"] = "Password is required for registering!";
        }

        if (!$email) {
            $errors["email_error"] = "Email is required for registering!";
        }

        if (!is_dir(__DIR__ . "/public/images")) {
            mkdir(__DIR__ . "/public/images");
        }

        // Checks if there are any errors, adds photo to a folder if there are none
        if (empty($errors) && !empty($profile_image)) {

            $image_path = "images/" . $this->functions->random_string(8) . "/" . $profile_image["name"];

            mkdir(dirname(__DIR__ . "/public/" . $image_path));

            move_uploaded_file($profile_image["tmp_name"], __DIR__ . "/public/" . $image_path);
        }

        if (empty($errors)) {
            $register_user_sql =
                "INSERT INTO 
                users (name, email, password, contact_number, birthdate, address, photo, access_token, token_valid_until, created_at, updated_at)
            VALUES
                (:name, :email, :password, :contact_number, :birthdate, :address, :photo, :access_token, :token_valid_until, :created_at, :updated_at)";

            $statement = $this->pdo->prepare($register_user_sql);

            $statement->bindValue(":name", $name);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
            $statement->bindValue(":contact_number", $contact_number);
            $statement->bindValue(":birthdate", $birthdate);
            $statement->bindValue(":address", $address);
            $statement->bindValue(":photo", $image_path ?? null);

            // Generating access token by generating a random string
            $access_token = $this->functions->random_string(8);

            $statement->bindValue(":access_token", $access_token);

            // Setting token valid time, the time it was created, and when it was updated
            $valid_until = date("Y/m/d H:i:s", time() + 86400); // valid for 1 day
            $created_and_update = date("Y/m/d H:i:s", time());

            $statement->bindValue(":token_valid_until", $valid_until);
            $statement->bindValue(":created_at", $created_and_update);
            $statement->bindValue(":updated_at", $created_and_update);

            $statement->execute();
        }

        if (empty($errors)) {
            return ["post_info" => $_POST, "photo_info" => $_FILES["photo"] ?? null];
        }

        return $errors;
    }

    public function edit_user_with_api()
    {
        $errors = [];

        $id = $_POST["id"];

        $current_user_info = $this->get_user_by_id($id);

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $contact_number = $_POST["contact_number"] ?? null;
        $birthdate = $_POST["birthdate"] ?? null;
        $address = $_POST["address"] ?? null;

        $profile_image = $_FILES["photo"] ?? null;

        if (!$name) {
            $errors["name_error"] = "Name is required for users!";
        }

        if (!$password) {
            $errors["password_error"] = "Password is required for users!";
        }

        if (!$email) {
            $errors["email_error"] = "Email is required for users!";
        }

        if (!is_dir(__DIR__ . "/public/images")) {
            mkdir(__DIR__ . "/public/images");
        }

        // Checks if there are any errors, adds photo to a folder if there are none
        if (empty($errors) && isset($profile_image) && $profile_image["name"]) {

            // Deleting old photo
            if (isset($current_user_info["photo"])) {
                unlink(__DIR__ . "/public/" . $current_user_info["photo"]); // deletes photo
                rmdir(__DIR__ . "/public/" . $current_user_info["photo"] . "/../"); // delete directory
            }

            $image_path = "images/" . $this->functions->random_string(8) . "/" . $profile_image["name"];

            mkdir(dirname(__DIR__ . "/public/" . $image_path));

            move_uploaded_file($profile_image["tmp_name"], __DIR__ . "/public/" . $image_path);
        }

        if (empty($errors)) {

            $edit_user_sql =
                "UPDATE
                    users
                SET
                    name = :name,
                    email = :email,
                    password = :password,
                    contact_number = :contact_number,
                    birthdate = :birthdate,
                    address = :address,
                    photo = :photo,
                    updated_at = :updated_at
                WHERE
                    id = :id";

            $statement = $this->pdo->prepare($edit_user_sql);

            $statement->bindValue(":name", $name);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
            $statement->bindValue(":contact_number", $contact_number);
            $statement->bindValue(":birthdate", $birthdate);
            $statement->bindValue(":address", $address);
            $statement->bindValue(":photo", $image_path ?? null);
            $statement->bindValue(":updated_at", date("Y/m/d H:i:s", time()));

            $statement->bindValue(":id", $id);

            $statement->execute();
        }

        if (empty($errors)) {
            $response = $this->get_user_by_id($id);
            return $response;
        }

        return $errors;
    }


    public function delete_user_with_api()
    {
        $id = $_POST["id"];

        $user_info = $this->get_user_by_id($id);
        $user_image = $user_info["photo"];

        // Deleting the user's photo before removing them from the database
        if (isset($user_image)) {
            unlink(__DIR__ . "/public/" . $user_image); // deletes photo
            rmdir(__DIR__ . "/public/" . $user_image . "/../"); // delete directory
        }

        // Deleting the user information from our database
        $delete_user_sql =
            "DELETE FROM
                users
            WHERE
                id = :id";

        $statement = $this->pdo->prepare($delete_user_sql);

        $statement->bindValue(":id", $id);

        $statement->execute();

        return ["message" => "Profile deleted!"];
    }

    public function login_existing_user()
    {
        $errors = [];

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (!$name) {
            $errors["name_error"] = "Name is required for login!";
        }

        if (!$password) {
            $errors["password_error"] = "Password is required for login!";
        }

        if (!$email) {
            $errors["email_error"] = "Email is required for login!";
        }

        if (empty($errors)) {
            $get_user_sql =
                "SELECT
                    *
                FROM
                    users
                WHERE
                    name = :name
                AND
                    email = :email";

            $statement = $this->pdo->prepare($get_user_sql);

            $statement->bindValue(":name", $name);
            $statement->bindValue(":email", $email);

            $statement->execute();

            $user_info = $statement->fetch(PDO::FETCH_ASSOC);

            // If no user is found
            if (empty($user_info)) {
                $errors["user_error"] = "Name or email not found!";
                return $errors;
            }

            if (!password_verify($password, $user_info["password"])) {
                $errors["password_error"] = "Wrong password!";
                return $errors;
            }

            if (empty($errors)) {
                session_start();

                $_SESSION["user_id"] = $user_info["id"];
            }
        }

        return $errors;
    }

    public function regenerate_token()
    {
        $id = $_POST["id"];

        $regenerate_sql =
            "UPDATE
                users
            SET
                access_token = :access_token,
                token_valid_until = :token_valid_until,
                updated_at = :updated_at
            WHERE
                id = :id";

        $statement = $this->pdo->prepare($regenerate_sql);

        $access_token = $this->functions->random_string(8);
        $token_valid_until = date("Y/m/d H:i:s", time() + 86400); // valid for 1 day
        $updated_at = date("Y/m/d H:i:s", time());

        $statement->bindValue(":id", $id);
        $statement->bindValue(":access_token", $access_token);
        $statement->bindValue(":token_valid_until", $token_valid_until);
        $statement->bindValue(":updated_at", $updated_at);

        $statement->execute();

        return $access_token;
    }
}

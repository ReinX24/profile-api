<?php

require_once "Database.php";

class Api
{

    public $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    // Checks if the request has the corrent api request key or token
    private function is_authenticated()
    {
        // Checks if there is a bearer token in the request
        if (empty($this->get_bearer_token())) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["status" => "401", "message" => "Empty bearer token!"]);
            exit;
        }

        // Checks if there are any matching bearer tokens
        if (empty($this->database->get_matching_token($this->get_bearer_token()))) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["status" => "401", "message" => "No matching bearer tokens!"]);
            exit;
        }

        $token_valid_until = $this->database->get_user_by_token($this->get_bearer_token());
        $current_date_time = date("Y-m-d H:i:s", time());

        // var_dump($token_valid_until);
        // var_dump($current_date_time);
        // exit;

        // If the current date is greater than the token valid until
        if ($current_date_time > $token_valid_until) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["status" => "401", "message" => "Token expired!"]);
            exit;
        }


        return $this->get_bearer_token() == $this->database->get_matching_token($this->get_bearer_token());
    }

    // Handles the api request
    public function handle_request()
    {
        if (!$this->is_authenticated()) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["status" => "401", "message" => "Unauthorized!"]);
            exit();
        }

        $what = $_GET["what"] ?? "/"; // no get parameters
        $request_method = $_SERVER["REQUEST_METHOD"];

        if ($request_method == "POST") {
            $this->handle_post_request($what);
        } elseif ($request_method == "GET") {
            $this->handle_get_request($what);
        }
    }

    private function handle_post_request(string $what)
    {
        switch ($what) {
            case "/":
                echo "POST Request!";
                break;
            case "add-user":
                $this->create_new_user();
                break;
            case "update-user":
                $this->edit_existing_user();
                break;
            case "delete-user":
                $this->delete_existing_user();
                break;
            default:
                header("HTTP/1.1 404 Not Found");
                echo "404 Not Found";
                break;
        }
    }


    private function handle_get_request(string $what)
    {
        switch ($what) {
            case "/":
                echo "GET Request!";
                break;
            case "users":
                echo json_encode($this->database->get_all_users());
                break;
            default:
                header("HTTP/1.1 404 Not Found");
                echo "404 Not Found";
                break;
        }
    }

    /** 
     * Get header Authorization
     * */
    private function get_authorization_header()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    // get access token from header
    private function get_bearer_token()
    {
        $headers = $this->get_authorization_header();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /* 
        POST request
        Fields:
            - name
            - email
            - password
            - contact_number
            - birthdate
            - address
            - profile_image
    */
    public function create_new_user()
    {
        if (!$this->is_authenticated()) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["status" => "401", "message" => "Unauthorized!"]);
            exit();
        }

        $response = $this->database->create_new_user_with_api();
        echo json_encode($response);
    }

    /* 
        POST request
        Fields:
            - name
            - email
            - password
            - contact_number
            - birthdate
            - address
            - profile_image
    */
    public function edit_existing_user()
    {
        if (!$this->is_authenticated()) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["status" => "401", "message" => "Unauthorized!"]);
            exit();
        }

        $response = $this->database->edit_user_with_api();
        echo json_encode($response);
    }

    /* 
        POST request
        Fields:
            - id
    */
    public function delete_existing_user()
    {
        if (!$this->is_authenticated()) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["status" => "401", "message" => "Unauthorized!"]);
            exit();
        }

        $response = $this->database->delete_user_with_api();
        echo json_encode($response);
    }

    /* 
        POST request
        Fields:
            - id
            - email
            - password
            - contact_number
            - birthdate
            - address
            - profile_image
    */
    public function regenerate_token()
    {
        if (!$this->is_authenticated()) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["status" => "401", "message" => "Unauthorized!"]);
            exit();
        }

        $access_token = $this->database->regenerate_token();
        echo json_encode(["New Token" => $access_token]);
    }
}

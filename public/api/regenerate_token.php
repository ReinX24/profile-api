<?php

require_once "../../Api.php";

// var_dump($_POST);
// exit;

$api = new Api();
$api->regenerate_token();

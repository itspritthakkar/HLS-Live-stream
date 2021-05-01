<?php

include 'config.php';
include 'functions.php';


$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

if (!$email) {
    $result['message'] = ['status'=>0,'error'=>'email missing'];
}
elseif(!$password){
    $result['message'] = ['status'=>0,'error'=>'password missing'];
}
else {
    $post_result = login($pdo,$email,$password);

    $result['success'] = 1;

    $result['message'] = '';

    $result['data'] = $post_result;
}
echo getJsonResult($result);
?>
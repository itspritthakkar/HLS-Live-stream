<?php

include 'config.php';
include 'functions.php';


$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : '';
$bet_on = isset($_REQUEST['bet_on']) ? $_REQUEST['bet_on'] : '';
$bet_amount = isset($_REQUEST['bet_amount']) ? $_REQUEST['bet_amount'] : '';
$heads = isset($_REQUEST['heads']) ? $_REQUEST['heads'] : '';
$tails = isset($_REQUEST['tails']) ? $_REQUEST['tails'] : '';
$straight = isset($_REQUEST['straight']) ? $_REQUEST['straight'] : '';

if (!$user_id) {
    $result['message'] = ['status'=>0,'error'=>'user_id missing'];
}
elseif(!$bet_on){
    $result['message'] = ['status'=>0,'error'=>'bet_on missing'];
}
elseif(!$bet_amount){
    $result['message'] = ['status'=>0,'error'=>'bet_amount missing'];
}
elseif(!$heads){
    $result['message'] = ['status'=>0,'error'=>'heads missing'];
}
elseif(!$tails){
    $result['message'] = ['status'=>0,'error'=>'tails missing'];
}
elseif(!$straight){
    $result['message'] = ['status'=>0,'error'=>'straight missing'];
}
else {
    $bet_on=strtolower($bet_on);
    
    $post_result = getResult($pdo,$user_id,$bet_on,$bet_amount,$heads,$tails,$straight);

    $result['success'] = 1;

    $result['message'] = 'Records fetched successfully';

    $result['data'] = $post_result;
}
echo getJsonResult($result);
?>
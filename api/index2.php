<?php

include 'config.php';
include 'functions.php';


$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : '';
// $post_id = isset($_REQUEST['post_id']) ? $_REQUEST['post_id'] : '';
// $comment = isset($_REQUEST['comment']) ? $_REQUEST['comment'] : '';

// errorLog($pdo, 'user_details', $_REQUEST);



if (!$user_id) {

    $result['message'] = 'userid is missing';

} 

else {
    $post_result = getLivevideo($pdo,$user_id);

    $result['success'] = 1;

    $result['message'] = 'Video url generated successfully';

    $result['data'] = $post_result;
}
echo getJsonResult($result);
?>
<?php

function random_strings($length_of_string=6){
        
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    // Shufle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result), 
                    0, $length_of_string);
}

function legal_input($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

function getResult($pdo,$user_id,$bet_on,$bet_amount,$heads,$tails,$straight){
    $session_token=random_strings();
    $coinsquery="Select balance FROM `user_profile` WHERE id='".$user_id."'";
    $stmt = $pdo->prepare($coinsquery);
    $stmt -> execute();
    $coinsquery=$stmt->fetch(PDO::FETCH_ASSOC);
    // $count = $stmt->rowCount();
    if($bet_amount<=$coinsquery['balance']){
        if($heads>$tails){
            $winner='tails';
        }
        elseif ($heads<$tails) {
            $winner='heads';
        }
        elseif (($heads+$tails)>=$straight || $heads==$tails) {
            $winner='straight';
        }
        else{
            $data = ['status'=>0,'error'=>'Calculation error'];
        }
        if ($bet_on==$winner) {
            $updated_balance=$coinsquery['balance']+$bet_amount;
        }
        else{
            $updated_balance=$coinsquery['balance']-$bet_amount;
        }
        $insertquery="INSERT INTO `game` (`user_id`, `session_token`, `bet_on`, `winner`, `bet_amount`) VALUES ('".$user_id."', '".$session_token."', '".$bet_on."', '".$winner."', '".$bet_amount."')";
        $stmt = $pdo->prepare($insertquery);
        $stmt -> execute();
        $updatequery="UPDATE `user_profile` SET `balance` = '".$updated_balance."' WHERE `id` = '".$user_id."'";
        $stmt = $pdo->prepare($updatequery);
        $stmt -> execute();
        $mhquery="SELECT * FROM `game` WHERE `user_id` = '".$user_id."' LIMIT 0,10";
        $stmt = $pdo->prepare($mhquery);
        $stmt -> execute();
        $mhquery=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $winnerquery="SELECT * FROM `game` WHERE `session_token` = '".$session_token."'";
        $stmt1 = $pdo->prepare($winnerquery);
        $stmt1 -> execute();
        $winnerquery=$stmt1->fetch(PDO::FETCH_ASSOC);
        $winnerquery['balance']=$updated_balance;
        $winnerquery['match_history']=$mhquery;
        $data=$winnerquery;
    }
    else {
        $data = ['status'=>0,'error'=>'Insufficient balance'];
    }
    return $data;
}

function login($pdo,$email,$password){
    $email=legal_input($email);
    $password=legal_input($password);
    $query="Select id,full_name,balance,email,password FROM `user_profile` WHERE email='".$email."' and password='".md5($password)."'";
    $stmt = $pdo->prepare($query);
    $stmt -> execute();
    $selectquery=$stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if($count==1){
        $data = ['id'=>$selectquery['id'],'name'=>$selectquery['full_name'],'email'=>$selectquery['email'],'balance'=>$selectquery['balance']];
    }
    else{
        $data = ['error'=>'Login Invalid'];
    }
    return $data;
}

?>


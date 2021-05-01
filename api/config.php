<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



define('DB_SERVER', 'localhost');
define('DB_DATABASE', 'admin_panel');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');







try {
    $pdo = new PDO('mysql:host=' . DB_SERVER . ';dbname=admin_panel;charset=utf8mb4' , DB_USERNAME, DB_PASSWORD);
    if ($pdo) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$pdo->exec('SET NAMES utf8');
		//$pdo->query('SET NAMES "utf8"'); 
		//$pdo->exec("SET NAMES 'utf8';");
        //$pdo->exec("SET CHARACTER SET 'utf8';");
		$pdo->exec("SET time_zone= '+05:30'");
		// echo 'connection established successfully';
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}




function getJsonResult($result)
    {
        $output = array();
        $output['input'] = isset($result['input']) ? $result['input'] : (object) array();
        $output['file'] = isset($result['file']) ? $result['file'] : array();
        $output['commandResult']['success'] = isset($result['success']) ? $result['success'] : 0;
        $output['commandResult']['message'] = isset($result['message']) ? $result['message'] : 'Check API Manually.';
        $output['commandResult']['data'] = isset($result['data']) ? $result['data'] : (object) array();
        return json_encode($output);
    }

?>
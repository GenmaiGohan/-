<?php
require('dbconnect.php');
$stmt = $db->prepare('update messages set name=?, message=? where id=?');
if(!$stmt){
    die($db->error);
}
//id,name,messageをフォームから受け取る
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

//$stmtの?のところにそれぞれ割り当てて実行
$stmt->bind_param('ssi', $name, $message, $id);
$success = $stmt->execute();
if(!$success){
    die($db->error);
}
header('location:update_done.html');
?>
<?php
//メッセージと名前を受け取る
$message = filter_input(INPUT_POST, 'message',FILTER_SANITIZE_SPECIAL_CHARS);
$name = filter_input(INPUT_POST, 'name',FILTER_SANITIZE_SPECIAL_CHARS);

require('dbconnect.php');

//メッセージと名前をデータベースに保存する
$stmt= $db->prepare('insert into messages(message,name) values(?,?)'); //messagesというテーブルのmessageカラムとnameカラムに,フォームから入力された情報を入れる
if(!$stmt){
  die($db->error);
}
$stmt->bind_param('ss',$message,$name); //nameとcommentはどちらも文字列なのでssとして指定する
$ret = $stmt->execute();

if($ret){
  echo '登録されました';
  echo '<br>';
  echo '<a href="index.php">投稿一覧へ戻る</a>';//投稿一覧先へのリンクを用意する
}else{
  echo $db->error;
}
?>
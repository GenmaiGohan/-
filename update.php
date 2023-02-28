<?php 
require('dbconnect.php');
$stmt = $db->prepare('select * from messages where id=?'); //id=?として後でidを指定する
if(!$stmt){
  die($db->error);
}
//idを指定する
$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$stmt->bind_param('i',$id);//第一引数を数字型のiにして第二引数は$idにする
$stmt->execute();

$stmt->bind_result($id, $name, $message, $created);
$result = $stmt->fetch();//データベース(tbase)からデータを取り出す
if(!$result){
  die('投稿情報の指定が正しくありません');
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>投稿の編集</title>
  </head>
  <body>
    <h2>編集してください</h2>
    <form action="update_do.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>"> <!--idを指定する-->
	    <input type="text" name="name" placeholder="名前を記入" value="<?php echo htmlspecialchars($name);?>"><br />
      <textarea
        name="message"
        cols="50"
        rows="5"
        placeholder="質問内容を入力"><?php echo htmlspecialchars($message);?></textarea><br/>
      <button type="submit">編集を確定する</button>
    </form>
  </body>
</html>
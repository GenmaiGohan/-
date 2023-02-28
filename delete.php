<?php 
require('dbconnect.php');
$stmt = $db->prepare('select * from messages where id=?');
if(!$stmt){
  die($db->error);
}
$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$stmt->bind_param('i',$id);
$stmt->execute();

$stmt->bind_result($id, $name, $message, $created);
$result = $stmt->fetch();
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
    <title>投稿の削除</title>
  </head>
  <body>
    <h2>本当に削除しますか？</h2>
    <form action="delete_do.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" value="削除する">
      <p><a href ="index.php">投稿一覧へ戻る</a></p>
    </form>
</body>
</html>
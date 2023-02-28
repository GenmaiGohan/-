<?php
require('dbconnect.php');

$messages =$db->query('select * from messages order by id desc'); //messagesから全ての情報を取得し,idの大きい順に並べる
if(!$messages){
    die($db->error);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
</head>
<body>
    <h1>投稿一覧</h1>

    <p><a href="input.html">▶️ここから新規投稿してください</a></p> <!--さっき作ったinput.htmlに移動させる-->
    <?php while ($message= $messages->fetch_assoc()): ?>      

<!--投稿者,メッセージ,編集機能,削除機能,投稿時間を表示する--->
    <div>
        <font size="1">
        <h2>投稿者：<?php echo htmlspecialchars($message['name']);?></h2>
        </font>
        <h3>
        <div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333; border-radius: 10px;">
            <font size="3">
                <?php echo htmlspecialchars($message['message']);?>
            </font>
        </div>
        </h3>
        <p><a href="update.php?id=<?php echo $message['id'];?>">編集</a><!--update.phpに移動-->
        <a href="delete.php?id=<?php echo $message['id']; ?>">削除</a></p><!--delete.phpに移動-->
        <time><?php echo htmlspecialchars($message['created']);?></time>
    </div>    
    <hr>
    <?php endwhile; ?>
</body>
</html>
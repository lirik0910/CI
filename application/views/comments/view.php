<h4>Комментарии</h4>
<?php foreach ($comments as $comment): ?>
    <p><?php echo $comment['login'];?></p>
    <p><?php echo $comment['date'];?></p>
    <p><?php echo $comment['text'];?></p>
<? endforeach; ?>

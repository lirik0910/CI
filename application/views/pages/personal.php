<p>Имя: <?php echo $firstname . ' ' . $secondname; ?></p>
<p>Дата рождения: <?php echo $age; ?></p>
<p>Страна: <?php echo $country; ?></p>
<p>Город: <?php echo $city; ?></p>
<a href="<?php echo site_url('blogers/update/' . $login); ?>">Изменить данные</a>
<br>
<p><a href="<?php echo site_url('articles/create'); ?>">Написать статью</a></p>
<br>
<?php foreach($articles as $article): ; ?>
    <p><?php echo $article['title']; ?></p>
    <p><?php echo $article['date']; ?></p>
    <a href="<?php echo site_url('articles/update/' . $article['id']); ?>">Изменить статью</a>
    <a href="<?php echo site_url('articles/delete/' . $article['id']); ?>">Удалить статью</a>
    <p><?php echo $article['text']; ?></p>
    <p><a href="<?php echo site_url('articles/viewOne/' . $article['id']); ?>">Читать статью</a></p>
    <br>
<?php endforeach; ?>



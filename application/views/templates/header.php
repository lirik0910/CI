<html>
    <head>
        <title>CI_blog</title>
    </head>
    <body>
    <a href="<?php echo site_url('pages/view'); ?>">Главная</a>
    <a href="<?php echo site_url('pages/viewOne'); ?>">Персональная страица</a>
    <?php var_dump($this->blogers_model->is_logged_in()); ?>

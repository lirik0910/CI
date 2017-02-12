<?php
//var_dump($this->blogers_model->is_logged_in());
if ($this->blogers_model->is_logged_in()){
foreach ($this->session->__get('user') as $item => $value):
    if($item == 'login'): ?>
        <p>Логин: <?php echo $value; ?></p>
        <a href="<?php echo site_url('pages/viewOne'); ?>">Персональная страица</a>
        <a href="<?php echo site_url('blogers/logout'); ?>">Выйти</a>
    <?php endif;
 endforeach;
} else{ ?>
    <a href="<?php echo site_url('blogers/login'); ?>">Войти</a>
    <a href="<?php echo site_url('blogers/registration'); ?>">Регистрация</a>
<?php } ?>
<br>
<br>
<?php echo $date;?>
<br>
<br>
<?php
 echo 'Main page';
 ?>

<?php
var_dump($this->blogers_model->is_logged_in());
//var_dump($this->session->__get('user'));
if ($this->blogers_model->is_logged_in()):
foreach ($this->session->__get('user') as $item => $value):
    if($item == 'login'): ?>
        <p>Логин: <?php echo $value; ?></p>
    <?php endif;
 endforeach;
 endif;
echo $date;?>
<br>
<br>
<?php
 echo 'Main page';
 ?>

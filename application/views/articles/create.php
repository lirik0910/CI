Пользователь: <?php echo $user; ?>
<br>
<?php echo validation_errors(); ?>

<?php echo form_open('articles/create'); ?>

<h5>Title</h5>
<input type="text" name="title" value="<?php echo set_value('title'); ?>" size="50" />

<h5>Text</h5>
<input type="text" name="text" value="<?php echo set_value('text'); ?>" size="150" />
<br>
<br>
<div><input type="submit" value="Submit" /></div>

</form>

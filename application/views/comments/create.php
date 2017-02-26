<p>Оставить комментарий</p>
<?php echo validation_errors(); ?>

<?php echo form_open('comments/create/' . $article_id); ?>

<input type="text" name="text" value="<?php echo set_value('text'); ?>" size="150" />
<br>
<p><input type="submit" value="Оставить" /></p>

</form>
<?php echo validation_errors(); ?>

<?php echo form_open('blogers/login'); ?>

<h5>Login</h5>
<input type="text" name="login" value="<?php echo set_value('login'); ?>" size="20" />

<h5>Password</h5>
<input type="text" name="password" value="<?php echo set_value('password'); ?>" size="20" />
<br>
<br>
<div><input type="submit" value="Submit" /></div>

</form>

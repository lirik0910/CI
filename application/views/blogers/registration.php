<?php echo validation_errors(); ?>

<?php echo form_open('blogers/registration'); ?>

<h5>Firstname</h5>
<input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" size="50" />

<h5>Secondname</h5>
<input type="text" name="secondname" value="<?php echo set_value('secondname'); ?>" size="50" />

<h5>Login</h5>
<input type="text" name="login" value="<?php echo set_value('login'); ?>" size="20" />

<h5>Password</h5>
<input type="text" name="password" value="<?php echo set_value('password'); ?>" size="20" />

<h5>Password Confirm</h5>
<input type="text" name="passconf" value="<?php echo set_value('passconf'); ?>" size="20" />
<br>
<br>
<div><input type="submit" value="Submit" /></div>

</form>

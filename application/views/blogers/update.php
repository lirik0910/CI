<?php //var_dump($countries); die; ?>
<?php echo validation_errors(); ?>

<?php echo form_open('blogers/update/' . $login); ?>

<h5>Firstname</h5>
<input type="text" name="firstname" value="<?php echo $firstname; ?>" size="50" />

<h5>Secondname</h5>
<input type="text" name="secondname" value="<?php echo $secondname; ?>" size="50" />

<h5>Age</h5>
<input type="date" name="age" value="<?php //echo $date; ?>" size="20" />

<h5>Country</h5>
<select name="country" onchange="loadCity(this)">
    <?php foreach ($countries as $key => $value): ?>
        <?php foreach ($value as $k => $v):?>
            <?php if ($k == 'name'): ?>
                <option><?php echo $v; ?></option>
            <?php endif; ?>
        <?php endforeach;; ?>
    <?php endforeach; ?>
</select>

<h5>City</h5>
<input type="text" name="city" value="<?php echo $city; ?>" size="30" />
<br>
<br>
<div><input type="submit" value="Submit" /></div>

</form>
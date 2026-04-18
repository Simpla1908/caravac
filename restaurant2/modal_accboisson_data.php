<?php
include '../bdd/connexion_mysql.php';
$result = mysql_query("SELECT * FROM  accompagnmnt_boisson ORDER BY lib") or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
?>
<input type="checkbox" id="id<?php echo $row['id'];?>" name="accboisson[]" value="<?php echo $row['lib'];?>" class="accboisson_class">
<label for="id<?php echo $row['id'];?>"><?php echo $row['lib'];?></label><br>

<?php
}
mysql_free_result($result);
?>
</div>
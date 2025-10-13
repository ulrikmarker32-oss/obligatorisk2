<?php
?>
<h3>Slett student <h3>
<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema">
Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
<input type="submit" value="Slett student" name="slettStudentKnapp" id="slettStudentKnapp" />
</form>

<?php
if (isset($_POST ["slettStudentKnapp"]))
{
include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */
$brukernavn=$_POST ["brukernavn"];
$sqlSetning="DELETE FROM klasse WHERE brukernavn='$brukernavn';";
mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
/* SQL-setning sendt til database-serveren */
print ("F&oslash;lgende student er n&aring; slettet: $brukernavn <br />");
}
?>

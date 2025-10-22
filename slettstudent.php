<?php
?>

<script src="funksjoner.js"> </script>

<h3>Slett student <h3>
<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onsubmit="return bekreft()">
Brukernavn:
  <select id="brukernavn" name="brukernavn" required>
    <option value="">-- Velg student --</option>
    <?php
include("db-tilkobling.php");
$sqlSetning = "SELECT brukernavn FROM student ORDER BY brukernavn;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die ("Ikke mulig &aring; hente brukernavn");
while ($rad = mysqli_fetch_array($sqlResultat)) {
  $brukernavn = $rad["brukernavn"]
    echo "<option value='$brukernavn'>$brukernavn</option>";
}
?>
  </select>
  <br><br>
<input type="submit" value="Slett student" name="slettStudentKnapp" id="slettStudentKnapp" />
</form>

<?php
if (isset($_POST ["slettStudentKnapp"]))
{
include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */
$brukernavn=$_POST ["brukernavn"];
$sqlSetning="DELETE FROM student WHERE brukernavn='$brukernavn';";
mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
/* SQL-setning sendt til database-serveren */
print ("F&oslash;lgende student er n&aring; slettet: $brukernavn <br />");
}
?>

<?php
?>

<script src="funksjoner.js"> </script>

<h3>Slett klasse <h3>
<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return bekreft()">
Klassekode:
  <select id="klassekode" name="klassekode" required>
    <option value="">-- Velg klasse --</option>
    <?php
include("db-tilkobling.php");
$sqlSetning = "SELECT klassekode FROM klasse ORDER BY klassekode;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente klassekoder");
while ($rad = mysqli_fetch_array($sqlResultat)) {
  $klassekode = $rad["klassekode"];
  echo "<option value='$klassekode'>$klassekode</option>";
}
?>
  </select>
  <br><br>
  
<input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" />
</form>

<?php
if (isset($_POST ["slettKlasseKnapp"]))
{
include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */
$klassekode=$_POST ["klassekode"];
$sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode';";
mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
/* SQL-setning sendt til database-serveren */
print ("F&oslash;lgende studium er n&aring; slettet: $klassekode <br />");
}
?>

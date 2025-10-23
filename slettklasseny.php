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
if (isset($_POST["slettKlasseKnapp"])) {
  include("db-tilkobling.php"); 
 $klassekode=$_POST ["klassekode"];

  $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
  $resultat = mysqli_query($db, $sqlSetning);

  if ($resultat) {
    print("Følgende klasse er nå slettet: <strong>$klassekode</strong><br>");
  } else {
    $feilmelding = mysqli_error($db);
    
   
    if (str_contains($feilmelding, 'foreign key constraint')) {
      print("Kan ikke slette klassen <strong>$klassekode</strong> fordi det finnes studenter registrert i denne klassen.<br>");
    } else {
      print("En feil oppstod ved sletting av klasse. Vennligst prøv igjen eller kontakt administrator.</span><br>");
     

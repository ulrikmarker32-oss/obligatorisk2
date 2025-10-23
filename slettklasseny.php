<?php
include("db-tilkobling.php");

?>

<script src="funksjoner.js"></script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return bekreft()">
  Klassekode:
  <select id="klassekode" name="klassekode" required>
    <option value="">-- Velg klasse --</option>
    <?php
    $sqlSetning = "SELECT klassekode FROM klasse ORDER BY klassekode;";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig &aring; hente klassekoder");

    while ($rad = mysqli_fetch_array($sqlResultat)) {
      $klassekode = htmlspecialchars($rad["klassekode"]);
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
  mysqli_set_charset($db, "utf8mb4");
  $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);

 
  $sjekkSql = "SELECT COUNT(*) AS antall FROM student WHERE klassekode='$klassekode';";
  $sjekkResultat = mysqli_query($db, $sjekkSql);

  if (!$sjekkResultat) {
    echo "Kunne ikke sjekke klassen i databasen. Pr&oelig;v igjen senere.";
  } else {
    $rad = mysqli_fetch_assoc($sjekkResultat);
    if ($rad['antall'] > 0) {
     
      echo "Kan ikke slette klassen <strong>$klassekode</strong> fordi det finnes studenter registrert i denne klassen.<br>";
    } else {
     
      $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
      $resultat = mysqli_query($db, $sqlSetning);

      if ($resultat) {
        print "F&oelig;lgende klasse er nå slettet: <strong>$klassekode</strong><br>";
   
       
      }
    }
  }
}
?>

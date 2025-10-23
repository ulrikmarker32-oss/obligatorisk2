<?php
include("db-tilkobling.php");
mysqli_set_charset($db, "utf8mb4"); // sikrer æøå

?>

<script src="funksjoner.js"></script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return bekreft()">
  Klassekode:
  <select id="klassekode" name="klassekode" required>
    <option value="">-- Velg klasse --</option>
    <?php
    $sqlSetning = "SELECT klassekode FROM klasse ORDER BY klassekode;";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente klassekoder");

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

  // 🔍 Først sjekk om klassen har studenter
  $sjekkSql = "SELECT COUNT(*) AS antall FROM student WHERE klassekode='$klassekode';";
  $sjekkResultat = mysqli_query($db, $sjekkSql);

  if (!$sjekkResultat) {
    echo "<span style='color:red;'>Kunne ikke sjekke klassen i databasen. Prøv igjen senere.</span>";
  } else {
    $rad = mysqli_fetch_assoc($sjekkResultat);
    if ($rad['antall'] > 0) {
      // 🚫 Klassen har studenter — gi en brukervennlig feilmelding
      echo "<span style='color:red;'>Kan ikke slette klassen <strong>$klassekode</strong> fordi det finnes studenter registrert i denne klassen.</span><br>";
    } else {
      // ✅ Klassen er tom — prøv å slette
      $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
      $resultat = mysqli_query($db, $sqlSetning);

      if ($resultat) {
        echo "<span style='color:green;'>Følgende klasse er nå slettet: <strong>$klassekode</strong></span><br>";
      } else {
        // 😕 Uventet feil
        echo "<span style='color:red;'>En feil oppstod ved sletting av klasse. Vennligst prøv igjen eller kontakt administrator.</span><br>";
        // (valgfritt) logg teknisk info uten å vise det til brukeren:
        error_log(mysqli_error($db));
      }
    }
  }
}
?>

<?php /* registrer-emne */
/*
/* Programmet lager et html-skjema for å registrere et emne
/* Programmet registrerer data i databasen
*/
?>
<h3>Registrer emne </h3>
<form method="post" action="" id="registrerEmneSkjema" name="registrerEmneSkjema">
Emnekode <input type="text" id="emnekode" name="emnekode" required /> <br/>
Emnenavn <input type="text" id="emnenavn" name="emnenavn" required /> <br/>
Studiumkode <input type="text" id="studiumkode" name="studiumkode" required /> <br/>
<input type="submit" value="Registrer emne" id="registrerEmneKnapp" name="registrerEmneKnapp" />
<input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>
<?php
if (isset($_POST ["registrerEmneKnapp"]))
{
$emnekode=$_POST ["emnekode"];
$emnenavn=$_POST ["emnenavn"];
$studiumkode=$_POST ["studiumkode"];
if (!$emnekode || !$emnenavn || !$studiumkode)
{
print ("Alle felt m&aring; fylles ut");
}
else
{
include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */
$sqlSetning="SELECT * FROM emne WHERE emnekode='$emnekode';";
$sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
$antallRader=mysqli_num_rows($sqlResultat);
if ($antallRader!=0) /* faget er registrert fra før */
{
print ("Emnet er registrert fra f&oslashr");
}
else
{
$sqlSetning="INSERT INTO emne (emnekode,emnenavn,studiumkode)
VALUES('$emnekode','$emnenavn','$studiumkode');";
mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
print ("F&oslash;lgende emne er n&aring; registrert: $emnekode $emnekode $studiumkode");
}
}
}
?>

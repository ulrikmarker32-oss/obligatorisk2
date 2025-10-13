<?php /* vis-alle-emner */
/*
/* Programmet skriver ut alle registrerte emner
*/
include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */
$sqlSetning="SELECT * FROM student ORDER BY brukernavn;";
$sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); /*
SQL-setning sendt til database-serveren */
$antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */
print ("<h3>Registrerte studenter </h3>");
print ("<table border=1>");
print ("<tr><th align=left>brukernavn</th> <th align=left>fornavn</th> <th allign=left>etternavn</th> <th align=left>klassekode</th>
</tr>");
for ($r=1;$r<=$antallRader;$r++)
{
$rad=mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultatet */
$brukernavn=$rad["brukernavn"];
$fornavn=$rad["fornavn"];
$etternavn=$rad["etternavn"];
$klassekode=$rad["klassekode"];
print ("<tr> <td> $brukernavn </td> <td> $fornavn </td> <td> $etternavn </td> <td> $klassekode </td> </tr>");
}
print ("</table>");
?>


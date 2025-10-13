<?php  
?> 

  <h3>Registrer ny student</h3>
  <form method="post" action=""id="registrerKlasseKnapp" name="registrerKlasseKnapp">
    Brukernavn <input type="text" id="klassekode" name="klassekode" required><br>
    Fornavn <input type="text" id="klassenavn" name="klassenavn" required><br>
    Etternavn<input type="text" id="studiumkode" name="studiumkode" required><br>
    Klassekode<input type="text" id="studiumkode" name="studiumkode" required><br>
    <input type="submit" value="Registrer klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" />
    <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
  </form>

<?php 
if (isset($_POST ["registrerKlasseKnapp"]))
    {
        $klassekode=$_POST ["klassekode"];
        $klassenavn=$_POST ["klassenavn"];
        $studiumkode=$_POST ["studiumkode"];

        if (!$klassekode || !$klassenavn || !$studiumkode)
        {
            print ("Alle feltene m&aring; fylles ut");
        }
    else 
         {
            include("db-tilkobling.php");

            $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
            $sqlresultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra databasen");
            $antallRader=mysqli_num_rows($sqlresultat);

            if ($antallRader!=0)
            {
                print ("Klassen er registrert fra f&oslashr");
            }
            else 
            {
             $sqlSetning="INSERT INTO klasse (klassekode, klassenavn, studiumkode)
VALUES('$klassekode', '$klassenavn', '$studiumkode');";
            mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registerer i data basen");

            print ("Dette ble n&aring; registrert: $klassekode $klassenavn $studiumkode");
            }
        }
    }
?>

<?php  
?> 

  <h3>Registrer ny student</h3>
  <form method="post" action=""id="registrerStudentKnapp" name="registrerStudentKnapp">
    Brukernavn <input type="text" id="brukernavn" name="brukernavn" required><br>
    Fornavn <input type="text" id="fornavn" name="fornavn" required><br>
    Etternavn<input type="text" id="etternavn" name="etternavn" required><br>
      
      <select id="klassekode" name="klassekode" required>
      <option value="">-- Velg klassekode --</option>
      <?php
      include("db-tilkobling.php");
      $sqlSetning = "SELECT DISTINCT klassekode FROM klasse ORDER BY klassekode;";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die ("Ikke mulig &aring; klassekode");
      while ($rad = mysqli_fetch_array($sqlResultat)) {
        $klassekode = $rad["klassekode"];
        echo "<option value= '$klassekode'>$klassekode</option>";
      }
      ?>
    </select>
    <br>
    
    <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
    <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
  </form>

<?php 
if (isset($_POST ["registrerStudentKnapp"]))
    {
        $brukernavn=$_POST ["brukernavn"];
        $fornavn=$_POST ["fornavn"];
        $etternavn=$_POST ["etternavn"];
        $klassekode=$_POST ["klassekode"];

        if (!$brukernavn || !$fornavn|| !$etternavn || !$klassekode)
        {
            print ("Alle feltene m&aring; fylles ut");
        }
    else 
         {
            include("db-tilkobling.php");

            $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
            $sqlresultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra databasen");
            $antallRader=mysqli_num_rows($sqlresultat);

            if ($antallRader!=0)
            {
                print ("studenten er registrert fra f&oslashr");
            }
            else 
            {
             $sqlSetning="INSERT INTO student (brukernavn, fornavn, etternavn, klassekode) 
             VALUES('$brukernavn', '$fornavn', '$etternavn', '$klassekode');";
             mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registerer i data basen");

            print ("Dette ble n&aring; registrert: $brukernavn $fornavn $etternavn $klassekode");
            }
        }
    }
?>

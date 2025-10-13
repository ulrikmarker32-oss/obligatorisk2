<?php
/* db-tilkobling.php */
/* Riktig oppsett for USN Dokploy */

$host = "mysql.dokploy.usn.no";   // Database-server
$username = "ulmar4697";          // Ditt brukernavn
$password = "eaddulmar4697";       // Passordet for databasen
$database = "ulmar4697";          // Databasenavn (ofte lik brukernavn)

// Opprett tilkobling
$db = mysqli_connect($host, $username, $password, $database);

// Sjekk om tilkobling fungerer
if (!$db) {
    die("Feil ved tilkobling til databasen: " . mysqli_connect_error());
}
?>

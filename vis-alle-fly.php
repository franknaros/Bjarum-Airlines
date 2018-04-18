<?php /*vis-alle-fly*/

session_start();
@$innloggetBruker=$_SESSION["brukernavn"];

	if (!$innloggetBruker)
	{
		print("You need to log in to access this page<br/>");
	}
	else
	{

include("start.html");


    include("db-tilkobling.php");  /*tilkobling til database-serveren utført og valg av databasen foretatt */

    $sqlSetning="SELECT * FROM airplane ORDER BY airplaneID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat); /*antall radar i resultatet beregnet*/

    print ("<h3>Registered flights</h3>");//Overskift
    print ("<table border=1>"); /*starten på tabellen definert*/
    print ("<tr><th align=left>Airplane ID</th><th align=left>Aircraft Type</th></tr>");/*overskriftsrad skrevet ut*/

    for($r=1; $r<=$antallRader; $r++){
        $rad=mysqli_fetch_array($sqlResultat); /*ny rad hentet fra spøringsresultatet*/
        $airplaneid=$rad["airplaneID"];
        $airplanetype=$rad["aircraftType"];

        print ("<tr><td>$airplaneid</td><td>$airplanetype</td></tr>"); /*ny rad skrevet*/
    }
    print ("</table>"); /*slutten på tabellen definiert */

    include("slutt.html");
}
?>

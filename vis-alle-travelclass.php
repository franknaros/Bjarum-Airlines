<?php /*vis-alle-studenter*/

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

    $sqlSetning="SELECT * FROM travelclass ORDER BY travelClassID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat); /*antall radar i resultatet beregnet*/

    print ("<h3>Registered Travel Classes </h3>");//Overskift
    print ("<table border=1>"); /*starten på tabellen definert*/
    print ("<tr><th align=left>Travel Class ID</th><th align=left>Travel Class</th></tr>");/*overskriftsrad skrevet ut*/

    for($r=1; $r<=$antallRader; $r++){
        $rad=mysqli_fetch_array($sqlResultat);
        
        $travelclass_id=$rad[0];
        $travelclasscode=$rad[1];


        print ("<tr><td>$travelclass_id</td><td>$travelclasscode</td></tr>");
    }
    print ("</table>"); /*slutten på tabellen definiert */

    include("slutt.html");
}
?>

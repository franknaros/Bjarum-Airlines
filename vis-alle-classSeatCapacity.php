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

    $sqlSetning="SELECT * FROM classseatcapacity ORDER BY flightID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat); /*antall radar i resultatet beregnet*/

    print ("<h3>Registered Class Seat Capacities</h3>");//Overskift
    print ("<table border=1>"); /*starten på tabellen definert*/
    print ("<tr><th align=left>Flight ID</th><th align=left>Seat Capacity</th><th align=left>Travel Class ID</th></tr>");/*overskriftsrad skrevet ut*/

    for($r=1; $r<=$antallRader; $r++){
        $rad=mysqli_fetch_array($sqlResultat); /*ny rad hentet fra spøringsresultatet*/
        $FlightID=$rad["flightID"];
        $SeatCapacity=$rad["seatCapacity"];
        $TravelClassID=$rad["travelClassID"];


        print ("<tr><td>$FlightID</td><td>$SeatCapacity</td><td>$TravelClassID</td></tr>"); /*ny rad skrevet*/
    }
    print ("</table>"); /*slutten på tabellen definiert */

    include("slutt.html");
}
    ?>

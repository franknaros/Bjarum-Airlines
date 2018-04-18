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

    $sqlSetning="SELECT * FROM flight ORDER BY flightNumber;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat); /*antall radar i resultatet beregnet*/

    print ("<h3>Registered flights</h3>");//Overskift
    print ("<table border=1>"); /*starten på tabellen definert*/
    print ("<tr><th align=left>Airplane ID</th><th align=left>Arrival Time</th><th align=left>Flight ID</th><th align=left>Departure date</th><th align=left>Departure time</th><th align=left>Flight number</th><th align=left>From location</th><th align=left>To location</th></tr>");/*overskriftsrad skrevet ut*/

    for($r=1; $r<=$antallRader; $r++){
        $rad=mysqli_fetch_array($sqlResultat); /*ny rad hentet fra spøringsresultatet*/
        $airplaneID=$rad["airplaneID"];
        $arrivalTime=$rad["arrivalTime"];
        $flight_id=$rad["flightID"];
        $flight_departure_date=$rad["departureDate"];
        $flight_departure_time=$rad["departureTime"];
        $flight_number=$rad["flightNumber"];
        $fromLocation=$rad["fromLocation"];
        $toLocation=$rad["toLocation"];

        print ("<tr><td>$airplaneID</td><td>$arrivalTime</td><td>$flight_id</td><td>$flight_departure_date</td><td>$flight_departure_time</td><td>$flight_number</td><td>$fromLocation</td><td>$toLocation</td></tr>"); /*ny rad skrevet*/
    }
    print ("</table>"); /*slutten på tabellen definiert */

    include("slutt.html");
}
?>

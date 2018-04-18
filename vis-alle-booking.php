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

    $sqlSetning="SELECT bookingID, date(bookingDate) AS bookingDate, passengerID, flightID, travelClassID FROM booking ORDER BY bookingID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("It has not been possible to access the database, try later");
    $antallRader=mysqli_num_rows($sqlResultat); /*antall radar i resultatet beregnet*/

    print ("<h3>Registered Bookings</h3>");//Overskift
    print ("<table border=1>"); /*starten på tabellen definert*/
    print ("<tr><th align=left>Booking ID</th><th align=left>Booking Date</th><th align=left>Passenger ID</th><th align=left>Flight ID</th><th align=left>Travel class ID</th></tr>");/*overskriftsrad skrevet ut*/

    for($r=1; $r<=$antallRader; $r++){
        $rad=mysqli_fetch_array($sqlResultat); /*ny rad hentet fra spøringsresultatet*/
        $booking_id=$rad["bookingID"];
        $bookingdate=$rad["bookingDate"];
        $passanger_id=$rad["passengerID"];
        $flight_id=$rad["flightID"];
        $class=$rad["travelClassID"];

        print ("<tr><td>$booking_id</td><td>$bookingdate</td><td>$passanger_id</td><td> $flight_id</td><td> $class</td></tr>"); /*ny rad skrevet*/
    }
    print ("</table>"); /*slutten på tabellen definiert */

    include("slutt.html");
}

?>

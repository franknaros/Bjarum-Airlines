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

    $sqlSetning="SELECT * FROM passenger ORDER BY passengerID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat); /*antall radar i resultatet beregnet*/

    print ("<h3>Registered Passengers</h3>");//Overskift
    print ("<table border=1>"); /*starten på tabellen definert*/
    print ("<tr><th align=left>First name</th><th align=left>Last name</th><th align=left>Address</th><th align=left>Email</th><th align=left>Phone No</th><th align=left>Passenger ID</th></tr>");/*overskriftsrad skrevet ut*/

    for($r=1; $r<=$antallRader; $r++){
        $rad=mysqli_fetch_array($sqlResultat); /*ny rad hentet fra spøringsresultatet*/
        $address=$rad["address"];
        $email=$rad["email"];
        $firstname=$rad["firstName"];
        $lastname=$rad["lastName"];
        $passengerID=$rad["passengerID"];
        $phoneno=$rad["phoneNo"];

        print ("<tr><td>$firstname</td><td>$lastname</td><td> $address</td><td>$email</td><td>$phoneno</td><td>$passengerID</td></tr>"); /*ny rad skrevet*/
    }
    print ("</table>"); /*slutten på tabellen definiert */

    include("slutt.html");
}
?>

<?php  /* Registrer bruker - programmet registrerer en ny bruker i databasen */

session_start();
@$innloggetBruker=$_SESSION["brukernavn"];

	if (!$innloggetBruker)
	{
		print("You need to log in to access this page<br/>");
	}
	else
	{

include("start.html");


?>

<h3>Register Seat Capacity</h3>
<form method="Post" action="" id="finnClassSkjema" name="finnClassSkjema" >
    Travel Class ID:
    <select name='travelID' id='travelID'>
        <?php include("listeboks-travelID.php"); ?>
          </select><br/>

<form method="Post" action="" id="finnFlySkjema" name="finnFlySkjema" >
    Flight ID:
    <select name='flightID' id='flightID'>
        <?php include("listeboks-flightID.php"); ?>
          </select><br/>

<form action="" id="registrerSeatCapacitySkjema" name="registrerSeatCapacitySkjema" method="post">

    Seat Capacity: <input name="seatCapacity" type="text" id="seatCapacity"><br/><br/>



    <input type="submit" name="registrerSeatCapacityKnapp" value="Register Seat Capacity" >
    <input type="reset" name="nullstill" value="Reset" id="nullstill"><br/>
</form>

<?php
    @$registrerSeatCapacityKnapp=$_POST["registrerSeatCapacityKnapp"];
    if ($registrerSeatCapacityKnapp)
    {
        include("db-tilkobling.php");

        $FlightID=$_POST["flightID"];
        $SeatCapacity=$_POST["seatCapacity"];
        $TravelClassID=$_POST["travelID"];



        if(!$FlightID || !$SeatCapacity || !$TravelClassID)
        {
            print ("All fields must be filled<br/>");
        }

        else

          {
          /*
            include("validering.php");
            $lovligFlightID=validerEtternavn($FlightID);
            $lovligSeatCapacity=validerAdresse($SeatCapacity);
            $lovligTravelClassID=validerFornavn($TravelClassID);


            if (!$lovligFlightID)
            {
              print("Flight ID er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligSeatCapacity)
            {
              print("Seat Capacity er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligTravelClassID)
            {
              print("Travel Class ID er ikke korrekt fylt ut<br/>");
            }

            if ($FlightID && $SeatCapacity && $TravelClassID)

            {
                */
                
            include("db-tilkobling.php");
/*
              $sqlSetning="SELECT * FROM classseatcapacity WHERE travelClassID= '$TravelClassID' AND seatCapacity= '$SeatCapacity';";

              $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
              $antallRader=mysqli_num_rows($sqlResultat);

              if ($antallRader !=0)
                  {
                      print ("Class seat capacity er registrert fra f&oslash;r");

                  }
              else
                  { */
                     $sqlSetning="INSERT INTO classseatcapacity (flightID, seatCapacity, travelClassID) VALUES('$FlightID', '$SeatCapacity', '$TravelClassID');";
                      mysqli_query($db,$sqlSetning) or die ("It has not been possible to access the database, try later.");
            /*SQL setning sendt til database serveren*/

                  print("The following seat capacity has been registered for flight with ID $FlightID: $SeatCapacity");/*melding skrevet */
              }
            }

    include("slutt.html");
}
?>

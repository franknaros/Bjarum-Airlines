<?php  /* Registrer bruker - programmet registrerer en ny bruker i databasen */

session_start();
@$innloggetBruker=$_SESSION["brukernavn"];

	if (!$innloggetBruker)
	{
		print("You need to log in to access this page <br/>");
	}
	else
	{

include("start.html");

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/jonthornton/jquery-timepicker/master/jquery.timepicker.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/jonthornton/jquery-timepicker/master/jquery.timepicker.min.js">


<script>
  $(function() {
    $( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+6M " });});
  </script>
<script>
    $(function() {
$('#timepicker').timepicker({ 'scrollDefault': 'now' }) });
 </script>
<h3>Register Booking information</h3>


<form method="Post" action="" id="finnFlySkjema" name="finnFlySkjema" >
    Flight ID:
    <select name='flightID' id='flightID'>
        <?php include("listeboks-flightID.php"); ?>
    </select><br/>
<form method="Post" action="" id="finnClassSkjema" name="finnClassSkjema" >
    Travel Class:
    <select name='classID' id='classID'>
        <?php include("listeboks-classID.php"); ?>
        </select><br/>
<form method="Post" action="" id="finnClassSkjema" name="finnClassSkjema" >
    Passenger ID:
    <select name='passangerID' id='passangerID'>
        <?php include("listeboks-passangerID.php"); ?>
        </select><br/>

<form action="" id="registrerBookingSkjema" name="registrerBookingSkjema" method="post">
    Booking ID: <input name="bookingID" type="text" id="bookingID"><br/><br/>
    


    <input type="submit" name="registrerBookingKnapp" value="Register Booking" >
    <input type="reset" name="nullstill" value="Reset" id="nullstill"><br/><br/>
</form>

<?php
    @$registrerBookingKnapp=$_POST["registrerBookingKnapp"];
    if ($registrerBookingKnapp)
    {
        include("db-tilkobling.php");

        $booking_id=$_POST["bookingID"];
        
        $passanger_id=$_POST["passangerID"];
        $flight_id=$_POST["flightID"];
        $class=$_POST["classID"];


        if(!$booking_id  || !$passanger_id || !$flight_id || !$class)
        {
            print ("All fields must be filled<br/>");
        }
        else

          {
/*            include("validering.php");
            $lovligBooking_id=validerBookingID($booking_id);
            $lovligBookingdate=validerBookingdate($bookingdate);
            $lovligPassanger_id=validerPassasjerID($passanger_id);
            $lovligFlight_id=validerFlightid($flight_id);
            $lovligClass=validerClass($class;
          }


            if (!$lovligBooking_id)
            {
              print("Booking ID er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligBookingdate)
            {
              print("Booking Date er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligPassanger_id)
            {
              print("Passasjer ID er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligFlight_id)
            {
              print("Flight ID er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligClass)
            {
              print("Class er ikke korrekt fylt ut<br/>");
            }

            if ($booking_id && $bookingdate && $passanger_id && $flight_id && $Class)


            include("db-tilkobling.php");
/*
              $sqlSetning="SELECT * FROM booking WHERE bookingID= '$booking_id' AND passangerID= '$passenger_id';";

              $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
              $antallRader=mysqli_num_rows($sqlResultat);

              if ($antallRader !=0)
                  {
                      print ("Billeten er registrert fra f&oslash;r");

                  }
              else
                  { */
                     $sqlSetning="INSERT INTO booking (bookingID, flightID, passengerID, travelClassID) VALUES('$booking_id', '$flight_id', '$passanger_id', '$class');";
                      mysqli_query($db,$sqlSetning) or die ("It has not been possible to access the database, try later.");


                  print("The following booking is now registered: <br/>Booking ID:$booking_id  Passenger ID:$passanger_id  Flight ID:$flight_id  Travel Class ID:$class<br/> Date of booking:" . date("Y/m/d") . "<br>  Time of booking:" . date("H:ia"). "<br>");

            }

          }

    include("slutt.html");
    }
?>

<?php  

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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/jonthornton/jquery-timepicker/master/jquery.timepicker.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/jonthornton/jquery-timepicker/master/jquery.timepicker.min.js">


<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
<script>
    $(function() {
$('#scrollDefaultExample').timepicker({ 'scrollDefault': 'now' }) });
 </script>
<h3>Register Flight Information</h3>
<script type="text/javascript" src="validering.js"> </script>


<form action="" id="registrerFlightSkjema" name="registrerFlightSkjema" method="post">


  <form method="Post" action="" id="finnFlySkjema" name="finnFlySkjema" >
      Airplane ID:
      <select name='flykode' id='flykode'>
          <?php include("listeboks-flykode.php"); ?>
      </select><br/>
    
    Flight ID: <input name="flight_id" type="text" id="flight_id"><br/>
    Flight departure date: <input name="departureDate" type="text" id="datepicker"><br/>
    Flight departure time: <input name="departureTime" type="time" id="timepicker"><br/>
    Arrival Time: <input name="arrivalTime" type="time" id="arrivalTime"><br/>
    Flight Number: <input name="flightNumber" type="text" id="flightNumber"><br/>
    <p>From Location:
      <select name="fromLocation">
      <option value="Gardermoen" selected>Gardermoen</option>
      <option value="Torp">Torp</option>
      <option value="Jarlsberg">Jarlsberg</option>
      <option value="Leknes lufthavn">Leknes lufthavn</option>
      </select>
      </p>
      <p>To Location:
      <select name="toLocation">
      <option value="Barcelona" selected>Barcelona</option>
      <option value="Florida">Florida</option>
      <option value="Tokyo">Tokyo</option>
      <option value="Trondheim">Trondheim</option>
      </select>
      </p><br/>


    <input type="submit" name="registrerFlightKnapp" value="Register Flight" >
    <input type="reset" name="nullstill" value="Reset" id="nullstill"><br/>
</form>

<?php
    @$registrerFlightKnapp=$_POST["registrerFlightKnapp"];
    if ($registrerFlightKnapp)
    {
        include("db-tilkobling.php");

        $airplaneID=$_POST["flykode"];
        $arrivalTime=$_POST["arrivalTime"];
        $flight_id=$_POST["flight_id"];
        $flight_departure_date=$_POST["departureDate"];
        $flight_departure_time=$_POST["departureTime"];
        $flight_number=$_POST["flightNumber"];
        $fromLocation=$_POST["fromLocation"];
        $toLocation=$_POST["toLocation"];

        if(!$airplaneID || !$arrivalTime || !$flight_id || !$flight_departure_date || !$flight_departure_time || !$flight_number || !$fromLocation || !$toLocation)
        {
            print ("All fields must be filled out<br/>");
        }
        /*
        else

          {
            include("validering.php");
            $lovligAirplaneID=validerFornavn($airplaneID);
            $lovligArrivalTime=validerEtternavn($arrivalTime);
            $lovligFlight_id=validerAdresse($flight_id);
            $lovligFlight_departure_date=validerTldnummer($flight_departure_date);
            $lovligFlight_departure_time=validerEmail($flight_departure_time);
            $lovligFlight_number=validerClass($flight_number);
            $lovligFromLocation=validerTicket_id($fromLocation);
            $lovligToLocation=validerToLocation_id($toLocation);


            if (!$lovligAirplaneID)
            {
              print("AirplaneID er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligArrivalTime)
            {
              print("ArrivalTime ID er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligFlight_id)
            {
              print("Flight ID er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligFlight_departure_date)
            {
              print("Flight_departure_date er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligFlight_departure_time)
            {
              print("Flight_departure_time er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligFlight_number)
            {
              print("Flight_number ikke korrekt fylt ut<br/>");
            }
            if (!$lovligFromLocation)
            {
              print("FromLocation er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligToLocation)
            {
              print("ToLocation er ikke korrekt fylt ut<br/>");
            }
            if ($AirplaneID && $ArrivalTime && $Flight_id && $Flight_departure_date && $Flight_departure_time && $Flight_number && $FromLocation && $ToLocation)

            {
            include("db-tilkobling.php");

              $sqlSetning="SELECT * FROM flight WHERE airplaneID '$airplaneID' AND flightID= '$Flight_id';";

              $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
              $antallRader=mysqli_num_rows($sqlResultat);

              if ($antallRader !=0)
                  {
                      print ("Flight er registrert fra f&oslash;r");

                  }
                  */
              else
                  {
                     $sqlSetning="INSERT INTO flight (airplaneID, arrivalTime, departureDate, departureTime, flightID, flightNumber, fromLocation, toLocation) VALUES('$airplaneID', '$arrivalTime', '$flight_departure_date', '$flight_departure_time', '$flight_id', '$flight_number', '$fromLocation', '$toLocation');";
                      mysqli_query($db,$sqlSetning) or die ("It has not been possible to access the database, try later");


                  print("The following flight has been registered:<br/> $airplaneID  $arrivalTime  $flight_id  $flight_departure_date  $flight_departure_time  $flight_number  $fromLocation  $toLocation");/*melding skrevet */
              }

}


    include("slutt.html");
    }
?>

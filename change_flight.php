<?php    /* Change flight details */
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

<h3>Change Flight Details</h3>

<script type="text/javascript" src="validering.js"> </script>

<script>
  $(function() {
    $( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+6M " });});
  </script>
<script>
    $(function() {
        $("#timepicker").timepicker({ 'scrollDefault': "now" });});
</script>

<form method="Post" action="" id="finnFlyturSkjema" name="finnFlyturSkjema" >
    Flight ID:
    <select name='flyturID' id='flyturID'>
        <?php include("listeboks-flyturID.php"); ?>
    </select><br/>
    <input type="submit" value="Find Flight" name="finnFlyturKnapp" id="finnFlyturKnapp">
    
</form>
<div id="melding"></div>
<?php
    @$finnFlyturKnapp=$_POST["finnFlyturKnapp"];
    if ($finnFlyturKnapp)
    {
        $flyturID=$_POST["flyturID"]; /* variable gitt verdier fra feltene i html skjemaet */
        
        $sqlSetning="SELECT * FROM flight WHERE  flightID='$flyturID';";
        $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");
        
        $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */
        
        if ($antallRader==0){
            print ("The given flight ID is not registered<br/>");
        }
        else
        {
            $rad=mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
            $flyturID=$rad["flightID"]; 
            $flynummer=$rad["flightNumber"];
            $reisetil=$rad["toLocation"];
            $reisefra=$rad["fromLocation"];
            $avreisedato=$rad["departureDate"];
            $avreisertid=$rad["departureTime"];
            $ankomsttid=$rad["arrivalTime"];
            $flykode=$rad["airplaneID"];
            
           
            
            print ("<form method='post' action='' id='endreFlyturSkjema' name='endreFlyturSkjema'> ");
            print ("Flight ID: <input type='text' value='$flyturID' name='flyturID' id='flyturID' readonly /><br/>");
            
            print ("Airplane ID: <select name='flykode' id='flykode'>");
            print ("<option value='$flykode'>$flykode</option>");
            include("listeboks-flykode.php");
            print ("</select><br/>");
            
            print ("Flight Number: <input type='text' value='$flynummer' name='flynummer' id='flynummer' /><br/>");
            
            
            
            print ("From: <select name='reisefra'>
      <option value='$reisefra' selected>$reisefra</option>
      <option value='Gardemoen'>Gardemoen</option>
      <option value='Torp'>Torp</option>
      <option value='Jarlsberg'>Jarlsberg</option>
      <option value='Leknes lufthavn'>Leknes lufthavn</option>
      </select> &nbsp;"); 
            print ("Destination: <select name='reisetil'>
      <option value='$reisetil' selected>$reisetil</option>
      <option value='Barcelona'>Barcelona</option>
      <option value='Florida'>Florida</option>
      <option value='Tokyo'>Tokyo</option>
      <option value='Trondheim'>Trondheim</option>
      </select><br/>");
            print ("Departure date: <input type='text' value='$avreisedato' name='avreisedato' id='datepicker' /><br/>");
            print ("Departure time: <input type='time' value='$avreisertid' name='avreisertid' id='timepicker' /><br/>");
            print ("Arrival time: <input type='time' value='$ankomsttid' name='ankomsttid' id='timepicker' /><br/>");
            
            
           
            print ("<input type='submit' value='Change Flight Details' name='endreFlyturKnapp' id='endreFlyturKnapp' >");
            print ("</form>");
        }
    }
    
    @$endreFlyturKnapp=$_POST["endreFlyturKnapp"];
    if ($endreFlyturKnapp)
    {
       $flyturID=$_POST["flyturID"];
       $flykode=$_POST["flykode"];
       $flynummer=$_POST["flynummer"];
       $avreisedato=$_POST["avreisedato"];
       $reisefra=$_POST["reisefra"];
       $reisetil=$_POST["reisetil"];
       $avreisertid=$_POST["avreisertid"];
       $ankomsttid=$_POST["ankomsttid"];
        
       /* Variable gitt verdier fra feltene i html skjemaet */
        
        if (!$flyturID || !$flykode || !$flynummer || !$avreisedato || !$reisefra || !$reisetil || !$avreisertid || !$ankomsttid)
        {
            print ("All fields must be filled");
        }
        else
        {
            $sqlSetning="UPDATE flight SET airplaneID='$flykode', flightNumber='$flynummer', fromLocation='$reisefra', toLocation='$reisetil', departureDate='$avreisedato', departureTime='$avreisertid', arrivalTime='$ankomsttid' WHERE flightID='$flyturID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to make changes to the database, try later");
            
            print ("The flight with flight number $flyturID  travelling to $reisetil has been updated <br/>");
        }
    }
include("slutt.html");
    }
?>
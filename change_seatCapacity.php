<?php    /* Change seat capacity */
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
<h3>Change Seat Capacity</h3>

<script type="text/javascript" src="validering.js"> </script>


<form method="Post" action="" id="finnFlyturIDSkjema" name="finnFlyturIDSkjema" >
    Flight ID:
    <select name='flyturID' id='flyturID'>
        <?php include("listeboks-flyturID-seter.php"); ?>
    </select><br/><br/>
    <input type="submit" value="Find Flight" name="finnFlyturKnapp" id="finnFlyturKnapp">
    
</form>
<br/>
<div id="melding"></div>
<?php
    @$finnFlyturKnapp=$_POST["finnFlyturKnapp"];
    if ($finnFlyturKnapp)
    {
        $flyturID=$_POST["flyturID"]; /* variable gitt verdier fra feltene i html skjemaet */
        
        $sqlSetning="SELECT * FROM classseatcapacity WHERE  flightID='$flyturID';";
        $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");
        
        $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */
        
        if ($antallRader==0){
            print ("The given flight ID is not registered<br/>");
        }
        else
        {
            $rad=mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
            
            $reiseKlasseID=$rad["travelClassID"];
            $flyturID=$rad["flightID"];
            $seterkapasitet=$rad["seatCapacity"];
            
           
            
            print ("<form method='post' action='' id='endreSeteKapasitetSkjema' name='endreSeteKapasitetSkjema'> ");
            print ("Flight ID: <input type='text' value='$flyturID' name='flyturID' id='flyturID' readonly /><br/>");
            print ("Travel Class ID: <input type='text' value='$reiseKlasseID' name='reiseKlasseID' id='reiseKlasseID' readonly /><br/>");
            print ("Seat Capacity: <input type='text' value='$seterkapasitet' name='seterkapasitet' id='seterkapasitet'/><br/><br/>");
           
            print ("<input type='submit' value='Change Seat Capacity' name='endreAntallSeterKnapp' id='endreAntallSeterKnapp' >");
            print ("</form>");
        }
    }
    
    @$endreAntallSeterKnapp=$_POST["endreAntallSeterKnapp"];
    if ($endreAntallSeterKnapp)
    {
       
       $reiseKlasseID=$_POST["reiseKlasseID"];
       $flyturID=$_POST["flyturID"];
       $seterkapasitet=$_POST["seterkapasitet"];
       /* Variable gitt verdier fra feltene i html skjemaet */
        
        if (!$reiseKlasseID || !$flyturID || !$seterkapasitet)
        {
            print ("All fields must be filled");
        }
        else
        {
            $sqlSetning="UPDATE classseatcapacity SET seatCapacity='$seterkapasitet' WHERE flightID='$flyturID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to make chnages to the database, try later");
            
            print ("The seat capacity of flight with ID $flyturID has been updated <br/>");
        }
    }
include("slutt.html");
    }
?>
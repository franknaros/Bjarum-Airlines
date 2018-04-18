<?php    /* Change booking details */
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
<h3>Change Booking Details</h3>

<script type="text/javascript" src="validering.js"> </script>


<form method="Post" action="" id="finnBookingSkjema" name="finnBookingSkjema" >
    Booking ID:
    <select name='bookingID' id='bookingID'>
        <?php include("listeboks-bookingID.php"); ?>
    </select><br/><br/>
    <input type="submit" value="Find booking" name="finnBookingKnapp" id="finnBookingKnapp">
    
</form>
<br/>
<div id="melding"></div>
<?php
    @$finnBookingKnapp=$_POST["finnBookingKnapp"];
    if ($finnBookingKnapp)
    {
        $bookingID=$_POST["bookingID"]; /* variable gitt verdier fra feltene i html skjemaet */
        
        $sqlSetning="SELECT * FROM booking WHERE  bookingID='$bookingID';";
        $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");
        
        $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */
        
        if ($antallRader==0){
            print ("The given booking ID is not registered<br/>");
        }
        else
        {
            $rad=mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
            $bookingID=$rad["bookingID"]; 
            $bookingDato=$rad["bookingDate"];
            $passasjerID=$rad["passengerID"];
            $flyturID=$rad["flightID"];
            $reiseKlasseID=$rad["travelClassID"];
            
           
            
            print ("<form method='post' action='' id='endrePassasjerSkjema' name='endrePassasjerSkjema'> ");
            print ("Booking ID: <input type='text' value='$bookingID' name='bookingID' id='bookingID' readonly /><br/>");
            print ("Booking Date: <input type='text' value='$bookingDato' name='bookingDato' id='bookingDato' readonly /><br/>");
            
            print ("Passenger ID: <select name='passasjerID' id='passasjerID'>");
            print ("<option value='$passasjerID'>$passasjerID</option>");
            include("listeboks-passasjerID.php");
            print ("</select><br/>");
            
            print ("Flight ID: <select name='flyturID' id='flyturID'>");
            print ("<option value='$flyturID'>$flyturID</option>");
            include("listeboks-flyturID.php");
            print ("</select><br/>");
            
            print ("Travel Class: <select name='reiseKlasseID' id='reiseKlasseID'>");
            print ("<option value='$reiseKlasseID'>$reiseKlasseID</option>");
            include("listeboks-reiseKlasseID.php");
            print ("</select><br/>");
            
           
            print ("<input type='submit' value='Change Booking' name='endreBookingKnapp' id='endreBookingKnapp' >");
            print ("</form>");
        }
    }
    
    @$endreBookingKnapp=$_POST["endreBookingKnapp"];
    if ($endreBookingKnapp)
    {
       $bookingID=$_POST["bookingID"];
       $bookingDato=$_POST["bookingDato"];
       $passasjerID=$_POST["passasjerID"];
       $flyturID=$_POST["flyturID"];
       $reiseKlasseID=$_POST["reiseKlasseID"];
       /* Variable gitt verdier fra feltene i html skjemaet */
        
        if (!$bookingID || !$bookingDato || !$passasjerID || !$flyturID || !$reiseKlasseID)
        {
            print ("All fields must be filled");
        }
        else
        {
            $sqlSetning="UPDATE booking SET passengerID='$passasjerID', flightID='$flyturID', travelClassID='$reiseKlasseID' WHERE bookingID='$bookingID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to make chnages in the database, try later");
            
            print ("The booking with booking ID $bookingID has been updated <br/>");
        }
    }
include("slutt.html");
    }
?>
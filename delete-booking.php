<?php  /* slett-booking*/

/*  programmet lager et skjema for å velge en booking som skal slettes og sletter den*/
session_start();
@$innloggetBruker=$_SESSION["brukernavn"];

	if (!$innloggetBruker)
	{
		print("You need to log in to access this page<br/>");
	}
	else
	{

    include ("start.html");

?>

<script src="funksjoner.js"></script>

<h3>Delete Booking</h3>

<form method="post" action="" id="slettBookingSkjema"  name="slettBookingSkjema" onSubmit="return bekreft()">
    Booking ID: 
    <select name='bookingID' id='bookingID'>
    <?php include ("listeboks-bookingID.php"); ?>  
    </select> <br/><br/>
    
    <input type="submit" value="Delete Booking" name="slettBookingKnapp" id="slettBookingKnapp" />

</form>

<?php

    @$slettBookingKnapp=$_POST["slettBookingKnapp"];
    if ($slettBookingKnapp)
        {
            $bookingID=$_POST["bookingID"];
        
           
            
            $sqlSetning="DELETE FROM booking WHERE bookingID='$bookingID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to delete from database right now, try later");
        
            print ("The flight booking with ID $bookingID has been deleted<br/>");
    }
    include("slutt.html");
    }
?>
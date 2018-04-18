<?php /* slett-flere-booking */

/* Programmet lager et skjema for å velge flere booking 
som skal slettes og slette de*/
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

<h3>Delete Several Bookings</h3>

<form method="post" action="" id="slettFlereBookingSkjema" name="slettFlereBookingSkjema" onSubmit="return bekreft()">

Select bookings to delete:<br/>
    
    <?php   include("sjekkbokser-booking.php"); ?><br/>
    <input type="submit" value="Delete bookings" name="slettFlereBookingKnapp" id="slettFlereBookingKnapp"/>
</form>

<?php
    @$slettFlereBookingKnapp=$_POST["slettFlereBookingKnapp"];
    if ($slettFlereBookingKnapp)
        {
            @$bookingIDpassasjerID=$_POST["bookingIDpassasjerID"];
            $antall=count($bookingIDpassasjerID);
        
            if ($antall==0)
                {
                    print ("None of the bookings has been selected<br/>");
            }
            else
            {
                for($r=0; $r<$antall; $r++)
                {
                    $del=explode(" ", $bookingIDpassasjerID[$r]);
                    $bookingID=$del[0];
                    $passasjerID=$del[1];
                    
                    $sqlSetning="DELETE FROM booking WHERE bookingID='$bookingID' AND passengerID='$passasjerID';";
                    mysqli_query($db,$sqlSetning) or die("It has not been possible to delete from the database, try later");
                }
                print("The selected bookings have been deleted<br/>");
            }
    }
include("slutt.html");
    }
?>
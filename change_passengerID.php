<?php    /* Change Passenger */


include("start.html");


?>
<h3>Change Passenger</h3>

<script type="text/javascript" src="validering.js"> </script>


<form method="Post" action="" id="finnBookingSkjema" name="finnBookingSkjema" >
    Booking ID:
    <select name='bookingID' id='bookingID'>
        <?php include("listeboks-bookingID.php"); ?>
    </select><br/>
    <input type="submit" value="Find booking" name="finnBookingKnapp" id="finnBookingKnapp">
    
</form>
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
            print ("Given booking ID is not registered<br/>");
        }
        else
        {
            $rad=mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
            $bookingID=$rad["bookingID"]; 
            $bookingDato=$rad["bookingDate"];
            $passasjerID=$rad["passengerID"];
            $flykode=$rad["flightID"];
            $reiseKlassID=$rad["travelClassID"];
            
           
            
            print ("<form method='post' action='' id='endrePassasjerSkjema' name='endrePassasjerSkjema'> ");
            print ("Booking ID: <input type='text' value='$bookingID' name='bookingID' id='bookingID' readonly /><br/>");
            print ("Booking Date: <input type='text' value='$bookingDato' name='bookingDato' id='bookingDato' readonly /><br/>");
            
            print ("Passenger ID: <select name='passasjerID' id='passasjerID'>");
            print ("<option value='$passasjerID'>$passasjerID</option>");
            include("listeboks-passasjerID.php");
            print ("</select><br/>");
            
           
            print ("<input type='submit' value='Change Passenger' name='endrePassasjerKnapp' id='endrePassasjerKnapp' >");
            print ("</form>");
        }
    }
    
    @$endrePassasjerKnapp=$_POST["endrePassasjerKnapp"];
    if ($endrePassasjerKnapp)
    {
       $bookingID=$_POST["bookingID"];
       $passasjerID=$_POST["passasjerID"];
       /* Variable gitt verdier fra feltene i html skjemaet */
        
        if (!$bookingID || !$passasjerID)
        {
            print ("Alle fields must be filled");
        }
        else
        {
            $sqlSetning="UPDATE booking SET passengerID='$passasjerID' WHERE bookingID='$bookingID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to make chnages in the database, try later");
            
            print ("The passenger on booking with bookingID $bookingID has been changed <br/>");
        }
    }
include("slutt.html");
}
?>
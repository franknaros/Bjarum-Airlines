<?php
/* listeboks-klassekode */

/* Programmet lager en dynamisk listeboks med klassekode og klassenavn  der klassekode er verdien */

    include ("db-tilkobling.php"); /* tilkobling til database-serveren og valg av database utført*/

    $sqlSetning="SELECT * FROM booking ORDER BY 
    bookingID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database at this time, try later"); 
        
    $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */

    for ($r=1; $r <=$antallRader; $r++)
    {
        $rad = mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
        $bookingID=$rad["bookingID"]; 
        $bookingDato=$rad["bookingDate"]; 
        $passasjerID=$rad["passengerID"]; 
        $flyturID=$rad["flightID"]; 
        $reiseKlasseID=$rad["travelClassID"]; 
        
        print ("<option value='$bookingID'>$bookingID</option>" );
    }

?>
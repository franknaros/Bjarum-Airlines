<?php /* sjekkbokser-booking */

/* Programmet lager sjekkbokser for alle registrerte booking */

    include("db-tilkobling.php"); /* tilkobling til serveren og valg av databasen utført*/
    
    $sqlSetning="SELECT bookingID, passengerID FROM booking ORDER BY bookingID, passengerID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");

    $antallRader=mysqli_num_rows($sqlResultat);
    
    for($r=1; $r<=$antallRader; $r++)
    {
        $rad=mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultat */
        $bookingID=$rad["bookingID"]; 
        $passasjerID=$rad["passengerID"]; 
        

        print("<input type='checkbox' id='bookingIDpassasjerID' name='bookingIDpassasjerID[]' value='$bookingID $passasjerID' /> $bookingID - $passasjerID <br/> "); //ny sjekkboks laget
    }

?>
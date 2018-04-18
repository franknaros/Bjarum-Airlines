<?php
/* listeboks-flyturID-seter */

/* Programmet lager en dynamisk listeboks  */

    include ("db-tilkobling.php"); /* tilkobling til database-serveren og valg av database utført*/

    $sqlSetning="SELECT * FROM classseatcapacity ORDER BY 
    flightID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database at this time, try later"); 
        
    $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */

    for ($r=1; $r <=$antallRader; $r++)
    {
        $rad = mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
            
        $flyturID=$rad["flightID"];
        $reiserKlasseID=$rad["travelClassID"];
        $seterkapasitet=$rad["seatCapacity"];
        
        
        print ("<option value='$flyturID'>$flyturID</option>" );
    }

?>
<?php
/* listeboks-reiseKlassekodeID */

/* Programmet lager en dynamisk listeboks med klassekode og klassenavn  der klassekode er verdien */

    include ("db-tilkobling.php"); /* tilkobling til database-serveren og valg av database utført*/

    $sqlSetning="SELECT * FROM travelclass ORDER BY 
    travelClassID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database at this time, try later"); 
        
    $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */

    for ($r=1; $r <=$antallRader; $r++)
    {
        $rad = mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
        $reiseKlasseID=$rad["travelClassID"]; 
        $reiseKlasse=$rad["travelClassCode"]; 
         
        
        print ("<option value='$reiseKlasseID'>$reiseKlasseID</option>" );
    }

?>
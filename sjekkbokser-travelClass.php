<?php /* sjekkbokser-passasjer */

/* Programmet lager sjekkbokser for alle registrerte passasjer */

    include("db-tilkobling.php"); /* tilkobling til serveren og valg av databasen utført*/
    
    $sqlSetning="SELECT travelClassID, travelClassCode FROM travelclass ORDER BY travelClassID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");

    $antallRader=mysqli_num_rows($sqlResultat);
    
    for($r=1; $r<=$antallRader; $r++)
    {
        $rad=mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultat */
        $reiseKlasseID=$rad["travelClassID"]; 
        $reiseKlasseNavn=$rad["travelClassCode"]; 
        

        print("<input type='checkbox' id='reiseKlasseIDnavn' name='reiseKlasseIDnavn[]' value='$reiseKlasseID $reiseKlasseNavn' /> $reiseKlasseID - $reiseKlasseNavn<br/> "); //ny sjekkboks laget
    }

?>
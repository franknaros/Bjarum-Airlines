<?php /* sjekkbokser-flykode-flytype */

/* Programmet lager sjekkbokser for alle registrerte fly */

    include("db-tilkobling.php"); /* tilkobling til serveren og valg av databasen utført*/
    
    $sqlSetning="SELECT * FROM airplane ORDER BY airplaneID, aircraftType;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");

    $antallRader=mysqli_num_rows($sqlResultat);
    
    for($r=1; $r<=$antallRader; $r++)
    {
        $rad=mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultat */
        $flykode=$rad["airplaneID"]; 
        $flytype=$rad["aircraftType"]; 
        

        print("<input type='checkbox' id='flykodeflytype' name='flykodeflytype[]' value='$flykode $flytype' /> $flykode - $flytype <br/> "); //ny sjekkboks laget
    }

?>
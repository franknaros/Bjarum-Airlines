<?php /* sjekkbokser-flytur */

/* Programmet lager sjekkbokser for alle registrerte flyturer */

    include("db-tilkobling.php"); /* tilkobling til serveren og valg av databasen utført*/
    
    $sqlSetning="SELECT flightID, toLocation FROM flight ORDER BY flightID, toLocation;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");

    $antallRader=mysqli_num_rows($sqlResultat);
    
    for($r=1; $r<=$antallRader; $r++)
    {
        $rad=mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultat */
        $flyturID=$rad["flightID"]; 
        $reisetil=$rad["toLocation"]; 
        

        print("<input type='checkbox' id='flyturIDreisetil' name='flyturIDreisetil[]' value='$flyturID $reisetil' /> $flyturID - $reisetil <br/> "); //ny sjekkboks laget
    }

?>
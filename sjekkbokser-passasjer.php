<?php /* sjekkbokser-passasjer */

/* Programmet lager sjekkbokser for alle registrerte passasjer */

    include("db-tilkobling.php"); /* tilkobling til serveren og valg av databasen utført*/
    
    $sqlSetning="SELECT passengerID, firstName, lastName FROM passenger ORDER BY passengerID, firstName;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");

    $antallRader=mysqli_num_rows($sqlResultat);
    
    for($r=1; $r<=$antallRader; $r++)
    {
        $rad=mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultat */
        $passasjerID=$rad["passengerID"]; 
        $fornavn=$rad["firstName"]; 
        $etternavn=$rad["lastName"];
        

        print("<input type='checkbox' id='passasjerIDnavn' name='passasjerIDnavn[]' value='$passasjerID $fornavn $etternavn' /> $passasjerID - $fornavn $etternavn<br/> "); //ny sjekkboks laget
    }

?>
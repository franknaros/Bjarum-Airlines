<?php /* sjekk - programmet inneholder en funksjon for å sjekke om brukernavn og passord er korrekt */


function sjekkBrukernavnPassord($brukernavn, $passord)
{
    /* Funksjonen returnere true hvis brukernavn og passord er korrekt, og false ellers*/
    
    
    include("db-tilkobling.php");
    
    $lovligBruker=true;
    
    $sqlSetning="SELECT * FROM bruker WHERE brukernavn='$brukernavn';";
    $sqlResultat=mysqli_query($db, $sqlSetning);
    
    if (!$sqlResultat)
    {
        $lovligBruker=false;
    }
    else
    {
        $rad=mysqli_fetch_array($sqlResultat);
        $lagretBrukernavn=$rad["brukernavn"];
        $lagretPassord=$rad["passord"];
        
        $passord=md5($passord); /*innparameter-passord kryptert med md5-funksjonen*/
        
        if ($brukernavn !=$lagretBrukernavn || $passord !=$lagretPassord)
        {
            $lovligBruker=false;
        }
    }
    return $lovligBruker;
}

?>
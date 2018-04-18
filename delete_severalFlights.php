<?php /* slett-flere-flytur */

/* Programmet lager et skjema for å velge flere fly 
som skal slettes og slette de valgte klassene*/
session_start();
@$innloggetBruker=$_SESSION["brukernavn"];

	if (!$innloggetBruker)
	{
		print("You need to log in to access this page<br/>");
	}
	else
	{

include ("start.html");

?>

<script src="funksjoner.js"></script>

<h3>Delete Several Flights</h3>

<form method="post" action="" id="slettFlereFlyturSkjema" name="slettFlereFlyturSkjema" onSubmit="return bekreft()">

Select Flights to delete:<br/>
    
    <?php   include("sjekkbokser-flytur.php"); ?><br/>
    <input type="submit" value="Delete Flights" name="slettFlereFlyturKnapp" id="slettFlereFlyturKnapp"/>
</form>

<?php
    @$slettFlereFlyturKnapp=$_POST["slettFlereFlyturKnapp"];
    if ($slettFlereFlyturKnapp)
        {
            @$flyturIDreisetil=$_POST["flyturIDreisetil"];
            $antall=count($flyturIDreisetil);
        
            if ($antall==0)
                {
                    print ("None of the flights has been selected<br/>");
            }
            else
            {
                for($r=0; $r<$antall; $r++)
                {
                    $del=explode(" ", $flyturIDreisetil[$r]);
                    $flyturID=$del[0];
                    $reisetil=$del[1];
                    
                    $sqlSetning="DELETE FROM flight WHERE flightID='$flyturID' AND toLocation='$reisetil';";
                    mysqli_query($db,$sqlSetning) or die("It has not been possible to delete from the database, try later");
                }
                print("The selected flights have been deleted<br/>");
            }
    }
include("slutt.html");
    }
?>
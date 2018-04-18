<?php /* slett-flere-flytype */

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

<h3>Delete Several Aircrafts</h3>

<form method="post" action="" id="slettFlereFlySkjema" name="slettFlereFlySkjema" onSubmit="return bekreft()">

Select Aircrafts to be deleted:<br/><br/>
    
    <?php   include("sjekkbokser-flykode-flytype.php"); ?><br/>
    <input type="submit" value="Delete Aircrafts" name="slettFlereFlyKnapp" id="slettFlereFlyKnapp"/>
</form>

<?php
    @$slettFlereFlyKnapp=$_POST["slettFlereFlyKnapp"];
    if ($slettFlereFlyKnapp)
        {
            @$flykodeflytype=$_POST["flykodeflytype"];
            $antall=count($flykodeflytype);
        
            if ($antall==0)
                {
                    print ("None of the aircrafts has been selected<br/>");
            }
            else
            {
                for($r=0; $r<$antall; $r++)
                {
                    $del=explode(" ", $flykodeflytype[$r]);
                    $flykode=$del[0];
                    $flytype=$del[1];
                    
                    $sqlSetning="DELETE FROM airplane WHERE airplaneID='$flykode';";
                    mysqli_query($db,$sqlSetning) or die("It has not been possible to delete from the database, try later");
                }
                print("The selected aircrafts have been deleted<br/>");
            }
    }
include("slutt.html");
    }
?>
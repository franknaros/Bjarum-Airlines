<?php /* slett-flere-booking */

/* Programmet lager et skjema for å velge flere booking 
som skal slettes og slette de*/
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

<h3>Delete Several Passengers</h3>

<form method="post" action="" id="slettFlerePassasjerSkjema" name="slettFlerePassasjerSkjema" onSubmit="return bekreft()">

Select passengers to delete:<br/><br/>
    
    <?php   include("sjekkbokser-passasjer.php"); ?><br/>
    <input type="submit" value="Delete passengers" name="slettFlerePassasjerKnapp" id="slettFlerePassasjerKnapp"/>
</form>

<?php
    @$slettFlerePassasjerKnapp=$_POST["slettFlerePassasjerKnapp"];
    if ($slettFlerePassasjerKnapp)
        {
            @$passasjerIDnavn=$_POST["passasjerIDnavn"];
            $antall=count($passasjerIDnavn);
        
            if ($antall==0)
                {
                    print ("None of the passengers has been selected<br/>");
            }
            else
            {
                for($r=0; $r<$antall; $r++)
                {
                    $del=explode(" ", $passasjerIDnavn[$r]);
                    $passasjerID=$del[0];
                    $fornavn=$del[1];
                    $etternavn=$del[2];
                    
                    $sqlSetning="DELETE FROM passenger WHERE passengerID='$passasjerID' AND firstName='$fornavn';";
                    mysqli_query($db,$sqlSetning) or die("It has not been possible to delete from the database, try later");
                }
                print("The selected passengers have been deleted<br/>");
            }
    }
include("slutt.html");
    }
?>
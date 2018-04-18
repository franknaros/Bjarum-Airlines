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

<h3>Delete Several Travel Classes</h3>

<form method="post" action="" id="slettFlereReiseKlasseSkjema" name="slettFlereReiseKlasseSkjema" onSubmit="return bekreft()">

Select travel classes to delete:<br/><br/>
    
    <?php   include("sjekkbokser-travelClass.php"); ?><br/>
    <input type="submit" value="Delete Travel Classes" name="slettFlereReiseKlasseKnapp" id="slettFlereReiseKlasseKnapp"/>
</form>

<?php
    @$slettFlereReiseKlasseKnapp=$_POST["slettFlereReiseKlasseKnapp"];
    if ($slettFlereReiseKlasseKnapp)
        {
        @$reiseKlasseIDnavn=$_POST["reiseKlasseIDnavn"];
            $antall=count($reiseKlasseIDnavn);
        
            if ($antall==0)
                {
                    print ("None of the travel classes has been selected<br/>");
            }
            else
            {
                for($r=0; $r<$antall; $r++)
                {
                    $del=explode(" ", $reiseKlasseIDnavn[$r]);
                    $reiseKlasseID=$del[0];
                    $reiseKlasseNavn=$del[1];
                   
                    
                    $sqlSetning="DELETE FROM travelclass WHERE travelClassID = '$reiseKlasseID';";
                    mysqli_query($db,$sqlSetning) or die("It has not been possible to delete from the database, try later");
                }
                print("The selected travel classes have been deleted<br/>");
            }
    }
include("slutt.html");
    }
?>
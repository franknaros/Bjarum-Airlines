<?php  /* slett-flytype*/

/*  programmet lager et skjema for å velge en fly klaase som skal slettes og sletter den*/
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

<h3>Delete Travel Class</h3>

<form method="post" action="" id="slettReiseKlasseSkjema"  name="slettReiseKlasseSkjema" onSubmit="return bekreft()">
    Travel Class ID: 
    <select name='reiseKlasseID' id='reiseKlasseID'>
    <?php include ("listeboks-reiseKlasseID.php"); ?>  
    </select> <br/>
    
    <input type="submit" value="Delete Travel Class" name="slettReiseKlasseKnapp" id="slettReiseKlasseKnapp" />

</form>

<?php

    @$slettReiseKlasseKnapp=$_POST["slettReiseKlasseKnapp"];
    if ($slettReiseKlasseKnapp)
        {
            $reiseKlasseID=$_POST["reiseKlasseID"];
        
           
            
            $sqlSetning="DELETE FROM travelclass WHERE travelClassID='$reiseKlasseID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to delete from database right now, try later");
        
            print ("The Travel Class with ID $reiseKlasseID has been deleted<br/>");
    }
    include("slutt.html");
    }
?>
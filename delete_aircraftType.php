<?php  /* slett-flytype*/

/*  programmet lager et skjema for å velge et fly som skal slettes og sletter den*/
session_start();
@$innloggetBruker=$_SESSION["brukernavn"];

	if (!$innloggetBruker)
	{
		print("You need to log in to access this page<br/>");
	}
	else
	{
include("start.html");
?>

<script src="funksjoner.js"></script>

<h3>Delete Aircraft</h3>

<form method="post" action="" id="slettFlytypeSkjema"  name="slettFlytypeSkjema" onSubmit="return bekreft()">
    Aircraft ID: 
    <select name='flykode' id='flykode'>
    <?php include ("listeboks-flykode.php"); ?>  
    </select> <br/><br/>
    
    <input type="submit" value="Delete AirCraft" name="slettFlytypeKnapp" id="slettFlytypeKnapp" />

</form>

<?php

    @$slettFlytypeKnapp=$_POST["slettFlytypeKnapp"];
    if ($slettFlytypeKnapp)
        {
            $flykode=$_POST["flykode"];
        
           
            
            $sqlSetning="DELETE FROM airplane WHERE airplaneID='$flykode';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to delete from database right now, try later");
        
            print ("The Aircraft type with ID $flykode has been deleted<br/>");
    }
    include("slutt.html");
    }
?>
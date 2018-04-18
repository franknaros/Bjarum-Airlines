<?php  /* slett-passasjer*/

/*  programmet lager et skjema for å velge en passasjer som skal slettes og sletter den*/
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

<h3>Delete Passenger</h3>

<form method="post" action="" id="slettPassasjerSkjema"  name="slettPassasjerSkjema" onSubmit="return bekreft()">
    Passenger ID: 
    <select name='passasjerID' id='passasjerID'>
    <?php include ("listeboks-passasjerID.php"); ?>  
    </select> <br/><br/>
    
    <input type="submit" value="Delete Passenger" name="slettPassasjerKnapp" id="slettPassasjerKnapp" />

</form>
<?php

    @$slettPassasjerKnapp=$_POST["slettPassasjerKnapp"];
    if ($slettPassasjerKnapp)
        {
            $passasjerID=$_POST["passasjerID"];
        
           
            
            $sqlSetning="DELETE FROM passenger WHERE passengerID='$passasjerID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to delete from database right now, try later");
        
            print ("The passenger with ID $passasjerID has been deleted<br/>");
    }
    include("slutt.html");
    }
?>
<?php  /* slett-flytur*/

/*  programmet lager et skjema for å velge en flytur som skal slettes og sletter den*/

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

<h3>Delete Seat Capacity</h3>

<form method="post" action="" id="slettSeterKapasitetSkjema"  name="slettSeterKapasitetSkjema" onSubmit="return bekreft()">
    Flight ID: 
    <select name='flyturID' id='flyturID'>
    <?php include ("listeboks-flyturID.php"); ?>  
    </select> <br/><br/>
    
    <input type="submit" value="Delete Seat Capacity" name="slettSeterKapasitetKnapp" id="slettSeterKapasitetKnapp" />

</form>

<?php

    @$slettSeterKapasitetKnapp=$_POST["slettSeterKapasitetKnapp"];
    if ($slettSeterKapasitetKnapp)
        {
            $flyturID=$_POST["flyturID"];
        
           
            
            $sqlSetning="DELETE FROM classseatcapacity WHERE flightID='$flyturID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to delete from the database right now, try later");
        
            print ("The seat capacity of flight with flight ID $flyturID has been deleted<br/>");
    }
    include("slutt.html");
    }
?>
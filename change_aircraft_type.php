<?php    /* endre flytype */

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
<h3>Change Aircraft Type</h3>

<script type="text/javascript" src="validering.js"> </script>


<form method="Post" action="" id="finnFlySkjema" name="finnFlySkjema" >
    Airplane ID:
    <select name='flykode' id='flykode'>
        <?php include("listeboks-flykode.php"); ?>
    </select><br/><br/>
    <input type="submit" value="Find Aircraft" name="finnFlyKnapp" id="finnFlyKnapp">
</form>
<br/>
<div id="melding"></div>
<?php
    @$finnFlyKnapp=$_POST["finnFlyKnapp"];
    if ($finnFlyKnapp)
    {
        $flykode=$_POST["flykode"]; /* variable gitt verdier fra feltene i html skjemaet */
        
        $sqlSetning="SELECT * FROM airplane WHERE  airplaneID='$flykode';";
        $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database right now, try later");
        
        $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */
        
        if ($antallRader==0){
            print ("Given airplane is not registered<br/>");
        }
        else
        {
            $rad=mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
            $flykode=$rad[0]; 
            $flyType=$rad[1]; 
           
            
            print ("<form method='post' action='' id='endreFlySkjema' name='endreFlySkjema'> ");
            print ("Airplane ID: <input type='text' value='$flykode' name='flykode' id='flykode' readonly /><br/>");
            print ("Aircraft Type: <input type='text' value='$flyType' name='flyType' id='flyType' /><br/><br/>");
            print ("<input type='submit' value='Change Aircraft Type' name='endreFlyKnapp' id='endreFlyKnapp' >");
            print ("</form>");
        }
    }
    
    @$endreFlyKnapp=$_POST["endreFlyKnapp"];
    if ($endreFlyKnapp)
    {
       $flykode=$_POST["flykode"];
       $flyType=$_POST["flyType"];
       /* Variable gitt verdier fra feltene i html skjemaet */
        
        if (!$flykode || !$flyType)
        {
            print ("All fields must be filled out");
        }
        else
        {
            $sqlSetning="UPDATE airplane SET aircraftType='$flyType' WHERE airplaneID='$flykode';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to make changes to the database at this time, try later ");
            
            print ("The aircraft type of airplane with ID $flykode has been changed <br/>");
        }
    }
include("slutt.html");
    }
?>
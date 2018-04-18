<?php    /* endre reise klasse */
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
<h3>Change Travel Class</h3>

<script type="text/javascript" src="validering.js"> </script>


<form method="Post" action="" id="finnReiseKlasseIDSkjema" name="finnReiseKlasseIDSkjema" >
    Travel Class ID:
    <select name='reiseKlasseID' id='reiseKlasseID'>
        <?php include("listeboks-reiseKlasseID.php"); ?>
    </select><br/><br/>
    <input type="submit" value="Find Travel Class" name="finnReiseKlasseIDKnapp" id="finnReiseKlasseIDKnapp">
    <br/><br/>
</form>
<div id="melding"></div>
<?php
    @$finnReiseKlasseIDKnapp=$_POST["finnReiseKlasseIDKnapp"];
    if ($finnReiseKlasseIDKnapp)
    {
        $reiseKlasseID=$_POST["reiseKlasseID"]; /* variable gitt verdier fra feltene i html skjemaet */
        
        $sqlSetning="SELECT * FROM travelclass WHERE  travelClassID='$reiseKlasseID';";
        $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database right now, try later");
        
        $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */
        
        if ($antallRader==0){
            print ("Given travel class ID is not registered<br/>");
        }
        else
        {
            $rad=mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
            $reiseKlasseID=$rad["travelClassID"]; 
            $reiseKlasse=$rad["travelClassCode"]; 
           
            
            print ("<form method='post' action='' id='endreReiseKlasseSkjema' name='endreReiseKlasseSkjema'> ");
            print ("Travel Class ID: <input type='text' value='$reiseKlasseID' name='reiseKlasseID' id='reiseKlasseID' readonly /><br/>");
            print ("Travel Class: <input type='text' value='$reiseKlasse' name='reiseKlasse' id='reiseKlasse' /><br/><br/>");
            print ("<input type='submit' value='Change Travel Class' name='endreReiseKlasseKnapp' id='endreReiseKlasseKnapp' ><br/>");
            print ("<br/></form>");
        }
    }
    
    @$endreReiseKlasseKnapp=$_POST["endreReiseKlasseKnapp"];
    if ($endreReiseKlasseKnapp)
    {
       $reiseKlasseID=$_POST["reiseKlasseID"];
       $reiseKlasse=$_POST["reiseKlasse"];
       /* Variable gitt verdier fra feltene i html skjemaet */
        
        if (!$reiseKlasseID || !$reiseKlasse)
        {
            print ("All fields must be filled out");
        }
        else
        {
            $sqlSetning="UPDATE travelClass SET travelClassCode='$reiseKlasse' WHERE travelClassID='$reiseKlasseID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to make changes to the database at this time, try later ");
            
            print ("The Travel Class with ID $reiseKlasseID has been updated <br/>");
        }
    }
include("slutt.html");
    }
?>
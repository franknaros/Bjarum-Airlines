<?php    /* Change passenger details */
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
<h3>Change Passenger Details</h3>

<script type="text/javascript" src="validering.js"> </script>


<form method="Post" action="" id="finnPassasjerSkjema" name="finnPassasjerSkjema" >
    Passenger ID:
    <select name='passasjerID' id='passasjerID'>
        <?php include("listeboks-passasjerID.php"); ?>
    </select><br/><br/>
    <input type="submit" value="Find Passenger" name="finnPassasjerKnapp" id="finnPassasjerKnapp">
</form>
<br/>
<div id="melding"></div>
<?php
    @$finnPassasjerKnapp=$_POST["finnPassasjerKnapp"];
    if ($finnPassasjerKnapp)
    {
        $passasjerID=$_POST["passasjerID"]; /* variable gitt verdier fra feltene i html skjemaet */
        
        $sqlSetning="SELECT * FROM passenger WHERE  passengerID='$passasjerID';";
        $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");
        
        $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */
        
        if ($antallRader==0){
            print ("The given Passenger ID is not registered<br/>");
        }
        else
        {
            $rad=mysqli_fetch_array($sqlResultat); /* Ny rad hentet fra spørringsresultatet */
            
            
            $passasjerID=$rad["passengerID"]; 
            $fornavn=$rad["firstName"]; 
            $etternavn=$rad["lastName"]; 
            $telefon=$rad["phoneNo"]; 
            $epost=$rad["email"]; 
            $adresse=$rad["address"]; 
           
            
            print ("<form method='post' action='' id='endrePassasjerSkjema' name='endrePassasjerSkjema'> ");
            print ("Passenger ID: <input type='text' value='$passasjerID' name='passasjerID' id='passasjerID' readonly /><br/>");
            
            print ("First Name: <input type='text' value='$fornavn' name='fornavn' id='fornavn' /><br/>");
            print ("Last Name: <input type='text' value='$etternavn' name='etternavn' id='etternavn' /><br/>");
            print ("Telephone: <input type='text' value='$telefon' name='telefon' id='telefon' /><br/>");
            print ("Email: <input type='text' value='$epost' name='epost' id='etternavn' /><br/>");
            print ("Address: <input type='text' value='$adresse' name='adresse' id='adresse' /><br/><br/>");
            
            print ("<input type='submit' value='Change Passenger Datails' name='endrePassesjerKnapp' id='endrePassesjerKnapp' >");
            print ("</form>");
        }
    }
    
    @$endrePassesjerKnapp=$_POST["endrePassesjerKnapp"];
    if ($endrePassesjerKnapp)
    {
       $passasjerID=$_POST["passasjerID"];
       $fornavn=$_POST["fornavn"];
       $etternavn=$_POST["etternavn"];
       $telefon=$_POST["telefon"];
       $epost=$_POST["epost"];
       $adresse=$_POST["adresse"];
       
       /* Variable gitt verdier fra feltene i html skjemaet */
        
        if (!$passasjerID || !$fornavn || !$etternavn || !$telefon || !$epost || !$adresse )
        {
            print ("All fields must be filled");
        }
        else
        {
            $sqlSetning="UPDATE passenger SET firstName='$fornavn', lastName='$etternavn', phoneNo='$telefon', email='$epost', address='$adresse' WHERE passengerID='$passasjerID';";
            mysqli_query($db, $sqlSetning) or die("It has not been possible to make changes in the database, try later");
            
            print ("The passenger with ID $passasjerID has been updated <br/>");
        }
    }
include("slutt.html");
    }
?>
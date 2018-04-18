<?php  

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

<h3>Register Aircraft</h3>

<form action="" id="registrerAirplaneSkjema" name="registrerAirplaneSkjema" method="post">
    Airplane ID: <input name="airplaneID" type="text" id="airplaneID"><br/>
    Aircraft Type: <input name="aircraftType" type="text" id="aircraftType"><br/><br/>


    <input type="submit" name="registrerAirplaneKnapp" value="Register Aircraft" >
    <input type="reset" name="nullstill" value="Reset" id="nullstill"><br/>
</form>

<?php
    @$registrerAirplaneKnapp=$_POST["registrerAirplaneKnapp"];
    if ($registrerAirplaneKnapp)
    {
        include("db-tilkobling.php");

        $airplaneid=$_POST["airplaneID"];
        $airplanetype=$_POST["aircraftType"];


        if(!$airplaneid || !$airplanetype)
        {
            print ("All fields must be filled.<br/>");
        }
        else

          {/*
            include("validering.php");
            $lovligAirplaneid=validerFornavn($airplaneid);
            $lovligAirplanetype=validerEtternavn($airplanetype);



            if (!$lovligAirplaneid) 
            {
              print("Fornavn er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligAirplanetype) 
            {
              print("Etternavn er ikke korrekt fylt ut<br/>");
            }

            if ($airplaneid && $airplanetype) 

            {
                */
                
            include("db-tilkobling.php"); /*tilkobling til database serveren  utført og valg av database foretatt*/

            /*  $sqlSetning="SELECT * FROM airplane WHERE aircraftID= '$airplaneid' AND aircraftType= '$airplanetype';";

              $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
              $antallRader=mysqli_num_rows($sqlResultat);

              if ($antallRader !=0)
                  {
                      print ("Passasjeren er registrert fra f&oslash;r");

                  }
              else
                  {*/
                     $sqlSetning="INSERT INTO airplane (airplaneID, aircraftType) VALUES('$airplaneid', '$airplanetype');";
                      mysqli_query($db,$sqlSetning) or die ("It has not been possible to access the database right now, try later.");
            /*SQL setning sendt til database serveren*/

                  print("The following aircraft is now registered: $airplaneid  $airplanetype");/*melding skrevet */

            }

          }





    
    include("slutt.html");
    }
?>

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

<h3>Register Travel Class</h3>

<form action="" id="registrerClassSkjema" name="registrerClassSkjema" method="post">

   <p>
      Travel Class: <input name="travelClassCode" type="text" id="travelClassCode"> <br/><br/>
      
    <input type="submit" name="registrerClassKnapp" value="Register Travel Class" >&nbsp;
    <input type="reset" name="nullstill" value="Reset" id="nullstill"><br/>
</form>

<?php
    @$registrerClassKnapp=$_POST["registrerClassKnapp"];
    if ($registrerClassKnapp)
    {
        include("db-tilkobling.php");

        $travelclasscode=$_POST["travelClassCode"];
        

        if(!$travelclasscode)
        {
            print ("The field must be filled.<br/>");
        }
      /*    else

          {
            include("validering.php");
            $lovligTravelclasscode=validerTravelclasscode($travelclasscode);
            $lovligTravelclass_id=validerTravelClass_ID($travelclass_id);



            if (!$lovligTravelclasscode)
            {
              print("Travel Class code er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligTravelclass_id)
            {
              print("Travel Class ID er ikke korrekt fylt ut<br/>");
            }

            if ($Travelclasscode && $Travelclass_id)
*/
      /*      {
            include("db-tilkobling.php"); /*tilkobling til database serveren  utført og valg av database foretatt*/
              /*
              $sqlSetning="SELECT * FROM travelclass WHERE travelClassCode= '$Travelclasscode' AND travelClassID= '$Travelclass_id';";

              $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
              $antallRader=mysqli_num_rows($sqlResultat);

              if ($antallRader !=0)
                  {
                      print ("Passasjeren er registrert fra f&oslash;r");
*/

              else
                  {
                     $sqlSetning="INSERT INTO travelclass (travelClassCode) VALUES('$travelclasscode');";
                      mysqli_query($db,$sqlSetning) or die ("It has not been possible to access the database right now, try later.");
            /*SQL setning sendt til database serveren*/

                  print("The following travel class has been registered:  $travelclasscode ");/*melding skrevet */

            }
    }

    include("slutt.html");
    }
?>

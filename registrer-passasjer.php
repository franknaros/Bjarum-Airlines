<?php  /* Registrer bruker - programmet registrerer en ny bruker i databasen */

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

<h3>Register passenger</h3>

<form action="" id="registrerPassasjerSkjema" name="registrerPassasjerSkjema" method="post">
    First name: <input name="firstName" type="text" id="firstName"><br/>
    Last name: <input name="lastName" type="text" id="lastName"><br/>
    Address: <input name="address" type="text" id="address"><br/>
    Email: <input name="email" type="text" id="email"><br/>
    Phone No: <input name="phoneNo" type="text" id="phoneNo"><br/><br/>
   
    

    <input type="submit" name="registrerPassasjerKnapp" value="Register Passenger" >
    <input type="reset" name="nullstill" value="Reset" id="nullstill"><br/>
</form>
<br/>
<?php
    @$registrerPassasjerKnapp=$_POST["registrerPassasjerKnapp"];
    if ($registrerPassasjerKnapp)
    {
        include("db-tilkobling.php");

        $address=$_POST["address"];
        $email=$_POST["email"];
        $firstname=$_POST["firstName"];
        $lastname=$_POST["lastName"];
        
        $phoneno=$_POST["phoneNo"];


        if(!$address || !$email || !$firstname || !$lastname ||  !$phoneno)
        {
            print ("All fields must be filled<br/>");
        }
        else

          {
          /*  include("validering.php");
            $lovligaddress=validerAddress($address);
            $lovligEmail=validerEmail($email);
            $lovligFirstname=validerFirstname($firstname);
            $lovligLastname=validerLastname($lastname);
            $lovligPassengerID=validerPassengerID($passengerID);
            $lovligPhoneno=validerPhoneno($phoneno);


            if (!$lovligaddress)
            {
              print("address er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligEmail)
            {
              print("email er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligFirstname)
            {
              print("Firstname er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligLastname)
            {
              print("Lastname er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligPassengerID)
            {
              print("PassengerID er ikke korrekt fylt ut<br/>");
            }
            if (!$lovligPhoneno)
            {
              print("Phoneno er ikke korrekt fylt ut<br/>");
            }

            if ($address && $email && $firstname && $lastname && $passengerID && $phoneno)
*/

            include("db-tilkobling.php");

            /*  $sqlSetning="SELECT * FROM student WHERE Etternavn= '$etternavn' AND Ticket_id= '$ticket_id';";

              $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
              $antallRader=mysqli_num_rows($sqlResultat);

              if ($antallRader !=0)
                  {
                      print ("Passasjeren er registrert fra f&oslash;r");

                  }
              else
                  { */
                     $sqlSetning="INSERT INTO passenger (address, email, firstName, lastName, phoneNo) VALUES('$address', '$email', '$firstname', '$lastname', '$phoneno');";
                      mysqli_query($db,$sqlSetning) or die ("It has not been possible to access the database now, try later.");


                  print("The following passenger has been registered:<br/> $firstname $lastname $address $email        $phoneno");


                }
        }
    include("slutt.html");
    }
?>

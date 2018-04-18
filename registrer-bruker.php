<?php  /* Registrer bruker - programmet registrerer en ny bruker i databasen */

session_start();
    @$innloggetBruker=$_SESSION["brukernavn"];  //brukernavn hentet fra session-variabelen

    if ($innloggetBruker) //brukeren er innlogget
    {
       
        print("<META HTTP-EQUIV='Refresh' CONTENT='0;URL=hoved.php'>");
    }
    else
    {
        include("start-loginn.html");

?>
    
<h3>User Registration<br/></h3>
<h4>Choose a username and password below to register.</h4>
<form action="" id="registrerBrukerSkjema" name="registrerBrukerSkjema" method="post">
    Username: <input name="brukernavn" type="text" id="brukernavn"><br/>
    Password: <input name="passord" type="password" id="passord"><br/><br/>
    <input type="submit" name="registrerBrukerKnapp" value="Register" > &nbsp;
    <input type="reset" name="nullstill" value="Reset" id="nullstill"><br/>
</form>

<?php
    @$registrerBrukerKnapp=$_POST["registrerBrukerKnapp"];
    if ($registrerBrukerKnapp)
    {
        include("db-tilkobling.php");
        
        $brukernavn=$_POST["brukernavn"];
        $passord=$_POST["passord"];
        
        if(!$brukernavn || !$passord)
        {
            print ("The username and password fields must be filled out<br/>");
        }
        else
        {
            $sqlSetning="SELECT * FROM bruker WHERE brukernavn='$brukernavn';";
            $sqlResultat=mysqli_query($db, $sqlSetning) or die("It has not been possible to access the database, try later");
            
            if (mysqli_num_rows($sqlResultat)!=0)
            {
                print("The username is already taken, try a new one.<br/>");
        
            }
            else
            {
              $kryptertPassord=md5($passord);
              $sqlSetning="INSERT INTO bruker VALUES ('$brukernavn','$kryptertPassord');";
                mysqli_query($db, $sqlSetning) or die("It has not been possible to register you in the database, try later");
                
                print("The username $brukernavn is now registered<br/>");
                print("<a href='login.php'>Go to the login page.");
            }
        }
    }
    include("slutt.html");
    }
?>
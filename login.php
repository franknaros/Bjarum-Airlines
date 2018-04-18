<?php /* Programmet logger inn en bruker i applikasjonen*/

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

<h3>Log in</h3>

<form action="" id="innloggingSkjema" name="innloggingSkjema" method="post">
    Username: <input name="brukernavn" type="text" id="brukernavn"><br/>
    Password: <input name="passord" type="password" id="passord"><br/><br/>
    <input type="submit" name="logginnKnapp" value="Log in"> &nbsp;
    <input type="reset" name="nullstill" value="Reset" id="nullstill" ><br/>
</form><br/>

New User? &nbsp;
<a href="registrer-bruker.php">Register here</a> <br/><br/>

<?php


    @$logginnKnapp=$_POST["logginnKnapp"];
    if ($logginnKnapp)
    {
        include("sjekk.php");
        
        $brukernavn=$_POST["brukernavn"];
        $passord=$_POST["passord"];
        
        if (!sjekkBrukernavnPassord($brukernavn, $passord))
        {
            print("Wrong username or password, try again <br/>");
        }
        else
        {
            @session_start();
            $_SESSION["brukernavn"]=$brukernavn;/* brukernavn lagt inn i session-variabelen */
            print("<META HTTP-EQUIV='Refresh' CONTENT='0;URL=hoved.php'>");  /* redirigering til hoved-siden(hoved.php) */
        }
    }
        include("slutt.html");
    }
?>
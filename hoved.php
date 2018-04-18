<?php  /* hovedsiden */

    session_start();
    @$innloggetBruker=$_SESSION["brukernavn"];  //brukernavn hentet fra session-variabelen

    if (!$innloggetBruker) //brukeren er ikke innlogget
    {
        print("You need to log in to access this application <br/>");
    }
    else
    {
        include("start.html");
        print("<h3>Welcome to the Bjarum Airlines maintenance application homepage <br/>(You are logged in as $innloggetBruker) </h3><br/> You can find the menu to navigate this application and make all the various changes you wish to make on the left handside of your screen.");
        include("slutt.html");
    }
?>
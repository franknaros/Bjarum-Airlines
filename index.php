<?php /* index */
/*
/* Programmet lager hovedsiden
*/
   session_start();
    @$innloggetBruker=$_SESSION["brukernavn"];

    if (!$innloggetBruker)
    {
        include("start-loginn.html");
        print("<h3>Welcome to the Bjarum Airlines maintenance application homepage.<br/><br/> You must log in to use this application.</h3><br/><br/>");
        $image="airplane.png";
        print"<img src=\"$image\" width=\"210\" height=\"220\"\/>";
        include("slutt.html");
        
        
    }
    else
    {

include("start.html"); 

print("<h3>Welcome to the Bjarum Airlines maintenance application homepage <br/>(You are logged in as $innloggetBruker) </h3><br/> You can find the menu to navigate this application and make all the various changes you wish to make on the left handside of your screen.");

include("slutt.html");
}
?>
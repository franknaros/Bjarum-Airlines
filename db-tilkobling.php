<?php /*db-tilkobling*/

/* programmet foretar tilkobling til database-serveren og valg av database*/

    $host = "localhost";
    $user = "web-is-gr07w";
    $password = "69858";
    $database = "web-is-gr07w"; /*verdier satt for host, user, passord og databaseserver */
    
    $db=mysqli_connect($host, $user, $password, $database) or die ("It has not been possible to connect to the database server"); /*tilkobling til database-serveren utført*/

?>
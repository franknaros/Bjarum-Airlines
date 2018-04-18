<?php /* utlogging - logger ut en bruker */

    session_start();
    session_destroy();  /* sesjonen avsluttes */

    print("<META HTTP-EQUIV='Refresh' CONTENT='0;URL=login.php'>"); /* redirigering tilbake til innloggings-siden(login.php) eller header("Location:login.php); */
?>
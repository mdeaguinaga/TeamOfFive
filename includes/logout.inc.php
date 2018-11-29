<?php
    session_start();
    /* Takes all the session variables and deletes all the values from the session variables*/
    session_unset();
    /* Destroys all sessions */
    session_destroy();
    /* Takes user back to the front page (index.php) */
    header("location: ../index.php");
    ?>
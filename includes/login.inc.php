<?php

/* Checks to see if user actually clicked the "login" button and didn't bypass through URL */
if (isset($_POST['login-submit'])) {

    /* Does not need includes since it's already inside login.php */
    require 'connect.php';

    $mail = $_POST['mail'];
    $password = $_POST['password'];

    /* User attempted to hit log in without filling out information */
    if (empty($mail) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else {
        /* running prepared statements */
        $sql = "SELECT * FROM emis WHERE uidUsers=? OR email=?;";
        /* initialized with connect.php pdo which contains DB info */
        $stmt = mysql_stmt_init($pdo);
        /* error check for $sql and $stmt */
        if (!mysql_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else {
            /* we want it to pass in the same variable twice, because when we run the SELECT statement
            we check for the username and email, not the password */
            mysql_stmt_bind_param($stmt, "ss", $mail, $mail);
            /* execute stmt which we just binded to $mail and $password */
            mysqli_stmt_execute($stmt);
            /* need to verify that we actually got a result from a database, since we only checked
            if we only connected to the database. Check if empty or if we have a result. */
            $result = mysql_stmt_get_result($stmt);
            /* $result is in raw format and we're simply making it into an associative array */
            if ($row = mysql_fetch_assoc($result)) {
                /*hashes password from user and compares it to the hashed password we have in our database */
                $passwordCheck = password_verify($password, $row['password']);
                /* boolean check to see whether there is a match */
                if ($passwordCheck == false) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
                /* incase some sort of mistake happens and passwordCheck isn't going to be a true or false statement */
                else if ($passwordCheck == true) {
                    /* Global variable called the session variable that allows the user to have access to visible website */
                    session_start();
                    /* set the session equal to the id of the user in the user table. Session variable is named userId */
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];

                    /* Take user back to the index page with a success message */
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
            /* user entered does not exist */
            else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
} /* redirect user who tried to access log in page without being logged in */
else {
    header("Location: ../index.php");
    exit();
}
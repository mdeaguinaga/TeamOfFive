<?php

/* Checks to see if user actually clicked the "register" button and didn't bypass through URL */
if (isset($_POST['register-submit'])) {

    /* Does not need includes since it's already inside register.php */
    require 'connect.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordVerify = $_POST['pwd-verify'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $MI = $_POST['MI'];
    $DOB = $_POST['DOB'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $SSN = $_POST['SSN'];
    $Gender = $_POST['Gender'];
    $ethnicity = $_POST['ethnicity'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $homePhone = $_POST['homePhone'];
    $cellPhone = $_POST['cellPhone'];
    $insuranceName = $_POST['insuranceName'];
    $insuranceType = $_POST['insuranceType'];
    $physician = $_POST['physician'];


    /*Attempted to register without any fields */
    if (empty($username) || empty($email) || empty($password) || empty($passwordVerify)) {
        header("Location: ../register.php?error=emptyfields&uid=" . $username . "&email=" . $email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z]+\d+]*$/", $username)) {
        header("Location: ../register.php?error=invalidmailuid=");
        exit();
    } /* Admin submitted valid username, but invalid email, maintains username
       FILTER_VALIDATE_EMAIL is a filter that automatically checks to see if this is a valid email or not */
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidmail&uid=" . $username);
        exit();
    } /* Admin submitted valid email, but invalid username, maintains email
       preg_match uses a search pattern for an ABC123 */
    else if (!preg_match("/^[a-zA-Z]+\d+]*$/", $username)) {
        header("Location: ../register.php?error=invaliduid&mail=" . $email);
        exit();
    } else if ($password !== $passwordVerify) {
        header("Location: ../register.php?error=passwordcheck&uid=" . $username . "&mail=" . $email);
        exit();
    } /* Checks to see if the username already exists in the database
    uidUsers=? using something called prepared statements, rather than just inserting $username this is
    to protect the users information */
    else {
        $sql = "SELECT ID FROM emis WHERE uidUsers=?";
        /*refers to our database using connection.php */
        $stmt = mysql_stmt_init($pdo);
        /* check to see if it failed */
        if (!mysql_stmt_prepare($stmt, $sql)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
        } /* Successfully entered database, entering user information */
        else {
            /* take the information from the user and use it in the database
            s is used to denote we're inserting a string */

            mysql_stmt_bind_param($stmt, "s", $username);
            //will run the information in the database
            mysql_stmt_execute($stmt);

            mysqli_stmt_store_result($stmt);
            /* now checking how many rows we're getting returned to check number of entries entered */
            $resultCheck = mysql_stmt_num_rows($stmt);
            /* if resultCheck returns greater than 0 it means that there already exists a user with that username */
            if ($resultCheck > 0) {
                header("Location: ../register.php?error=usertaken&mail=" . $email);
                exit();
            } //verified there is no redundant user, so we will insert
            else {
                /* storing into database initial value auto increments so start with uidUsers, which is username. */
                $sql = "INSERT INTO emis (uidUsers, email, password, lastName, firstName, MI, DOB, weight, height, SSN,
                  Gender, ethnicity, address, city, state, zipcode, homePhone, cellPhone, 
                  insuranceName, insuranceType, physician) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysql_stmt_init($conn);
                if (!mysql_stmt_prepare($stmt, $sql)) {
                    header("Location: ../register.php?error=sqlerror");
                    exit();
                } else {
                    /* hash the password, includes original password, then you tell it in what way you'd like to hash it */
                    $hashpwd = password_hash($password, PASSWORD_DEFAULT);


                    /*string inserts up to weight (double), height (int), then string insert the rest.
                    21 Entries */
                    mysql_stmt_bind_param($stmt, "sssssssdissssssssssss", $username, $email, $password, $lastName, $firstName,
                        $MI, $DOB, $weight, $height, $SSN, $Gender, $ethnicity, $address, $city, $state, $zipcode, $homePhone,
                        $cellPhone, $insuranceName, $insuranceType, $physician);
                    //will run the information in the database
                    mysql_stmt_execute($stmt);
                    mysql_stmt_store_result($stmt);

                    /*Admin successfully registered user, so return with success message back to mainpage */
                    header("Location: ../register.php?register=success");
                    exit();
                }

            }

        }
    }
    mysql_stmt_close($stmt);
    mysql_close($conn);

    /* Allows admin to only use characters for users last name, first name, and middle initial
       Middle initial is allowed to be white space */
    if (!preg_match("/^[a-zA-Z ]*$/", $lastName) || !preg_match("/^[a-zA-Z ]*$/", $firstName) ||
        !preg_match("/^[a-zA-Z ]*$/", $MI)) {
        $nameErr = "Use only alphabetical characters or white space";
    }

    /* radio button for gender must be selected */
    if (empty($Gender)) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($Gender);
    }
} /* User used URL rather than signing up, redirect */
else {
    header("Location: ../register.php");
    exit();
}


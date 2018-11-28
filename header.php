<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="An example of a meta description which will show up in search results">
    <meta name=viewport content="width=device-width, inital-scale=1">
    <title></title>
    <!--add later <link rel="stylesheet" href"style.css">-->
</head>
<body>

<header>
    <nav class="nav-header-main">
        <a class="header-logo" href="index.php"
        <img src="img/logo.png" alt="logo">
        </a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Why choose us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About</a>
            <li><a href="#">Message Receptionist</a></li>
        </ul>
        <div>
            <!--Basic form tag that is going to run through a script to determine if this is the correct user
            who is trying to log in. If they are correct, we will log them in -->
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="mail" placeholder="Username/E-mail">
                <!-- input type="password" to censor input -->
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="login-submit">Login</button>
            </form>
            <a href="register.php">Register</a>
            <form action="includes/logout.inc.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
            </form>
        </div>
    </nav>
</header>
</body>
</html>
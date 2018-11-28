<?php
require "header.php";
?>

<main>
    <div class="wrapper-main">
        <section class=""section-default">
            <h1>Register patient</h1>
            <form class="form-register" action="includes/register.inc.php" method"post"></form>
                <input type="text" name="uid" placeholder="Username">
                <input type="text" name="mail" placeholder="E-mail">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-verify" placeholder="Verify Password">
                <button type="submit" name=""register-submit">Register</button>
        </section>
    </div>
</main>

<?php
require "footer.php";
?>


<?php
require "header.php";
?>

<main>
    <div class="wrapper-main">
        <section class=""section-default">
        <?php
        /* Checks the global session to see if the user is logged in or not */
            if (isset($_SESSION['userId'])) {
                echo '<p You are logged in!</p>';
            }
            else {
                echo '<p You are logged out!</p>';
            }
        ?>
        </section>
    </div>
</main>

<?php
require "footer.php";
?>


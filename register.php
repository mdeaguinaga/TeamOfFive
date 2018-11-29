<?php
require "header.php";
?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
        <h1>Register patient</h1>
        <form class="form-register" action="includes/register.inc.php" method
        "post"></form>
        <div>
            <!-- Username, E-Mail, Password, Verify-password -->
            <input type="text" name="uid" placeholder="Username">
            <input type="text" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="password-verify" placeholder="Verify Password">
        </div>
        <div>
            <div>
                <!--Last Name, First Name, Middle Initial, Date of Birth, Weight, Height -->
                <input type="text" name="lastName" placeholder="Last Name">
                <input type="text" name="firstName" placeholder="First Name">
                <input type="text" name="MI" placeholder="Middle Inital">
                <input type="date" name="DOB" placeholder="Date of Birth">
                <!-- Three digits allowed for weight and two for height -->
                <input type="number" name="weight" placeholder="Weight in lbs" pattern="^\d{1,2,3}$">
                <input type="number" name="height" placeholder="Height in inches" pattern="^\d{1,2}$">
                <div>
                    <!-- Social Security Number -->
                    <label for="fieldSsn">SSN: </label>
                    <input type="text" name="SSN" placeholder="444-44-4444" pattern="\d{3}-?\d{2}-?\d{4}">
                </div>
                <br><br>
                <!-- Gender -->
                Gender:
                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
                <span class="error">* <?php echo $genderErr;?></span>
                <br><br>
                <div>
                    <input type="text" name="ethnicity" placeholder="Ethnicity">
                    <!-- Street Address, City, State, Zipcode, Home Phone, Cell Phone -->
                    <input type="text" name="address" placeholder="Street Address">
                    <input type="text" name="city" placeholder="City">
                    <input type="text" name="state" placeholder="State">
                    <input type="number" name="zipcode" placeholder="Five Digit Zipcode" pattern="[0-9]{5}">
                    <input type="tel" name="homePhone" placeholder="Home Phone">
                    <input type="tel" name="cellPhone" placeholder="Cell Phone">
                </div>
                <!-- Insurance Name, Insurance Type, Physician -->
                <input type="text" name="insuranceName" placeholder="Insurance Name">
                <input type="text" name="insuranceType" placeholder="Insurance Type">
                <input type="digit" name="physician" placeholder="Physician">
            </div>
            <div>
                <!-- Agree to terms and conditions -->
                <label for="Agree-Terms">I agree that I have consulted the patient about our terms
                and conditions</label>
                <input type="checkbox" required name="check" id="Agree-Terms">
                <div><a href="TermsAndConditions.html">Terms and conditions</a></div>
            </div>
            <!-- Submit registration -->
            <button type="submit" name="" register-submit
            ">Register</div>
            </section>
        </div>
</main>

<?php
require "footer.php";
?>


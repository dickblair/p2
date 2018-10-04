<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/css/styles.css">

    <title>H. Groan Insurance</title>

</head>
<body>
<style> <?php include 'css/styles.css'; ?></style>
<?php
    //First I am going to declare all my variables and set them to empty string
    global $gender, $maritalStatus, $age, $specialMessage;
    $genderValidation = $maritalStatusValidation = $ageValidation = $specialMessage = '';
    $gender = $maritalStatus = $age = '';



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["gender"])) {
               $genderValidation = "<span class='error'>Sex is required.</span>";
            }else {
               $gender = validate($_POST["gender"]);
            }


            if (empty($_POST["maritalStatus"])) {
               $maritalStatusValidation = "<span class='error'>Please select your marital status.</span>";
            }else {
               $maritalStatus = validate($_POST["maritalStatus"]);
            }

            if (empty($_POST["age"])) {
               $ageValidation = "<span class='error'>Please enter an age between 5 and 105 before continuing.</span>";
            }else {
               $age = validate($_POST["age"]);
            }
         }
         function validate($inputs) {
            $inputs = trim($inputs);
            $inputs = stripslashes($inputs);
            $inputs = htmlspecialchars($inputs);
         return $inputs;
         }

         function getSpecialMessage($specialMessage) {

             $specialMessage = 'Let us figure out how to make your insurance affordable.';
            if(isset($maritalStatus, $gender, $age)){

             if('married' != $maritalStatus) {
                $specialMessage  = 'We have calculated you can save on your life insurance by getting married.';
             } else if('male' == $gender) {
                $specialMessage = 'Becoming female will lower your life insurance rates.';

             } else if ($age > 50){

                $specialMessage = 'We have determined your life insurance will only get more expensive from here';
             } else {
                $specialMessage = 'Your life insurance is as cheap as it can be.  Congratulations!';
             }

            }

            return $specialMessage;
         }



?>
<div class='center'>
    <h1>Homer Groan Insurance Agency</h1>
    <h2>Insurance Cost Savings Tool</h2>
</div>
<p><span class='error'>All fields are required fields</span></p>
<div class='formContainer'>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <br/><br/>
    <div>
        <label for='gender' id='gender'> Gender: </label>
        <input type='radio' name='gender' value='male'> Male
        <input type='radio' name='gender' value='female'> Female
    </div>
    <div>
        <?php echo $genderValidation;?>
    </div><br/><br/>
    <div>
        <label for='maritalStatus'>  Indicate Your Marital Status: </label> <br/>
        <select id='maritalStatus' name='maritalStatus' size=4>
            <option value = 'married'>Married</option>
            <option value = 'single'>Single</option>
            <option value = 'widowed'>Widowed</option>
            <option value = 'divorced'>Divorced</option>
        </select>
    </div>
    <div>
        <?php echo $maritalStatusValidation;?>
    </div><br/> <br/>
    <div>
        <label for='age'>Input your age between 5 and 105 and press enter: </label> <br/>
        <input type='number' id='age' name='age' min='5' max='105'/>
    </div>
    <div>
        <?php echo $ageValidation;?>
    </div>
    <input type='submit' name='submit' value='Submit' />



</form>

    <?php
        if (count($_POST)>0) {
            echo '<div class="highlight">';
            echo '<h2 class="center"> This is what you told us:</h2>';
            if(isset($age, $gender, $maritalStatus)) {
                echo '<p class="center"> You are a ' . $age . ' year old ' . $gender . ' who is ' . $maritalStatus . '.</p>';
                echo '<div class="center">' . getSpecialMessage($specialMessage) . '</div>';
            }
            echo '</div>';
        }
    ?>

</div>

</body>
</html>




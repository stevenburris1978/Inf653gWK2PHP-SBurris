<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 2 Assignment</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>

<h1>Input Your Info</h1>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>"> 
    <!-- inputs prevent XSS and remain filled out  -->
    <label for="first">First Name:</label>
    <input type="text" id="first" name="first" autocomplete="off" value="<?php echo isset($_GET['first']) ? htmlspecialchars($_GET['first']) : ''; ?>"> 
    <label for="last">Last Name:</label>
    <input type="text" id="last" name="last" autocomplete="off" value="<?php echo isset($_GET['last']) ? htmlspecialchars($_GET['last']) : ''; ?>">
    <label for="age">Age:</label>
    <input type="text" id="age" name="age" autocomplete="off" value="<?php echo isset($_GET['age']) ? htmlspecialchars($_GET['age']) : ''; ?>">
    <div>
        <button type="submit">Submit</button>
    </div>
</form> 

<?php 
if(isset($_GET['first']) && isset($_GET['last']) && isset($_GET['age'])){
    // sanitize age input
    $sanitizeAge = filter_input(INPUT_GET, 'age', FILTER_SANITIZE_NUMBER_INT);
    $age = filter_var($sanitizeAge, FILTER_VALIDATE_INT);

    if($age === false || $age <= 0){
        echo "Please Refill Your Age As It Needs To Be A Positive Number And Fill Any Empty Fields!</br>Inputs cannot be 0.";
    } else if(!empty($_GET['first']) && !empty($_GET['last'])){
        $firstName = filter_input(INPUT_GET, 'first', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_GET, 'last', FILTER_SANITIZE_SPECIAL_CHARS);

        echo "Your name is " . ucfirst(strtolower(htmlspecialchars($firstName))) . " ";
        echo ucfirst(strtolower(htmlspecialchars($lastName))) . " ";
        echo "and your age is " . htmlspecialchars($age) . ". " . "</br>You are at least " . htmlspecialchars($age * 365) . " days old. ";

        if($age > 17){
            echo "</br>You are old enough to vote";
        } else {
            echo "<br>You are not old enough to vote";
        }

        // Display the current date below on submit
        
        echo " on this day of " . date("m/d/Y") . ".";
    } else {
        echo "You Are Not Done Yet!</br>First And Last Name Must Be Filled Out</br>Inputs cannot be 0.";
    }
} else {
    echo "You Are Not Done Yet!</br>First And Last Name Must Be Filled Out</br>Inputs cannot be 0.";
}
?>

    
</body>
</html>
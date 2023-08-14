<!DOCTYPE html>
<html>
<head>
    <title>Welcome to My Application</title>
</head>
<body>
    <h1>Welcome to My Application</h1>    
    <?php
    echo "<a href='login.php' class='button'>Log In</a>";
    echo "<br>";
    echo "<a href='signup.php' class='button'>Sign Up</a>";  
    ?>
    <style>
/* Style for login and signup buttons */
.button {
    display: inline-block;
    margin-bottom: 5px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}

.button:hover {
    background-color: #0056b3;
}
</style>
</body>
</html>

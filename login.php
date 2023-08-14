<?php
include "includes/db_connection.php"; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["ID"];
            $_SESSION["username"] = $user["username"];
            header("Location: dashboard.php"); 
            exit();
        } else {
            // Incorrect password
            echo "Incorrect email or password.";
        }
    } else {
        // User not found
        echo "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>

    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Log In">
    </form>

    <?php
    if (isset($loginError)) {
        echo "<p>{$loginError}</p>";
    }
    ?>
</body>
</html>
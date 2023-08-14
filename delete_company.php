<?php
include "includes/db_connection.php"; 

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // Check if the delete confirmation form is submitted
    if (isset($_POST["confirm_delete"]) && $_POST["confirm_delete"] === "yes") {
        // Prepare and execute the DELETE query
        $sql = "DELETE FROM company WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Deletion successful, redirect back to the list of companies
            header("Location: list_companies.php?success=1");
            exit();
        } else {
            // Deletion failed, redirect with error message
            header("Location: list_companies.php?error=1");
            exit();
        }
    }
} else {
    // Invalid ID or ID not provided, redirect
    header("Location: list_companies.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Company Deletion</title>
</head>
<body>
    <h2>Confirm Company Deletion</h2>

    <p>Are you sure you want to delete this company?</p>
    <form action="delete_company.php?id=<?php echo $id; ?>" method="post">
        <input type="hidden" name="confirm_delete" value="yes">
        <button type="submit">Yes, Delete</button>
        <a href="list_companies.php">Cancel</a>
    </form>
</body>
</html>

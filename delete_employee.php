<?php
include "includes/db_connection.php"; 

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM employee WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Deletion successful, redirect back to the list of employees
        header("Location: list_employees.php?success=1");
        exit();
    } else {
        // Deletion failed, redirect with error message
        header("Location: list_employees.php?error=1");
        exit();
    }
} else {
    // Invalid ID or ID not provided, redirect
    header("Location: list_employees.php");
    exit();
}
?>

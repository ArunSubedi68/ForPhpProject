<?php
include "includes/db_connection.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyName = $_POST["companyName"];
    $address = $_POST["address"];

    $sql = "INSERT INTO company (Company_Name, Address) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $companyName, $address);

    if ($stmt->execute()) {
     
        header("Location: list_companies.php");
        exit();
    } else {
        header("Location: list_companies.php");
        exit();
    }
} else {
    header("Location: list_companies.php");
    exit();
}
?>

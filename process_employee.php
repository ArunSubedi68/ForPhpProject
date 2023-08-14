<?php
include "includes/db_connection.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeName = $_POST["employeeName"];
    $salary = $_POST["salary"];
    $dob = $_POST["dob"];
    $company = $_POST["company"];


    $sql = "INSERT INTO employee (Name, Salary, Date_of_Birth, Company) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $employeeName, $salary, $dob, $company);

    if ($stmt->execute()) {

        header("Location: list_employees.php");
        exit();
    } else {

        header("Location: list_employees.php.php?error=1");
        exit();
    }
} else {

    header("Location: list_employees.php");
    exit();
}
?>

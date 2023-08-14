<?php
include "includes/db_connection.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST["employeeId"];
    $editedEmployeeName = $_POST["editedEmployeeName"];
    $editedEmployeeSalary = $_POST["editedEmployeeSalary"];
    $editedEmployeeDOB = $_POST["editedEmployeeDOB"];

    $sql = "UPDATE employee SET Name = ?, Salary = ?, Date_of_Birth = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $editedEmployeeName, $editedEmployeeSalary, $editedEmployeeDOB, $employeeId);

    if ($stmt->execute()) {
        echo "Employee data updated successfully";
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Error updating employee data";
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request";
}
?>

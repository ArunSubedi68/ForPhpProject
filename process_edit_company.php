<?php
include "includes/db_connection.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyId = $_POST["companyId"];
    $editedCompanyName = $_POST["editedCompanyName"];
    $editedCompanyAddress = $_POST["editedCompanyAddress"];

    
    $sql = "UPDATE company SET Company_Name = ?, Address = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $editedCompanyName, $editedCompanyAddress, $companyId);

    if ($stmt->execute()) {
       
        echo "Company data updated successfully";
    } else {
        
        header("HTTP/1.1 500 Internal Server Error");
        echo "Error updating company data";
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request";
}
?>

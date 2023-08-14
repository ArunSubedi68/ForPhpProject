<?php
include "includes/db_connection.php"; 
include "templates/header.php"; 
?>
<h2>Welcome to the Dashboard</h2>

<a href="list_employees.php" class="nav-button">View Employee Table</a>
<a href="list_companies.php" class="nav-button">View Company Table</a>



<style>
.nav-button {
    display: block;
    margin: 10px;
    padding: 10px;
    background-color: #337ab7;
    color: #fff;
    text-decoration: none;
    text-align: center;
    border-radius: 5px;
    width:200px;
}
</style>

<?php
include "templates/footer.php";
?>
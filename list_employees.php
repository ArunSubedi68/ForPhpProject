<?php
include "includes/db_connection.php"; 
include "templates/header.php"; 
?>

<h2>List of Employees</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Salary</th>
            <th>Date of Birth</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM employee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['ID']}</td>";
                echo "<td>{$row['Name']}</td>";
                echo "<td>{$row['Salary']}</td>";
                echo "<td>{$row['Date_of_Birth']}</td>";
                echo "<td>{$row['Company']}</td>";
                echo "<td><a href='#' onclick='editEmployee({$row['ID']})'>Edit</a></td>";
                echo "<td><a href='#' onclick='confirmDeleteEmployee({$row['ID']})'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No employees found.</td></tr>";
        }
        ?>
    </tbody>
</table>





<div id="editEmployeeModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeEditEmployeeModal">&times;</span>
        <h2>Edit Employee</h2>
        <form id="editEmployeeForm">
            <input type="hidden" name="employeeId" id="employeeId">
            <label for="editEmployeeName">Name:</label>
            <input type="text" name="editEmployeeName" id="editEmployeeName" required><br>
            <label for="editEmployeeSalary">Salary:</label>
            <input type="number" name="editEmployeeSalary" id="editEmployeeSalary" required><br>
            <label for="editEmployeeDOB">Date of Birth:</label>
            <input type="date" name="editEmployeeDOB" id="editEmployeeDOB" required><br>
            <input type="submit" value="Save Changes">
        </form>
    </div>
</div>

<script>

var editEmployeeForm = document.getElementById("editEmployeeForm");

editEmployeeForm.addEventListener("submit", function(event) {
    event.preventDefault(); 
    var employeeId = document.getElementById("employeeId").value;
    var editedEmployeeName = document.getElementById("editEmployeeName").value;
    var editedEmployeeSalary = document.getElementById("editEmployeeSalary").value;
    var editedEmployeeDOB = document.getElementById("editEmployeeDOB").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process_edit_employee.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Define the function to handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Employee data updated successfully!");
                // Close the edit modal
                editEmployeeModal.style.display = "none";
                // Refresh the employee list or perform necessary updates
        
            } else {
              
                console.error("Error updating employee data");
            }
        }
    };

    var formData = "employeeId=" + employeeId +
                   "&editedEmployeeName=" + encodeURIComponent(editedEmployeeName) +
                   "&editedEmployeeSalary=" + encodeURIComponent(editedEmployeeSalary) +
                   "&editedEmployeeDOB=" + encodeURIComponent(editedEmployeeDOB);
    xhr.send(formData);
});
</script>

<script>
    var editEmployeeModal = document.getElementById("editEmployeeModal");
var closeEditEmployeeModal = document.getElementById("closeEditEmployeeModal");
var editEmployeeForm = document.getElementById("editEmployeeForm");
var editEmployeeNameInput = document.getElementById("editEmployeeName");
var editEmployeeSalaryInput = document.getElementById("editEmployeeSalary");
var editEmployeeDOBInput = document.getElementById("editEmployeeDOB");
var employeeIdInput = document.getElementById("employeeId");

function editEmployee(employeeId) {

    employeeIdInput.value = employeeId;
    editEmployeeModal.style.display = "block";
}

closeEditEmployeeModal.addEventListener("click", function() {
    editEmployeeModal.style.display = "none";
});
</script>




<button id="addEmployeeButton">Add New Employee</button>
<div id="addEmployeeModal" class="modal">
    <div class="modal-content">
    <span class="close" id="closeEmployeeModal">&times;</span>
        <h2>Add New Employee</h2>
        <form id="employeeForm" action="process_employee.php" method="post">
            <label for="employeeName">Employee Name:</label>
            <input type="text" name="employeeName" id="employeeName" required><br>
            
            <label for="salary">Salary:</label>
            <input type="number" name="salary" id="salary" min="10000" max="50000" required><br>
            
            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" required><br>
            
            <label for="company">Company:</label>
            <input type="text" name="company" id="company" required><br>
            
            <input type="submit" value="Add Employee">
        </form>
    </div>
</div>

<script>
var addEmployeeButton = document.getElementById("addEmployeeButton");
var addEmployeeModal = document.getElementById("addEmployeeModal");
var closeEmployeeModal = document.getElementById("closeEmployeeModal");
var employeeForm = document.getElementById("employeeForm");

addEmployeeButton.addEventListener("click", function() {
    addEmployeeModal.style.display = "block";
});
closeEmployeeModal.addEventListener("click", function() {
    addEmployeeModal.style.display = "none";
});
</script>

<style>
.modal {
   display: none;
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(0, 0, 0, 0.5);
   z-index: 1;
}

/* Style for the modal content */
.modal-content {
   background-color: white;
   width: 300px;
   padding: 20px;
   border-radius: 5px;
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

</style>


<script>
    function confirmDeleteEmployee(employeeId) {
        var shouldDelete = confirm("Are you sure you want to delete this employee?");
        if (shouldDelete) {
            window.location.href = "delete_employee.php?id=" + employeeId;
        }
    }
</script>

<?php
include "templates/footer.php"; 
?>
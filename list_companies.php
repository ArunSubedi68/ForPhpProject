<?php
include "includes/db_connection.php"; 
include "templates/header.php"; 
?>
<h2>List of Companies</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM company";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['ID']}</td>";
                echo "<td>{$row['Company_Name']}</td>";
                echo "<td>{$row['Address']}</td>";
                echo "<td><a href='#' onclick='editCompany({$row['ID']})'>Edit</a></td>";
                echo "<td><a href='delete_company.php?id={$row['ID']}'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No companies found.</td></tr>";
        }
        ?>
    </tbody>
</table>
    <!-- Edit Company Modal -->
    <div id="editCompanyModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeEditCompanyModal">&times;</span>
        <h2>Edit Company</h2>
        <form id="editCompanyForm">
            <input type="hidden" name="companyId" id="companyId">
            <label for="editCompanyName">Company Name:</label>
            <input type="text" name="editCompanyName" id="editCompanyName" required><br>
            <label for="editCompanyAddress">Address:</label>
            <input type="text" name="editCompanyAddress" id="editCompanyAddress" required><br>
            <input type="submit" value="Save Changes">
        </form>
    </div>
</div>

<script>
var editCompanyForm = document.getElementById("editCompanyForm");

editCompanyForm.addEventListener("submit", function(event) {
    event.preventDefault(); 

    var companyId = document.getElementById("companyId").value;
    var editedCompanyName = document.getElementById("editCompanyName").value;
    var editedCompanyAddress = document.getElementById("editCompanyAddress").value;

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "process_edit_company.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                
                console.log("Company data updated successfully!");
               
                editCompanyModal.style.display = "none";
                // Refresh the company list or perform necessary updates
               
            } else {
                // Handle error cases
                console.error("Error updating company data");
            }
        }
    };

    // Send the request with the edited data
    var formData = "companyId=" + companyId + "&editedCompanyName=" + encodeURIComponent(editedCompanyName) + "&editedCompanyAddress=" + encodeURIComponent(editedCompanyAddress);
    xhr.send(formData);
});

</script>

<script>
var editCompanyModal = document.getElementById("editCompanyModal");
var closeEditCompanyModal = document.getElementById("closeEditCompanyModal");
var editCompanyForm = document.getElementById("editCompanyForm");
var editCompanyNameInput = document.getElementById("editCompanyName");
var editCompanyAddressInput = document.getElementById("editCompanyAddress");
var companyIdInput = document.getElementById("companyId");

function editCompany(companyId) {
    companyIdInput.value = companyId;
    editCompanyModal.style.display = "block";
}

closeEditCompanyModal.addEventListener("click", function() {
    editCompanyModal.style.display = "none";
});
</script>


<button id="addCompanyButton">Add New Company</button>
<div id="addCompanyModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeCompanyModal">&times;</span>
            <h2>Add New Company</h2>
            <form id="companyForm" action="process_company.php" method="post">
                <label for="companyName">Company Name:</label>
                <input type="text" name="companyName" id="companyName" required><br>
                
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" required><br>


                <input type="submit" value="Create Company">

            </form>
        </div>
    </div>

<script>

var addCompanyButton = document.getElementById("addCompanyButton");
var addCompanyModal = document.getElementById("addCompanyModal");
var closeCompanyModal = document.getElementById("closeCompanyModal");
var companyForm = document.getElementById("companyForm");

addCompanyButton.addEventListener("click", function() {
    addCompanyModal.style.display = "block";
});

closeCompanyModal.addEventListener("click", function() {
    addCompanyModal.style.display = "none";
});
</script>

<style>
    /* Style for the modal overlay */
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

<?php
include "templates/footer.php"; // Include the footer template
?>

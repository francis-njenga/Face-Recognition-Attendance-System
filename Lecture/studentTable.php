<?php
include '../Includes/dbcon.php';
include '../Includes/session.php';
?>

<div class="table">
    <table>
        <thead>
            <tr>
                <th>Registration No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Unit</th>
                <th>Venue</th>
                <th>Attendance</th>
                <th>Settings</th>
            </tr>
        </thead>
        <tbody id="studentTableContainer">
            <?php
            if (isset($_POST['courseID']) && isset($_POST['unitID']) && isset($_POST['venueID'])) {

                $courseID = $_POST['courseID'];
                $unitID = $_POST['unitID'];
                $venueID = $_POST['venueID'];

                $sql = "SELECT * FROM tblStudents WHERE courseCode = '$courseID'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        $registrationNumber = $row["registrationNumber"];
                        echo "<td>" . $registrationNumber . "</td>";
                        echo "<td>" . $row["firstName"] . $row["lastName"] . "</td>";
                        echo "<td>" . $courseID . "</td>";
                        echo "<td>" . $unitID . "</td>";
                        echo "<td>" . $venueID . "</td>";
                        echo "<td>Absent</td>"; 
                        echo "<td><span><i class='ri-edit-line edit'></i><i class='ri-delete-bin-line delete'></i></span></td>";
                        echo "</tr>";
                    }

                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

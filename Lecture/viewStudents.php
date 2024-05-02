<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';


function getCourseNames($conn) {
    $sql = "SELECT courseCode,name FROM tblcourse";
    $result = $conn->query($sql);

    $courseNames = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courseNames[] = $row;
        }
    }

    return $courseNames;
}

function getUnitNames($conn) {
    $sql = "SELECT unitCode,name FROM tblunit";
    $result = $conn->query($sql);

    $unitNames = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $unitNames[] = $row;
        }
    }

    return $unitNames;
}


function fetchStudentRecordsFromDatabase($conn, $courseCode, $unitCode) {
    $studentRows = array();

    $query = "SELECT * FROM tblattendance WHERE course = '$courseCode' AND unit = '$unitCode'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $studentRows[] = $row;
        }
    }

    return $studentRows;
}

$courseCode = isset($_GET['course']) ? $_GET['course'] : '';
$unitCode = isset($_GET['unit']) ? $_GET['unit'] : '';

$studentRows = fetchStudentRecordsFromDatabase($conn, $courseCode, $unitCode);

$coursename = "";
if (!empty($courseCode)) {
    $coursename_query = "SELECT name FROM tblcourse WHERE courseCode = '$courseCode'";
    $result = mysqli_query($conn, $coursename_query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $coursename = $row['name'];
    }
}
$unitname="";
if (!empty($unitCode)) {
    $unitname_query = "SELECT name FROM tblunit WHERE unitCode = '$unitCode'";
    $result = mysqli_query($conn, $unitname_query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $unitname = $row['name'];
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="../admin/img/logo/attnlg.png" rel="icon">
  <title>lecture Dashboard</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">
</head>



<body>
<?php include 'includes/topbar.php';?>
    <section class="main">
        <?php include 'includes/sidebar.php';?>
    <div class="main--content">
    <form class="lecture-options" id="selectForm">
    <select required name="course" id="courseSelect"  onChange="updateTable()">
        <option value="" selected>Select Course</option>
        <?php
        $courseNames = getCourseNames($conn);
        foreach ($courseNames as $course) {
            echo '<option value="' . $course["courseCode"] . '">' . $course["name"] . '</option>';
        }
        ?>
    </select>

    <select required name="unit" id="unitSelect" onChange="updateTable()">
        <option value="" selected>Select Unit</option>
        <?php
        $unitNames = getUnitNames($conn);
        foreach ($unitNames as $unit) {
            echo '<option value="' . $unit["unitCode"] . '">' . $unit["name"] . '</option>';
        }
        ?>
    </select>
    </form>


    <div class="table-container">
    <div class="title">
        <h2 class="section--title">Students List</h2>
    </div>
    <div class="table attendance-table" id="attendaceTable">
        <table>
        <thead>
                <tr>
                    <th>Registration No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>

                </tr>
            </thead>
            <tbody>
      <?php  $query = "SELECT * FROM tblstudents WHERE courseCode = '$courseCode'";

          $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['registrationNumber'] . "</td>";
        echo "<td>" . $row['firstName'] . "</td>";
        echo "<td>" . $row['lastName'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";

        echo "</tr>";
    }
    
    echo "</table>";
} else {
}
?>

            </tbody>
        </table>
        
    </div>
</div>

            </div>
</div>
</section>
<div>
</body>
<!-- <script src="https://cdn.jsdelivr.net/npm/table-to-excel/dist/tableToExcel.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script  src="../admin/javascript/main.js"></script>


<script>
function updateTable(){
    var courseSelect = document.getElementById("courseSelect");
    var unitSelect = document.getElementById("unitSelect");
    
    var selectedCourse = courseSelect.value;
    var selectedUnit = unitSelect.value;
    
    var url = "viewStudents.php";
    if (selectedCourse && selectedUnit) {
        url += "?course=" + encodeURIComponent(selectedCourse) + "&unit=" + encodeURIComponent(selectedUnit);
        window.location.href = url;

    }}

</script>

</html>
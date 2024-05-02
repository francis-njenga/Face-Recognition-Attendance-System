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
function getVenueNames($conn) {
    $sql = "SELECT className FROM tblvenue";
    $result = $conn->query($sql);

    $venueNames = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $venueNames[] = $row;
        }
    }

    return $venueNames;
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

    <button class="add" onclick="exportTableToExcel('attendaceTable', '<?php echo $unitCode ?>_on_<?php echo date('Y-m-d'); ?>','<?php echo $coursename ?>', '<?php  echo $unitname ?>')">Export Attendance As Excel</button>

    <div class="table-container">
    <div class="title">
        <h2 class="section--title">Attendance Preview</h2>
    </div>
    <div class="table attendance-table" id="attendaceTable">
    <table>
    <thead>
        <tr>
            <th>Registration No</th>
            <?php
            $distinctDatesQuery = "SELECT DISTINCT dateMarked  FROM tblattendance WHERE course='$courseCode' AND unit='$unitCode'";
            $distinctDatesResult = mysqli_query($conn, $distinctDatesQuery);

            if ($distinctDatesResult) {
              $distinctRegistrationQuery = "SELECT DISTINCT studentRegistrationNumber FROM tblattendance WHERE course='$courseCode' AND unit='$unitCode' ORDER BY studentRegistrationNumber ASC";
              $distinctRegistrationResult = mysqli_query($conn, $distinctRegistrationQuery);
                while ($dateRow = mysqli_fetch_assoc($distinctDatesResult)) {
                    echo "<th>" . $dateRow['dateMarked'] . "</th>";
                }
            }
            ?>
        </tr>
    </thead>
    <tbody>
    <?php

if ($distinctRegistrationResult) {
    while ($registrationRow = mysqli_fetch_assoc($distinctRegistrationResult)) {
        $registrationNumber = $registrationRow['studentRegistrationNumber'];
        echo "<tr>";
        echo "<td>" . $registrationNumber . "</td>";
        $attendanceQuery = "SELECT dateMarked, attendanceStatus FROM tblattendance WHERE studentRegistrationNumber = '$registrationNumber'";
        $attendanceResult = mysqli_query($conn, $attendanceQuery);
        if ($attendanceResult) {
            $attendanceData = array();
            while ($attendanceRow = mysqli_fetch_assoc($attendanceResult)) {
                $date = $attendanceRow['dateMarked'];
                $status = $attendanceRow['attendanceStatus'];
                $attendanceData[$date] = $status;
            }
            $distinctDatesQuery = "SELECT DISTINCT dateMarked FROM tblattendance";
            $distinctDatesResult = mysqli_query($conn, $distinctDatesQuery);
            if ($distinctDatesResult) {
                while ($dateRow = mysqli_fetch_assoc($distinctDatesResult)) {
                    $date = $dateRow['dateMarked'];
                    if (isset($attendanceData[$date])) {
                        echo "<td>" . $attendanceData[$date] . "</td>";
                    } else {
                        echo "<td>Absent</td>";
                    }
                }
            }
        }

        echo "</tr>";
    }
} ?>
    </tbody>
</table>

    </div>
</div>

            </div>
</div>
</section>
<div>
</body>

<script src="./min/js/filesaver.js"></script>
<script src="./min/js/xlsx.js"></script>
<script  src="../admin/javascript/main.js"></script>


<script>
function updateTable(){
    var courseSelect = document.getElementById("courseSelect");
    var unitSelect = document.getElementById("unitSelect");
    
    var selectedCourse = courseSelect.value;
    var selectedUnit = unitSelect.value;
    
    var url = "downloadrecord.php";
    if (selectedCourse && selectedUnit) {
        url += "?course=" + encodeURIComponent(selectedCourse) + "&unit=" + encodeURIComponent(selectedUnit);
        window.location.href = url;

    }}
    function exportTableToExcel(tableId, filename = '', courseCode = '', unitCode = '') {
    var table = document.getElementById(tableId);
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleDateString(); // Format the date as needed

    var headerContent = '<p style="font-weight:700;"> Attendance for : ' + courseCode + ' Unit name : ' + unitCode + ' On: ' + formattedDate + '</p>';
    var tbody = document.createElement('tbody');
    var additionalRow = tbody.insertRow(0);
    var additionalCell = additionalRow.insertCell(0);
    additionalCell.innerHTML = headerContent;
    table.insertBefore(tbody, table.firstChild);
    var wb = XLSX.utils.table_to_book(table, { sheet: "Attendance" });
    var wbout = XLSX.write(wb, { bookType: 'xlsx', bookSST: true, type: 'binary' });
    var blob = new Blob([s2ab(wbout)], { type: 'application/octet-stream' });
    if (!filename.toLowerCase().endsWith('.xlsx')) {
        filename += '.xlsx'; 
    }

    saveAs(blob, filename);
}

function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
    return buf;
}




</script>

</html>
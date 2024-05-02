<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';

function getFacultyNames($conn) {
    $sql = "SELECT facultyCode, facultyName FROM tblfaculty";
    $result = $conn->query($sql);

    $facultyNames = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $facultyNames[] = $row;
        }
    }

    return $facultyNames;
}
if (isset($_POST["addVenue"])) {
    $className = $_POST["className"];
    $facultyCode = $_POST["faculty"];
    $currentStatus = $_POST["currentStatus"];
    $capacity=$_POST["capacity"];
    $classification=$_POST["classification"];
    $faculty=$_POST["faculty"];
    $dateRegistered = date("Y-m-d");

    $query=mysqli_query($conn,"select * from tblvenue where className='$className'");
    $ret=mysqli_fetch_array($query);
        if($ret > 0){ 
            $message = " Venue Already Exists";
    }
    else{
            $query=mysqli_query($conn,"insert into tblvenue(className,facultyCode,currentStatus,capacity,classification,dateCreated) 
        value('$className','$facultyCode','$currentStatus','$capacity','$classification','$dateRegistered')");
        $message = " Venue Inserted Successfully";

    }
   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="img/logo/attnlg.png" rel="icon">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">
</head>
<body>
<?php include 'includes/topbar.php'?>
<section class="main">
<?php include 'includes/sidebar.php';?>
 <div class="main--content">

 <div id="overlay"></div>

 <div class="rooms">
                <div class="title">
                    <h2 class="section--title">Rooms</h2>
                    <div class="rooms--right--btns">
                        <select name="date" id="date" class="dropdown room--filter">
                            <option >Filter</option>
                            <option value="free">Free</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                        <button id="addClass1" class="add"><i class="ri-add-line"></i>Add lecture room</button>
                    </div>
                </div>
                <div class="rooms--cards">
                    <a href="#" class="room--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                            <img src="img/office image.jpeg" alt="">
                            </div>
                        </div>
                        <p class="free">Office</p>
                    </a>
                    <a href="#" class="room--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                            <img src="img/class.jpeg" alt="">
                            </div>
                        </div>
                        <p class="free">Class</p>
                    </a>
                    
                    <a href="#" class="room--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="img/lecture hall.jpeg" alt="">
                            </div>
                        </div>
                        <p class="free">Lecture Hall</p>
                    </a>
                   
                    <a href="#" class="room--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                            <img src="img/computer lab.jpeg" alt="">
                            </div>
                        </div>
                        <p class="free">Computer Lab</p>
                    </a>
                    <a href="#" class="room--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                            <img src="img/laboratory.jpeg" alt="">
                            </div>
                        </div>
                        <p class="free">Science Lab</p>
                    </a>
                </div>
            </div>
            <div id="messageDiv" class="messageDiv" style="display:none;"></div>

            <div class="table-container">
            <div class="title" id="addClass2">
                    <h2 class="section--title">Lecture Rooms</h2>
                    <button class="add"><i class="ri-add-line"></i>Add Class</button>
                </div>
        
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Class Name</th>
                                <th>Faculty</th>
                                <th>Current Status</th>
                                <th>Capacity</th>
                                <th>Classification</th>
                                <th>Settings</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT * FROM tblvenue";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["className"] . "</td>";
                            echo "<td>" . $row["facultyCode"] . "</td>";
                            echo "<td>" . $row["currentStatus"] . "</td>";
                            echo "<td>" . $row["capacity"] . "</td>";
                            echo "<td>" . $row["classification"] . "</td>";
                            echo "<td><span><i class='ri-edit-line edit'></i><i class='ri-delete-bin-line delete'></i></span></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
                    }

                    ?>  
                        </tbody>
                    </table>
                </div>
                
            </div>
                
<div class="formDiv-venue" id="addClassForm"  style="display:none; ">
<form method="POST" action="" name="addVenue" enctype="multipart/form-data">
    <div style="display:flex; justify-content:space-around;">
        <div class="form-title">
            <p>Add Venue</p>
        </div>
        <div>
            <span class="close">&times;</span>
        </div>
    </div>
    <input type="text" name="className" placeholder="Class Name" required>
    <select name="currentStatus" id="">
        <option value="">--Current Status--</option>
        <option value="availlable">Available</option>
        <option value="scheduled">Scheduled</option>
    </select>
    <input type="text" name="capacity" placeholder="Capacity" required>
    <select required name="classification">
      <option value="" selected> --Select Class Type--</option>
      <option value="laboratory">Laboratory</option>
      <option value="computerLab">Computer Lab</option>
      <option value="lectureHall">Lecture Hall</option>
      <option value="class">Class</option>
      <option value="office">Office</option>
    </select>
    <select required name="faculty">
        <option value="" selected>Select Faculty</option>
        <?php
        $facultyNames = getFacultyNames($conn);
        foreach ($facultyNames as $faculty) {
            echo '<option value="' . $faculty["facultyCode"] . '">' . $faculty["facultyName"] . '</option>';
        }
        ?>
    </select>
    <input type="submit" class="submit" value="Save Venue" name="addVenue">
</form>		  
</div>
 </div>
</section>
<script src="javascript/main.js"></script>
<script src="./javascript/confirmation.js"></script>
<?php if(isset($message)){
    echo "<script>showMessage('" . $message . "');</script>";
} 
?>
<script>
   
const addClass1 = document.getElementById('addClass1');
const addClass2 = document.getElementById('addClass2');
const addClassForm = document.getElementById('addClassForm');
const overlay = document.getElementById('overlay'); // Add this line to select the overlay element

addClass1.addEventListener('click', function () {
    addClassForm.style.display = 'block';
    overlay.style.display = 'block';
    document.body.style.overflow = 'hidden'; 

});

addClass2.addEventListener('click', function () {
    addClassForm.style.display = 'block';
    overlay.style.display = 'block';
    document.body.style.overflow = 'hidden'; 

});

var closeButtons = document.querySelectorAll('#addClassForm .close');

closeButtons.forEach(function (closeButton) {
    closeButton.addEventListener('click', function () {
        addClassForm.style.display = 'none';
        overlay.style.display = 'none';
        document.body.style.overflow = 'auto'; 

    });
});

</script>
</body>
</html>
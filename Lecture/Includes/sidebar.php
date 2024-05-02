<div class="sidebar">
            <ul class="sidebar--items">
              
                <li>
                    <a href="takeAttendance.php">
                        <span class="icon icon-1"><i class="ri-file-text-line"></i></span>
                        <span class="sidebar--item">Take Attendance</span>
                    </a>
                </li>
                <li>
                    <a href="viewAttendance.php">
                        <span class="icon icon-1"><i class="ri-map-pin-line"></i></span>
                        <span class="sidebar--item" style="white-space: nowrap;">View Attendance</span>
                    </a>
                </li>
                <li>
                    <a href="viewStudents.php">
                        <span class="icon icon-1"><i class="ri-user-line"></i></span>
                        <span class="sidebar--item">Students</span>
                    </a>
                </li>
                <li>
                    <a href="downloadRecord.php">
                        <span class="icon icon-1"><i class="ri-user-line"></i></span>
                        <span class="sidebar--item">Download Attendance</span>
                    </a>
                </li>
                
            </ul>
            <ul class="sidebar--bottom-items">
                <li>
                    <a href="#">
                        <span class="icon icon-2"><i class="ri-settings-3-line"></i></span>
                        <span class="sidebar--item">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php">
                        <span class="icon icon-2"><i class="ri-logout-box-r-line"></i></span>
                        <span class="sidebar--item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        

        <script>
        document.addEventListener("DOMContentLoaded", function() {
        var currentUrl = window.location.href;
        var links = document.querySelectorAll('.sidebar a');
        links.forEach(function(link) {
            if (link.href === currentUrl) {
                link.id = 'active--link';
            }
        });
    });
</script>

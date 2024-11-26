$(document).ready(function () {
    $('#courseSelect').on('change', function () {
        var selectedCourseID = $(this).val();

        $.ajax({
            url: 'takeattendance.php', 
            type: 'post',
            data: { courseID: selectedCourseID },
            success: function (response) {
                $('#studentTableContainer').html(response);
            }
        });
    });
});

const addLecture = document.getElementById("addLecture");
const addLectureForm = document.getElementById("addLectureForm");
addLecture.addEventListener("click", function () {
  addLectureForm.style.display = "block";
  overlay.style.display = "block";
  document.body.style.overflow = "hidden";
});
var closeButtons = document.querySelectorAll(" #addLectureForm .close");

closeButtons.forEach(function (closeButton) {
  closeButton.addEventListener("click", function () {
    addLectureForm.style.display = "none";
    overlay.style.display = "none";
    document.body.style.overflow = "auto";
  });
});

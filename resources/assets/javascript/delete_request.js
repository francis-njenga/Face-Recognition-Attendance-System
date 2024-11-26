document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".delete").forEach(function (deleteIcon) {
    deleteIcon.addEventListener("click", function () {
      const recordId = this.getAttribute("data-id");
      const dataName = this.getAttribute("data-name"); // Get the ID
      fetch("handle_delete", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: recordId, name: dataName }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            document.getElementById(`row${dataName}${recordId}`).remove();
          } else {
            alert("Failed to delete record.");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  });
});

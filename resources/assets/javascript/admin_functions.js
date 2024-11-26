//add capture student image
function openCamera(buttonId) {
  navigator.mediaDevices
    .getUserMedia({ video: true })
    .then((stream) => {
      const video = document.createElement("video");
      video.srcObject = stream;
      document.body.appendChild(video);

      video.play();

      setTimeout(() => {
        const capturedImage = captureImage(video);
        stream.getTracks().forEach((track) => track.stop());
        document.body.removeChild(video);

        const imgElement = document.getElementById(
          buttonId + "-captured-image"
        );
        imgElement.src = capturedImage;
        const hiddenInput = document.getElementById(
          buttonId + "-captured-image-input"
        );
        hiddenInput.value = capturedImage;
      }, 500);
    })
    .catch((error) => {
      console.error("Error accessing webcam:", error);
    });
}
const takeMultipleImages = async () => {
  document.getElementById("open_camera").style.display = "none";

  const images = document.getElementById("multiple-images");

  for (let i = 1; i <= 5; i++) {
    // Create the image box element
    const imageBox = document.createElement("div");
    imageBox.classList.add("image-box");

    const imgElement = document.createElement("img");
    imgElement.id = `image_${i}-captured-image`;

    const editIcon = document.createElement("div");
    editIcon.classList.add("edit-icon");

    const icon = document.createElement("i");
    icon.classList.add("fas", "fa-camera");
    icon.setAttribute("onclick", `openCamera("image_"+${i})`);

    const hiddenInput = document.createElement("input");
    hiddenInput.type = "hidden";
    hiddenInput.id = `image_${i}-captured-image-input`;
    hiddenInput.name = `capturedImage${i}`;

    editIcon.appendChild(icon);
    imageBox.appendChild(imgElement);
    imageBox.appendChild(editIcon);
    imageBox.appendChild(hiddenInput);
    images.appendChild(imageBox);
    await captureImageWithDelay(i);
  }
};

const captureImageWithDelay = async (i) => {
  try {
    // Get camera stream
    const stream = await navigator.mediaDevices.getUserMedia({ video: true });
    const video = document.createElement("video");
    video.srcObject = stream;
    document.body.appendChild(video);
    video.play();

    // Wait for 500ms before capturing the image
    await new Promise((resolve) => setTimeout(resolve, 500));

    // Capture the image
    const capturedImage = captureImage(video);

    // Stop the video stream and remove the video element
    stream.getTracks().forEach((track) => track.stop());
    document.body.removeChild(video);

    // Update the image and hidden input
    const imgElement = document.getElementById(`image_${i}-captured-image`);
    imgElement.src = capturedImage;

    const hiddenInput = document.getElementById(
      `image_${i}-captured-image-input`
    );
    hiddenInput.value = capturedImage;
  } catch (err) {
    console.error("Error accessing camera: ", err);
  }
};

function captureImage(video) {
  const canvas = document.createElement("canvas");
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  const context = canvas.getContext("2d");

  context.drawImage(video, 0, 0, canvas.width, canvas.height);

  return canvas.toDataURL("image/png");
}

//hide and display form

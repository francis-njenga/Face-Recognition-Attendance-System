function showMessage(message) {
    var messageDiv = document.getElementById('messageDiv');
    messageDiv.style.display="block";
    messageDiv.innerHTML = message;
    messageDiv.style.opacity = 1;
    setTimeout(function() {
      messageDiv.style.opacity = 0;
    }, 5000);
  }
  
  
  
     
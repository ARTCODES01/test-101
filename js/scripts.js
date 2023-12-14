// scripts.js

function sendMessage() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var subject = document.getElementById("subject").value;
    var message = document.getElementById("message").value;

    // Check if required fields are not empty
    if (name.trim() === "" || email.trim() === "" || subject.trim() === "" || message.trim() === "") {
        alert("Please fill in all fields");
        return;
    }

    // Create a FormData object to send data via AJAX
    var formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("subject", subject);
    formData.append("message", message);

    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Define the request method, URL, and asynchronous setting
    xhr.open("POST", "process.php", true);

    // Set up the callback function to handle the response from the server
    xhr.onload = function () {
        if (xhr.status === 200) {
            // The request was successful
            alert("Message sent successfully!");
            // You can add more actions here, such as clearing the form
        } else {
            // The request failed
            alert("Error sending message. Please try again later.");
        }
    };

    // Send the FormData object to the server
    xhr.send(formData);
}

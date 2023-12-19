<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect text data
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
    $message = isset($_POST["message"]) ? $_POST["message"] : "";

    // File upload handling
    $targetDir = "uploads/";
    $uploadOk = 1;

    // Check if file is selected
    if (!empty($_FILES["profilePicture"]["name"])) {
        $targetFile = $targetDir . basename($_FILES["profilePicture"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (adjust as needed)
        if ($_FILES["profilePicture"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only certain file formats (adjust as needed)
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload the file
            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["profilePicture"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Please select a file.";
        $uploadOk = 0;
    }

    // Continue processing only if file upload was successful
    if ($uploadOk !== 0) {
        // Add your email sending logic here
        // Example:
        $to = "info@gardsl.org";
        $headers = "From: $email\r\n";
        mail($to, $subject, $message, $headers);

        // You can customize the response based on your needs
        echo "Message sent successfully, we will respond quikly as possible.";
    }
} else {
    // If the request method is not POST, return an error
    http_response_code(403);
    echo "Access forbidden";
}

?>

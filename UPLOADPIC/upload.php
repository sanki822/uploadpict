<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Adjust to your MySQL username
$password = ""; // Adjust to your MySQL password
$dbname = "students"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the name from the form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    // Handle file upload
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['picture']['tmp_name'];
        $fileName = $_FILES['picture']['name'];
        $fileSize = $_FILES['picture']['size'];
        $fileType = $_FILES['picture']['type'];
        
        // Define the upload directory
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
        }

        // Set the new file path
        $newFilePath = $uploadDir . basename($fileName);

        // Move the uploaded file to the directory
        if (move_uploaded_file($fileTmpPath, $newFilePath)) {
            // Prepare SQL query to insert name and file path into database
            $sql = "INSERT INTO studenttab (name, picture) VALUES ('$name', '$newFilePath')";

            if ($conn->query($sql) === TRUE) {
                echo "Record added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "No file selected or an error occurred during the upload.";
    }
}

// Close the database connection
$conn->close();
?>

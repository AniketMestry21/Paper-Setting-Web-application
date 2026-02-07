<?php
require("Connection.php");
// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['subBtn'])){
    $fileName = $_FILES['pdf']['name'];
    $fileTmpName = $_FILES['pdf']['tmp_name'];
    $fileSize = $_FILES['pdf']['size'];
    $fileType = $_FILES['pdf']['type'];

    // Read the PDF file content
    $fileContent = addslashes(file_get_contents($fileTmpName));

    // Insert the file into the database
    $sql = "INSERT INTO pdf_papers (name, type, size, content) VALUES ('$fileName', '$fileType', $fileSize, '$fileContent')";

    if ($conn->query($sql) === TRUE) {
        echo "File uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Paper Setting Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="Navbar">
        <div id="Logo">
            <img src="images/Logo.png" alt="">
        </div>
        <div id="Name">
            <h3>Dr.Babasaheb Ambedkar Technological University <br> डॉ. बाबासाहेब आंबेडकर तंत्रशास्त्र विद्यापीठ <br> Lonere-402103 Tal.Mangaon Dist.Raigad</h3>
        </div>
        <div id="Menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact </a></li>
                <li><a href="#">Sign up</a></li>
            </ul>
        </div>
    </div>

    <div id="inpFile">
        <div class="login-container">
        <form action="Dashboard.php" method="post" enctype="multipart/form-data">
            <label for="pdf">Choose a PDF file:</label>
            <input type="file" name="pdf" id="pdf" accept="application/pdf" required>
            <button type="submit" name="subBtn">Upload</button>
        </form>

        </div>
        <br>
        <!-- Table to list and download uploaded files -->
    <table border="1" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>File Name</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Select a random PDF from the database
            $sql = "SELECT * FROM pdf_papers ORDER BY RAND() LIMIT 1";
            $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch the selected PDF
            $row = $result->fetch_assoc();
            $pdfFileName = $row['content'];
            $pdfFilePath = $row['content'];
        } 
        else {
             echo "No PDF found in the database.";
            exit;
        }
        ?>

        </tbody>
    </table>


    </div>
</body>
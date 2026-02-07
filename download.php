<?php
    ini_set('memory_limit', '256M');


    $host = "localhost";
    $database = 'universitypapersetter';
    $username = 'root';
    $Password = 'root';

    $conn = new mysqli($host, $username, $Password, $database, 3308);

  if(!$conn){
    die("Failed to connect to server Please try again!");
  }

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT name, type, size, content FROM pdf_papers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $type, $size, $content);
        $stmt->fetch();
        
        // Send the appropriate headers to force a download
        header("Content-Type: $type");
        header("Content-Length: $size");
        header("Content-Disposition: attachment; filename=\"$name\"");
        
        // Output the file content
        ob_clean();
        flush();

        echo $content;
    } else {
        echo "File not found.";
    }
    $stmt->close();
} else {
    echo "No file ID specified.";
}

$conn->close();

?>
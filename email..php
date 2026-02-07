<?php
// Recipient email address
$to = "aniketmestry2103@gmail.com";
$subject = "content";
$message = "Please find attached a random PDF selected from the database.";
$headers = "From: jahirhasankureshi@gmail.com";

// Boundary for attachment
$boundary = md5(uniqid(time()));

// Headers for attachment
$headers .= "\r\nMIME-Version: 1.0\r\n" .
            "Content-Type: multipart/mixed; boundary=\"{$boundary}\"";

// Message body
$body = "--{$boundary}\r\n" .
        "Content-Type: text/plain; charset=ISO-8859-1\r\n" .
        "Content-Transfer-Encoding: 7bit\r\n\r\n" .
        $message . "\r\n";

// Read the PDF file content
$pdfContent = file_get_contents($pdfFilePath);
$pdfContent = chunk_split(base64_encode($pdfContent));

// Add attachment to the message
$body .= "--{$boundary}\r\n" .
         "Content-Type: application/pdf; name=\"{$pdfFileName}\"\r\n" .
         "Content-Transfer-Encoding: base64\r\n" .
         "Content-Disposition: attachment; filename=\"{$pdfFileName}\"\r\n\r\n" .
         $pdfContent . "\r\n--{$boundary}--";

// Send the email
if (mail($to, $subject, $body, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}

// Close the database connection
$conn->close();
?>

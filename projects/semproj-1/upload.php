<?php
$targetDirectory = "uploads/";

if (isset($_FILES['fileToUpload'])) {
    $filename = basename($_FILES['fileToUpload']['name']);
    $targetFile = $targetDirectory . $filename;

    // Check for file type and size (example: allow only PDF or Word documents less than 5MB)
    $allowedExtensions = ['pdf', 'doc', 'docx'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB in bytes

    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions) || $_FILES['fileToUpload']['size'] > $maxFileSize) {
        echo "Invalid file. Please upload a valid PDF or Word document (DOC, DOCX) less than 5MB.";
        exit;
    }

    // Generate a unique filename to avoid overwriting existing files
    $uniqueFilename = uniqid() . '_' . $filename;
    $targetFile = $targetDirectory . $uniqueFilename;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
        echo "File uploaded successfully";

        // Check the file type specifically
        if ($fileExtension == 'pdf') {
            echo "The uploaded file is a PDF document.";
        } elseif ($fileExtension == 'doc' || $fileExtension == 'docx') {
            echo "The uploaded file is a Word document.";
        }
    } else {
        echo "Failed to upload file. Please try again or contact support for assistance.";
        // Optionally, display more details about the error:
        // echo "Error: " . $_FILES['fileToUpload']['error'];
    }
} else {
    echo "No file uploaded.";
}
?>

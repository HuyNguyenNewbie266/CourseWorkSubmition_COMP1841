<?php

$authorID = $_SESSION['user_id'];
if ($for_admin == true) {
    $uploadDir ='../upload/uploads/' . $authorID . '/';
}else { 
    $uploadDir ='upload/uploads/' . $authorID . '/'; }
  

// Create the directory if it doesn't exist
if (!file_exists($uploadDir)) {
    if (!mkdir($uploadDir, 0777, true)) {
        throw new Exception('Failed to create upload directory.');
    }
}

$imagePath = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileTmp    = $_FILES['image']['tmp_name'];
    $fileName   = basename($_FILES['image']['name']);  // strip any path info
    $fileSize   = $_FILES['image']['size'];
    $fileType   = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // 1) Check size (10 MB max)
    $maxFileSize = 10 * 1024 * 1024;
    if ($fileSize > $maxFileSize) {
        throw new Exception('File is too large. Maximum size is 10 MB.');
    }

    // 2) Validate actual image (reject fake images)
    $imageInfo = @getimagesize($fileTmp);
    if ($imageInfo === false) {
        throw new Exception('Uploaded file is not a valid image.');
    }

    // 3) Allow only certain extensions / MIME types
    $allowedExts  = ['jpg','jpeg','png','gif'];
    $allowedMimes = ['image/jpeg','image/png','image/gif'];
    if (!in_array($fileType, $allowedExts, true)
     || !in_array($imageInfo['mime'], $allowedMimes, true)) {
        throw new Exception('Invalid file type. Only JPG, PNG & GIF are allowed.');
    }

    // 4) Generate a unique filename to avoid collisions
    $uniqueName = uniqid('', true) . '.' . $fileType;
    $destination = $uploadDir . $uniqueName;

    // 5) Double-check: no existing file with same name
    if (file_exists($destination)) {
        throw new Exception('A file with that name already exists. Please try again.');
    }

    // 6) Move the file into place
    if (!move_uploaded_file($fileTmp, $destination)) {
        throw new Exception('Failed to move uploaded file.');
    }

    // Success: you can store $destination (or path relative to doc‐root) in DB
    $imagePath = $authorID . '/' . $uniqueName;
    
}
?>

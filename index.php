<?php
// File path to the APK file
$filePath = 'SRMTracker.apk';

// Function to increment visit count
function incrementVisitCount() {
    $visitFile = 'visit_count.txt';
    $count = (int)file_get_contents($visitFile);
    $count++;
    file_put_contents($visitFile, $count);
}

// Function to increment download count
function incrementDownloadCount() {
    $downloadFile = 'download_count.txt';
    $count = (int)file_get_contents($downloadFile);
    $count++;
    file_put_contents($downloadFile, $count);
}

// Increment visit count
incrementVisitCount();

// Check if the download button is clicked
if (isset($_GET['download'])) {
    // Increment download count
    incrementDownloadCount();

    // Download the APK file
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.android.package-archive');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo 'File not found.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRM TRACKER</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
            color: #666;
        }
        button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>SRM TRACKER</h1>
        <form method="get" action="">
            <button type="submit" name="download">Download</button>
        </form>
        
        <p>This page has been visited <?php echo file_get_contents('visit_count.txt'); ?> times.</p>
        <p>This file has been downloaded <?php echo file_get_contents('download_count.txt'); ?> times.</p>
    </div>
</body>
</html>

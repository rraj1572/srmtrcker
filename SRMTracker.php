<?php
// File path to the APK file
$filePath = 'SRMTracker.apk';

// Function to increment download count
function incrementDownloadCount() {
    $downloadFile = 'download_count.txt';
    $count = (int)file_get_contents($downloadFile);
    $count++;
    file_put_contents($downloadFile, $count);
}

// Check if the file exists and download button is clicked
if (file_exists($filePath) && isset($_GET['download'])) {
    // Increment download count
    incrementDownloadCount();

    // Download the APK file
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
?>

<?php 

$file_path = $_GET['filepath'];
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_path) . "\""); 
// readfile($file_path); 

    ob_clean();
    flush();
    if (readfile($file_path))
    {
    unlink($file_path);
    }

?>
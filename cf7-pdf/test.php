<?php
$path = get_stylesheet_directory() . '/cf7-pdf/tcpdf/tcpdf.php';

echo "<strong>Checking file:</strong><br>$path<br><br>";

if (file_exists($path)) {
    echo "✅ File exists!";
} else {
    echo "❌ File does NOT exist.";
}

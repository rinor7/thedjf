<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/base-theme/cf7-pdf/tcpdf/tcpdf.php';

echo "<strong>Looking for file at:</strong><br>$path<br><br>";

if (file_exists($path)) {
    echo "<span style='color:green;'>✅ File exists</span>";
} else {
    echo "<span style='color:red;'>❌ File does NOT exist</span>";
}

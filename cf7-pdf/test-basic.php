<?php

echo "<h3>DOCUMENT_ROOT:</h3>";
echo $_SERVER['DOCUMENT_ROOT'];

echo "<br><br><h3>Checking for file manually:</h3>";

$full_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/base-theme/cf7-pdf/tcpdf/tcpdf.php';

echo "Path: <code>$full_path</code><br><br>";

if (file_exists($full_path)) {
    echo "<span style='color:green;'>✅ File exists!</span>";
} else {
    echo "<span style='color:red;'>❌ File does NOT exist!</span>";
}

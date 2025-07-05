<?php
$path = get_stylesheet_directory() . '/cf7-pdf/tcpdf/tcpdf.php';

echo "<h3>Path Check</h3>";
echo "Looking for: <code>$path</code><br><br>";

if (file_exists($path)) {
    echo "<span style='color:green;'>✅ File exists</span>";
} else {
    echo "<span style='color:red;'>❌ File does NOT exist</span>";
}

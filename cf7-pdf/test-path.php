<?php
$full_path = get_template_directory() . '/cf7-pdf/tcpdf/tcpdf.php';

echo "<strong>Checking path:</strong><br>";
echo $full_path . "<br><br>";

if (file_exists($full_path)) {
    echo "<span style='color:green;'>✅ File exists!</span>";
} else {
    echo "<span style='color:red;'>❌ File does NOT exist!</span>";
}

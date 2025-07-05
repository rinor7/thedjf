<?php
add_action('wpcf7_before_send_mail', 'cf7_generate_pdf_and_send_separately', 10, 2);

function cf7_generate_pdf_and_send_separately($cf7, &$abort) {
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;

    if ($cf7->title() !== 'Application Form') return;

    $data = $submission->get_posted_data();
    $upload_dir = wp_upload_dir();
    $wpcf7_upload_dir = trailingslashit($upload_dir['basedir']) . 'wpcf7_uploads';

    if (!file_exists($wpcf7_upload_dir)) {
        wp_mkdir_p($wpcf7_upload_dir);
    }

    $pdf_path = $wpcf7_upload_dir . '/application-' . time() . '.pdf';

    require_once get_template_directory() . '/cf7-pdf/tcpdf/tcpdf.php';

    $pdf = new TCPDF();
    $pdf->SetTitle('DIRECT JUNCTION FINANCIAL Application Form');
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Write(0, "DIRECT JUNCTION FINANCIAL Application Form\n\n");

    $pdf->SetFont('helvetica', '', 10);

    $html = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">';

    // Inputs to skip
    $skip_inputs = [
        'signature-464-inline',
        'signature-464-attachment',
        'bank-statements',
        'acceptance-002',
        'acceptance-001'
    ];

    foreach ($data as $key => $value) {
        if (in_array($key, $skip_inputs, true)) continue;

        if ($key === 'signature-464') {
            if (is_array($value)) {
                foreach ($value as $v) {
                    if (strpos($v, 'http') === 0) {
                        $value = $v;
                        break;
                    }
                }
            } elseif (strpos($value, 'http') !== 0) {
                $value = '';
            }
        } elseif (is_array($value)) {
            $value = implode(", ", $value);
        }

        $html .= '<tr><td><strong>' . ucfirst(str_replace('-', ' ', $key)) . '</strong></td><td>' . htmlspecialchars($value) . '</td></tr>';
    }

    $html .= '</table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output($pdf_path, 'F');

    // Send separate email with wp_mail() to fixed admin
    $to = 'eli@thedjf.com'; // Hardcoded admin email
    $subject = 'New Application PDF';
    $message = 'Please find the attached PDF of the submitted application form.';
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    $attachments = [$pdf_path];

    wp_mail($to, $subject, $message, $headers, $attachments);

    // CF7 normal email continues without PDF attachment
}
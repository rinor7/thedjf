<?php

add_action('wpcf7_before_send_mail', 'cf7_generate_pdf_inside_theme', 10, 2);

function cf7_generate_pdf_inside_theme($cf7, &$abort) {
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;

    // Only run for form titled "Application Form"
    if ($cf7->title() !== 'Application Form') return;

    $data = $submission->get_posted_data();
    $upload_dir = wp_upload_dir();
    $pdf_path = $upload_dir['basedir'] . '/application-' . time() . '.pdf';

    // Load TCPDF (adjust path if needed)
    require_once get_template_directory() . '/cf7-pdf/tcpdf/tcpdf.php';

    $pdf = new TCPDF();
    $pdf->SetTitle('Business Application Form');
    $pdf->SetAuthor('Your Company Name');

    $pdf->AddPage();

    // Add logo if you want - adjust path or comment out if no logo
    // $logo_path = get_template_directory() . '/images/logo.png';
    // if (file_exists($logo_path)) {
    //     $pdf->Image($logo_path, 15, 10, 50);
    //     $pdf->Ln(20);
    // }

    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->SetTextColor(0, 51, 102);
    $pdf->Write(0, "Business Application Form\n\n");

    $pdf->SetFont('helvetica', '', 11);
    $pdf->SetTextColor(0, 0, 0);

    // Build HTML table of form data
    $html = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">';
    foreach ($data as $key => $value) {
    // For signature field, replace image/attachment with "SIGNED"
        if ($key === 'signature-464') {
            $value = 'SIGNED';
        } else if (is_array($value)) {
            $value = implode(", ", $value);
        }
        $html .= '<tr>
            <td style="background-color:#f2f2f2; width:40%;"><strong>' . ucfirst(str_replace('-', ' ', $key)) . '</strong></td>
            <td>' . htmlspecialchars($value) . '</td>
        </tr>';
    }
    $html .= '</table>';

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Output($pdf_path, 'F');

    // Attach PDF to mail
    $mail = $cf7->prop('mail');

    if (!isset($mail['attachments'])) {
        $mail['attachments'] = '';
    }
    if (is_array($mail['attachments'])) {
        $mail['attachments'] = implode(',', $mail['attachments']);
    }
    if (!empty($mail['attachments'])) {
        $mail['attachments'] .= ',' . $pdf_path;
    } else {
        $mail['attachments'] = $pdf_path;
    }

    $cf7->set_properties(['mail' => $mail]);
}

<?php

add_action('wpcf7_before_send_mail', 'cf7_generate_pdf_inside_theme', 10, 2);

function cf7_generate_pdf_inside_theme($cf7, &$abort) {
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;

    // Only run for specific form title (adjust if needed)
    if ($cf7->title() !== 'Application Form') return;

    $data = $submission->get_posted_data();
    $upload_dir = wp_upload_dir();
    $pdf_path = $upload_dir['basedir'] . '/application-' . time() . '.pdf';

    require_once get_template_directory() . '/cf7-pdf/tcpdf/tcpdf.php';

    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Write(0, "Business Application Form\n\n");

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $value = implode(", ", $value);
        }
        $pdf->Write(0, ucfirst(str_replace('-', ' ', $key)) . ': ' . $value . "\n");
    }

    $pdf->Output($pdf_path, 'F');

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
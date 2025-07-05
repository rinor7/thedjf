<?php

add_action('wpcf7_before_send_mail', 'cf7_generate_pdf_inside_theme', 10, 3);

function cf7_generate_pdf_inside_theme($cf7, &$abort, $submission) {
    if (!$submission) return;

    $form_title = $cf7->title();
    if ($form_title !== 'Application Form') return; // CHANGE THIS

    $data = $submission->get_posted_data();
    $upload_dir = wp_upload_dir();
    $pdf_path = $upload_dir['basedir'] . '/application-' . time() . '.pdf';

    // Load TCPDF from theme
    require_once get_template_directory() . '/cf7-pdf/tcpdf/tcpdf.php';

    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Write(0, "Business Application Form\n\n");

    foreach ($data as $key => $value) {
        if (is_array($value)) $value = implode(", ", $value);
        $pdf->Write(0, ucfirst(str_replace('-', ' ', $key)) . ': ' . $value . "\n");
    }

    $pdf->Output($pdf_path, 'F');

    // Attach PDF to email
    $mail = $cf7->prop('mail');
    $mail['attachments'][] = $pdf_path;
    $cf7->set_properties(['mail' => $mail]);
}

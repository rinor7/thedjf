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

    // Get owner-name and business-legal-name safely from submitted data
    $owner_name = isset($data['owner-name']) && !empty($data['owner-name']) ? $data['owner-name'] : '';
    $business_legal_name = isset($data['business-legal-name']) && !empty($data['business-legal-name']) ? $data['business-legal-name'] : '';

    // Compose title text with those fields
    $title_text = 'Fundora Financial Application Form';
    if ($owner_name !== '' || $business_legal_name !== '') {
        $title_text .= ': ' . trim($owner_name . ', ' . $business_legal_name, ', ');
    }

    $pdf->SetTitle($title_text); // PDF metadata title
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Write(0, $title_text . "\n\n");  // Visible title in PDF content

    $pdf->SetFont('helvetica', '', 10);

    $html = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">';

    // Inputs to skip entirely
    $skip_inputs = [
        'signature-464-inline',
        'signature-464',
        'signature-464-attachment',
        'bank-statements',
        'acceptance-002',
        'acceptance-001'
    ];

    // Inputs to blank out value but show row
    $show_empty_inputs = [
        'signature-464',
        'business-email',
        'personal-email',
        'business-phone',
        'mobile-phone'
    ];

    // Collect filtered data
    $filtered_data = [];
    foreach ($data as $key => $value) {
        if (in_array($key, $skip_inputs, true)) continue;

        if (in_array($key, $show_empty_inputs, true)) {
            $value = ''; // Keep label but blank value
        } elseif (is_array($value)) {
            $value = implode(", ", $value);
        }

        $filtered_data[] = [
            'label' => ucfirst(str_replace('-', ' ', $key)),
            'value' => htmlspecialchars($value)
        ];
    }

    // Add two inputs per row
    $total = count($filtered_data);
    for ($i = 0; $i < $total; $i += 2) {
        $left = $filtered_data[$i];
        $right = isset($filtered_data[$i + 1]) ? $filtered_data[$i + 1] : ['label' => '', 'value' => ''];

        $html .= '<tr>
            <td style="background-color:#f2f2f2; width:20%;"><strong>' . $left['label'] . '</strong></td>
            <td style="width:30%;">' . $left['value'] . '</td>
            <td style="background-color:#f2f2f2; width:20%;"><strong>' . $right['label'] . '</strong></td>
            <td style="width:30%;">' . $right['value'] . '</td>
        </tr>';
    }

    // Disclaimer text above signature
    $html .= '<tr>
        <td colspan="4" style="padding:10px; font-size:9px; line-height:1.4; text-align:justify;">
            By signing below, each of the above listed business and business owner/officer (individually and collectively, “you”) authorize Fundora Advance Corp (FAC) 
            and each of its representatives, successors, assigns and designees (“Recipients”) that may be involved with or acquire commercial loans having daily
            repayment features or purchases of future receivables including Merchant Cash Advance transactions, including without limitation the application therefor
            (collectively, “Transactions”) to obtain consumer or personal, business and investigative reports and other information about you, including credit card processor
            statements and bank statements, from one or more consumer reporting agencies, such as TransUnion, Experian and Equifax, and from other credit bureaus, banks,
            creditors and other third parties. You also consent to the release, by any creditor or financial institution, of any information relating to any of you, to DJF and to each of the Recipients, on its own behalf.
        </td>
    </tr>';

    // Manually add blank signature row
    $html .= '<tr>
        <td style="background-color:#f2f2f2;"><strong>Signature</strong></td>
        <td colspan="3" style="height:50px;"></td>
    </tr>';

    $html .= '</table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output($pdf_path, 'F');

    // Send separate email with wp_mail() to fixed admin
    $to = 'deals@fundorafinancial.com';
    $subject = 'New Application PDF';
    $message = 'Please find the attached PDF of the submitted application form.';
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    $attachments = [$pdf_path];

    wp_mail($to, $subject, $message, $headers, $attachments);
}

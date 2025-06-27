<?php
function setup_dynamic_header_type() {
    $header_type = get_field('header_layout', 'option'); // from options page

    $allowed_headers = ['minimalmenu'];

    // Debug: force fallback if get_field returns false or empty string
    if (empty($header_type) || !in_array($header_type, $allowed_headers)) {
        $header_type = 'minimalmenu';  // fallback
    }

    // Store in global
    $GLOBALS['header_type'] = $header_type;
}
add_action('wp', 'setup_dynamic_header_type');

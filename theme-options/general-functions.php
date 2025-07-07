<?php 
// Remove WP Block ( Patterns from Appearance )
function remove_wp_block_menu() {
    remove_submenu_page( 'themes.php', 'edit.php?post_type=wp_block' );
}
add_action('admin_init', 'remove_wp_block_menu', 100);

// 
// 
//
//
//
//
//Remove Comments Option from Admin Menu 
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Remove comments from the admin bar
function df_remove_comments_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'df_remove_comments_admin_bar');

// Remove comments and trackbacks support from post types
function df_remove_comment_support() {
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('init', 'df_remove_comment_support', 100);

// Redirect any user trying to access comments page
function df_redirect_comments_page() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'df_redirect_comments_page');

// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_hide_existing_comments', 10, 2);


//Function for rendering section headers
function strip_outer_p_tags($content) {
    // Remove outer <p> tags if they exist, but keep inner tags
    if (preg_match('#^<p>(.*)</p>$#is', trim($content), $matches)) {
        return $matches[1];
    }
    return $content;
}

function render_section_header($field_group_name) {
    $fields = get_field($field_group_name, get_the_ID());
    if (!$fields) return;

    $title = $fields['title_section'] ?? '';
    $subtitle = $fields['subtitle_section'] ?? '';

    if ($title || $subtitle) {
        echo '<div class="section-header">';
        
        if ($title) {
            // Clean outer <p> if any and output safe HTML
            echo '<div class="section-header-title">' . wp_kses_post(strip_outer_p_tags($title)) . '</div>';
        }

        if ($subtitle) {
            // Clean outer <p> if any and output safe HTML
            echo '<div class="section-header-subtitle">' . wp_kses_post(strip_outer_p_tags($subtitle)) . '</div>';
        }

        echo '</div>';
    }
}


//Theme Settings Menu 
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Global Settings',
        'menu_title'    => 'Global Settings',
        'menu_slug'     => 'global-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

// Contact Form 7 Agent
add_action('wpcf7_before_send_mail', 'sanitize_agent_email_field');

function sanitize_agent_email_field($contact_form) {
    $submission = WPCF7_Submission::get_instance();
    if ($submission) {
        $data = $submission->get_posted_data();
        if (isset($data['agent-email'])) {
            $agent_email = sanitize_email($data['agent-email']);
            // Optionally validate against an allowed list here
            if (!is_email($agent_email)) {
                $contact_form->skip_mail = true;
            }
        }
    }
}

//Disable post type post:
function remove_default_post_type_menu() {
    remove_menu_page('edit.php'); // Removes "Posts" from admin menu
}
add_action('admin_menu', 'remove_default_post_type_menu');

function modify_post_type_visibility() {
    global $wp_post_types;
    if (isset($wp_post_types['post'])) {
        $wp_post_types['post']->public = false;
        $wp_post_types['post']->show_ui = false;
        $wp_post_types['post']->show_in_menu = false;
        $wp_post_types['post']->exclude_from_search = true;
        $wp_post_types['post']->show_in_rest = false;
    }
}
add_action('init', 'modify_post_type_visibility', 100);

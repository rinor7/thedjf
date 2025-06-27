<?php if (!get_field('section__form')['disable_section'] ?? false): ?>
<section class="section__form" aria-label="Contact Form">
    <div class="container">
        <?php render_section_header('section__form'); ?>
        <?php
        $form_section = get_field('section__form');
        if (!empty($form_section['form_content'])):
            echo do_shortcode($form_section['form_content']);
        endif;
        ?>
    </div>
</section>
<?php endif; ?>

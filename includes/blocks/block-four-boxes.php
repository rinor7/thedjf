<?php 
$four_box = get_field('four_box-default');
if (!empty($four_box) && !($four_box['disable_section'] ?? false)): 
?>

<section class="four__boxes" aria-label="How It Works Section">
    <div class="container">
        <?php render_section_header('four_box-default'); ?>

        <div class="row">
            <?php
            // Prepare arrays for icon classes, titles, and subtitles
            $icons = [
                $four_box['box1img'] ?? '', // Font Awesome icon class (e.g., 'fas fa-home')
                $four_box['box2img'] ?? '',
                $four_box['box3img'] ?? '',
            ];
            $titles = [
                $four_box['title1'] ?? '',
                $four_box['title2'] ?? '',
                $four_box['title3'] ?? '',
            ];
            $subs = [
                $four_box['sub1'] ?? '',
                $four_box['sub2'] ?? '',
                $four_box['sub3'] ?? '',
            ];

            // Loop through boxes
            foreach ($icons as $index => $icon): 
                if (empty($icon)) continue; // skip if no icon
            ?>
            <div class="box col-lg-4 col-sm-12">
                <div class="box__wrap">
                    <div class="icon">
                    <?php echo wp_kses_post($icon); ?>
                    </div>
                    <h2><?php echo esc_html($titles[$index]); ?></h2>
                    <p><?php echo esc_html($subs[$index]); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php 
        // Output button HTML from WYSIWYG field, if any
        if (!empty($four_box['four_box_default_button'])): ?>
            <div class="four-box-button-wrap">
                <?php echo wp_kses_post($four_box['four_box_default_button']); ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php endif; ?>

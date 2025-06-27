<?php if (!get_field('section__accordions')['disable_section'] ?? false): ?>
<section class="section__accordions" aria-label="Accordions">
    <div class="container">
        <?php render_section_header('section__accordions'); ?>

        <div class="accordion" id="accordionSection">
            <?php
            $section = get_field('section__accordions');
            if (!empty($section['accordion_items'])):
                foreach ($section['accordion_items'] as $index => $item):
                    $heading_id = 'heading' . $index;
                    $collapse_id = 'collapse' . $index;
            ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="<?php echo $heading_id; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapse_id; ?>" aria-expanded="false" aria-controls="<?php echo $collapse_id; ?>">
                            <?php echo esc_html($item['accordion_title']); ?>
                        </button>
                    </h2>
                    <div id="<?php echo $collapse_id; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo $heading_id; ?>" data-bs-parent="#accordionSection">
                        <div class="accordion-body">
                            <?php echo wp_kses_post($item['accordion_content']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

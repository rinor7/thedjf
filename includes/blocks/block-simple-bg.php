<?php 
$group = get_field('simple_background_section');
if (!$group['disable_section']) :
    $bg = $group['background_image'] ?? '';
    $bg_style = $bg ? 'style="background-image: url(' . esc_url($bg) . ');"' : '';
?>
<section class="simple-bg-section" <?php echo $bg_style; ?> aria-label="Simple Background Section">
    <div class="content-wrapper">
        <?php echo wp_kses_post($group['content']); ?>
    </div>
</section>
<?php endif; ?>

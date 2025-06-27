<?php 
$group = get_field('group_banner');
if (!$group['disable_section']) : 

    // Prioritization logic
    $show_image = !empty($group['image']);
    $show_video = !$show_image && !empty($group['banner_videoo']);
    $slider_images = $group['slider_images'] ?? [];
    
    // Filter slider images to only those with a valid image URL
    $valid_slider_images = array_filter($slider_images, function($slide) {
        return !empty($slide['slide_image']);
    });

    $show_slider = !$show_image && !$show_video && count($valid_slider_images) >= 2;

    // Determine section class
    $content_class = '';
    if ($show_image) $content_class = 'banner-type--background';
    elseif ($show_video) $content_class = 'banner-type--video';
    elseif ($show_slider) $content_class = 'banner-type--slider';

    $bg_style = $show_image ? 'background-image: url(' . esc_url($group['image']) . ');' : '';
?>
<section class="banner__section banner-one__section <?php echo esc_attr($content_class); ?>" style="<?php echo $bg_style; ?>" aria-label="Banner Section">
    
    <?php if ($show_video): ?>
        <div class="banner-media">
            <video autoplay muted loop playsinline>
                <source src="<?php echo esc_url($group['banner_videoo']); ?>" type="video/mp4">
            </video>
        </div>
    
    <?php elseif ($show_slider): ?>
        <div class="banner-media banner-slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($valid_slider_images as $slide): ?>
                    <div class="swiper-slide">
                        <img src="<?php echo esc_url($slide['slide_image']); ?>" alt="Slide Image" />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Overlay content -->
    <div class="banner-content container">
        <div class="row">
            <div class="leftside col-lg-8">
                <h1 class="banner-h1"><?php echo esc_html($group['title']); ?></h1>
                <div class="banner-paragraph"><?php echo wp_kses_post($group['subtitle']); ?></div>
                <?php echo wp_kses_post($group['contact-info']); ?>
            </div>
            <div class="rightside col-lg-4">
                <?php echo wp_kses_post($group['apply-button']); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

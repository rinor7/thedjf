<!-- if its needed background without container 
add image-no-container-right class on parent div two-side__section-text-image-->
<?php if (!get_field('two-side-text-image-group')['disable_section'] ?? false): ?>
<section class="two-side__section-text-image" aria-label="What we offer">
    <div class="container">
        <div class="row">
            <div class="lefts col-lg-7">
                <h2><?php echo ( get_field('two-side-text-image-group')['titleh1'] );?></h2>
                <h3><?php echo ( get_field('two-side-text-image-group')['titleh3'] );?></h3>
                <div class="buttons">
                    <div class="default-btn">
                        <a href="<?php echo ( get_field('two-side-text-image-group')['link1'] );?>"
                            class="link-btn"><?php echo ( get_field('two-side-text-image-group')['name1'] );?></a>
                    </div>
                </div>
            </div>
            <div class="rights col-lg-5">
            <div class="background-frame"></div>
                <div class="img">
                    <img src="<?php echo ( get_field('two-side-text-image-group')['image'] );?>" alt="Background"
                        loading=“lazy”>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- if its needed background without container 
add image-no-container-left class on parent div two-side__section-image-text-->
<?php if (!get_field('two-side-image-text-group')['disable_section'] ?? false): ?>
<section class="two-side__section-image-text" aria-label="Who We Are">
    <div class="container">
        <div class="row">
            <div class="lefts col-lg-5">

                <div class="img">
                    <div class="background-frame"></div>
                    <img src="<?php echo ( get_field('two-side-image-text-group')['image'] );?>" alt="Background"
                        loading=“lazy”>
                </div>

            </div>
            <div class="rights col-lg-7">
                <h2><?php echo ( get_field('two-side-image-text-group')['titleh1'] );?></h2>
                <h3><?php echo ( get_field('two-side-image-text-group')['titleh3'] );?></h3>

                <div class="buttons">
                    <div class="default-btn">
                        <a href="<?php echo ( get_field('two-side-image-text-group')['link1'] );?>"
                            class="link-btn"><?php echo ( get_field('two-side-image-text-group')['name1'] );?></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if (!get_field('four_box-count')['disable_section'] ?? false): ?>
<section class="four__boxes-counter" aria-label="Counter Section">
    <div class="container">
        <?php render_section_header('four_box-count'); ?>
        <div class="row">
            <?php
            $four_box = get_field('four_box-count');
            ?>
            <div class="box col-lg-4 col-sm-4">
                <div class="box__wrap">
                    <div class="countdown" 
                         data-target="<?php echo esc_attr($four_box['title1']); ?>" 
                         data-plus="<?php echo !empty($four_box['title1_plus']) ? 'true' : 'false'; ?>">
                    </div>
                    <p><?php echo esc_html($four_box['sub1']); ?></p>
                </div>
            </div>
            <div class="box col-lg-4 col-sm-4">
                <div class="box__wrap">
                    <div class="countdown" 
                         data-target="<?php echo esc_attr($four_box['title2']); ?>" 
                         data-plus="<?php echo !empty($four_box['title2_plus']) ? 'true' : 'false'; ?>">
                    </div>
                    <p><?php echo esc_html($four_box['sub2']); ?></p>
                </div>
            </div>
            <div class="box col-lg-4 col-sm-4">
                <div class="box__wrap">
                    <div class="countdown" 
                         data-target="<?php echo esc_attr($four_box['title3']); ?>" 
                         data-plus="<?php echo !empty($four_box['title3_plus']) ? 'true' : 'false'; ?>">
                    </div>
                    <p><?php echo esc_html($four_box['sub3']); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get all elements with the class 'countdown'
    var countdowns = document.querySelectorAll('.countdown');

    // Function to update the countdown for each element
    function updateCountdown(element) {
        var target = parseInt(element.getAttribute('data-target'), 10);
        var addPlus = element.getAttribute('data-plus') === 'true';
        var current = 0;

        var intervalId = setInterval(function() {
            current++;
            element.textContent = current + (addPlus ? "+" : "");

            if (current === target) {
                clearInterval(intervalId);
            }
        }, 20);
    }

    // Loop through each countdown element and update it
    countdowns.forEach(function(countdownElement) {
        updateCountdown(countdownElement);
    });
});
</script>
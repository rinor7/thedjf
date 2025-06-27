<?php
/**
 * @package Base Theme
 */
?>

<footer id="footer-site" class="site-footer">
    <div class="site-footer-columns">
        <div class="container" id="foooter">
            <div class="row">
                <div class="col-lg-2 footer-1">
                    
                </div>
                <div class="col-lg-4 footer-2">
                    <ul>
                        <?php dynamic_sidebar('footer-2');?>
                    </ul>
                </div>
                <div class="col-lg-4 footer-3">
                    <ul>
                        <?php dynamic_sidebar('footer-3');?>
                    </ul>
                </div>
                <div class="col-lg-2 footer-4">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer-copyrights">
        <div class="container">
            <div class="wrapper">
                <ul>
                    <?php dynamic_sidebar('footer-5');?>
                </ul>
            </div>
        </div>
    </div>
</footer>


</div><!-- #page -->


<?php wp_footer(); ?>
</body>

</html>
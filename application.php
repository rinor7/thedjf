<?php //Template Name: Application
global $header_type; // required to access global variable
include("includes/headers/{$header_type}.php"); 
?>

<main id="primary" class="site-application">
    
    <div class="container">
        <?php the_content(); ?>
    </div>

</main>

<?php include("includes/footers/default.php"); ?>
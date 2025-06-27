<?php
global $header_type; // required to access global variable
include("includes/headers/{$header_type}.php");
?>

	<main id="primary" class="site-default">

		<div class="container">
			<?php the_content(); ?>
		</div>

	</main><!-- #main -->


<?php include("includes/footers/default.php");  ?>
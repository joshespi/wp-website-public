<?php
/*
Template Name: Front Page
*/
get_header();

//fetch all stored variables from the control post
$get_to_know_fields = get_fields();
?>
<main id="mainContent" class="homeMainContent"><!-- Start of #mainContent -->

	<?php
	$posts_to_show = 1;
	//query any alerts
	$my_query = new WP_Query(array('showposts' => $posts_to_show, 'category_name'  => 'alert', 'post_status' => 'publish'));
	?>
	<section class="alerts 
		<?php if ($my_query->found_posts <= 0) {
			echo 'hidden';
		} ?>">
		<?php
		while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<article class="post">
				<header class="postmeta">
					<ul>
						<li><img src="//globalassets.provo.edu/image/icons/calendar-lt.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
					</ul>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

				</header>
			</article>
			<button class="closeAlert"><img src="https://globalassets.provo.edu/image/icons/round-delete-button-white.svg" alt="Close Alerts" /></button>
		<?php endwhile;
		?>

	</section>
	<address class="headerAddress">
		280 West 940 North Provo, Utah 801-374-4800
	</address>
	<?php
	wp_reset_query();
	?>

	<h1 class="novisibility">Provo City School District</h1>
	<section id="stickyArea" class="posts">
		<div class="stories">
			<?php
			$sticky_query = new WP_Query(array(
				'posts_per_page' => 3,
				'post__in' => get_option('sticky_posts'),
				'ignore_sticky_posts' => 1,
				'post_status' => 'publish'
			));

			if ($sticky_query->have_posts()) :
				while ($sticky_query->have_posts()) : $sticky_query->the_post();
					$background_image = '';
					if (get_field('featured_image', $post_id)) {
						$background_image = get_field('featured_image');
					} elseif (has_post_thumbnail()) {
						$background_image = get_the_post_thumbnail_url();
					} else {
						$background_image = get_stylesheet_directory_uri() . '/assets/images/building-image.jpg';
					}
			?>
					<article style="background-image: url('<?php echo esc_url($background_image); ?>');">
						<a href="<?php the_permalink(); ?>">
							<h2><?php the_title(); ?></h2>
						</a>
					</article>
			<?php endwhile;
			else :
				echo '<p>No Sticky Posts Found</p>';
			endif;
			wp_reset_postdata();
			?>
		</div>
	</section>
	<div id="belowSlider">
		<section id="stayCurrent"><!-- Hero Link Area Start -->
			<?php
			// Check rows exists.
			if (have_rows('hero_link_group')) {
				// Loop through rows.
				echo '<ul>';
				while (have_rows('hero_link_group')) : the_row();
					//display row
					echo '<li><a href="' . get_sub_field('hero_link_address') . '">' . get_sub_field('hero_link_label') . '</a></li>';
				// End loop.
				endwhile;
				echo '</ul>';
			}
			?>
		</section><!-- Hero Link Area End -->
		<section class="wpMenu"><!-- Highlight Menu Buttons Start -->
			<?php
			wp_reset_query();
			$topMenu = get_field('select_a_menu');
			wp_nav_menu(array('menu' => $topMenu));
			?>
		</section><!-- Highlight Menu Buttons End -->
		<!-- I am Buttons Home Page End -->
		<section id="homeNews" class="posts"> <!-- News Home Page Start -->
			<h1>District News & Events</h1>
			<p>The latest news from Provo City School District</p>
			<div class="stories">
				<?php
				$the_query = new WP_Query(array(
					'posts_per_page' => 3,
					'post_type' => array('post', 'podcast'),
					'post_status' => 'publish',
					'ignore_sticky_posts' => true, // Exclude sticky posts
					'date_query' => array(
						array(
							'after' => 'September 1, 2024',
							'inclusive' => true,
						),
					),
				));
				if ($the_query->have_posts()) :
					while ($the_query->have_posts()) : $the_query->the_post();
						$background_image = '';
						if (get_field('featured_image', $post_id)) {
							$background_image = get_field('featured_image');
						} elseif (has_post_thumbnail()) {
							$background_image = get_the_post_thumbnail_url();
						} else {
							$background_image = get_stylesheet_directory_uri() . '/assets/images/building-image.jpg';
						}
				?>
						<article style="background-image: url('<?php echo esc_url($background_image); ?>');">
							<a href="<?php the_permalink(); ?>">
								<h2><?php the_title(); ?></h2>
							</a>
						</article>
				<?php endwhile;
				else :
					echo '<p>No Content Found</p>';
				endif;
				?>
			</div>
			<p class="moreNews"><a href="https://provo.edu/news/">Read More District News <span class="rightarrow"></span></a></p>
			<h2>News Categories</h2>
			<div class="categories-6h">
				<?php wp_nav_menu(array('menu' => 'frontpage-categories')); ?>
			</div>
		</section> <!-- News Home Page End -->
		<section class="sociallinks"><!-- Start Social Media -->
			<h1>Social Media</h1>
			See what's being discussed & shared
			<ul>
				<li>
					<a href="https://www.instagram.com/provocityschooldistrict/"><img src="https://globalassets.provo.edu/image/icons/instagram-social-network-logo-of-photo-camera.svg" alt="Link to Instagram" /></span></a>
				</li>
				<li><a href="https://www.facebook.com/provoschooldistrict/"><img src="https://globalassets.provo.edu/image/icons/facebook-app-logo.svg" alt="Link to Facebook" /></span>
					</a>
				</li>
			</ul>
		</section><!-- End Social Media -->
	</div><!-- End of post slider content -->
</main><!-- End of #mainContent -->
<?php
get_footer();
?>
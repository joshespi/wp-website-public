<?php
get_header();
?>
<main id="mainContent" class="sidebar">

	<section class="content page">
		<?php custom_breadcrumbs(); ?>
		<div id="currentPage">
			<h1>404 Page not Found</h1>
			<h2>Oops! The web page you&#39;re looking for can&#39;t be found.</h2>
			<img id="image404" class="" src="https://globalassets.provo.edu/image/404/404error1.jpg" alt="" />
			<!--[if lte IE 9]>
					<script src="https://api.cludo.com/scripts/xdomain.js" slave="https://api.cludo.com/proxy.html"></script>
					<![endif]-->
			<script id="cludo-404-script" data-cid="10000352" data-eid="10000520">
				(function() {
					var s = document.createElement('script');
					s.type = 'text/javascript';
					s.async = true;
					s.src = 'https://customer.cludo.com/scripts/404/cludo-404.js';
					var x = document.getElementsByTagName('script')[0];
					x.parentNode.insertBefore(s, x);
				})();
			</script>
		</div>
	</section>
	<aside id="rightSidebar" class="rightSidebar">
		<?php
		$page = get_post(80354);
		if ($page) {
			echo do_shortcode(apply_filters('the_content', $page->post_content));
		} else {
			echo '<p>Page not found.</p>';
		}
		?>
	</aside>
</main>
<?php
get_footer();
?>
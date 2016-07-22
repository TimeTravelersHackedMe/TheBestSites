<?php

get_header();
$cb_post_id = $post->ID;
$cb_featured_image_style_override_onoff = ot_get_option('cb_post_style_override_onoff', 'off');
$cb_featured_image_style_override_style = ot_get_option('cb_post_style_override', 'standard');
$cb_post_format = get_post_format();
$cb_featured_image_style = get_post_meta( $cb_post_id, 'cb_featured_image_style', true );
$cb_featured_image_style_override_post_onoff = get_post_meta( $cb_post_id, 'cb_featured_image_style_override', true );
$cb_sidebar_position = cb_get_sidebar_setting();
$cb_featured_image_style_cache = $cb_content_class = $cb_fis_size_output = NULL;
$cb_review_checkbox = get_post_meta($cb_post_id, 'cb_review_checkbox', true );

if ( ( $cb_featured_image_style_override_onoff == 'on' ) && ( $cb_featured_image_style_override_post_onoff != 'on') ) {
   $cb_featured_image_style = $cb_featured_image_style_override_style;
}

if ( $cb_featured_image_style == NULL ) {
     $cb_featured_image_style = 'standard';
}
if ( $cb_featured_image_style == 'standard-uncrop' ) {
	$cb_featured_image_style = 'standard';
}

if ( ( $cb_post_format == 'video') || ( $cb_post_format == 'audio') ) {
	$cb_featured_image_style_cache = $cb_featured_image_style;
	$cb_featured_image_style = $cb_post_format;
}
if ( $cb_post_format == 'gallery' ) {
	$cb_gallery_post_images = get_post_meta( $cb_post_id, 'cb_gallery_post_images', true );
        
    if ( $cb_gallery_post_images != NULL ) {

		$cb_featured_image_style = $cb_post_format;
	}
}

$cb_fis_size = cb_get_fis_size($cb_post_id);

if ( ( ot_get_option( 'cb_postload_onoff', 'off' ) == 'off' ) && ( $cb_fis_size == 'box' ) ) { 
	$cb_content_class = 'wrap '; 
}
?>

<div id="cb-content" class="<?php echo esc_attr($cb_content_class); ?>clearfix">
	
	<div class="cb-entire-post cb-first-alp clearfix<?php echo esc_attr( $cb_fis_size_output ); ?>"<?php cb_alp( $cb_post_id ); ?>>

		<?php if ( ( $cb_featured_image_style != 'off' ) && ( $cb_featured_image_style_cache != 'off' ) && ( $cb_featured_image_style != 'standard' ) && ( $cb_featured_image_style_cache != 'standard' )  ) { do_shortcode ( cb_featured_image_style( $cb_featured_image_style, $post ) ); } ?>
			
		<div class="cb-post-wrap cb-wrap-pad wrap clearfix<?php echo esc_attr( cb_get_post_sidebar_position( $cb_post_id ) ); echo esc_attr( cb_get_singular_fs( $cb_post_id ) ); ?>">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<?php cb_schema_meta( $cb_post_id ); ?>

					<div class="cb-main clearfix">

						<?php cb_breadcrumbs(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

							<?php if ( ( $cb_featured_image_style == 'off' ) || ( $cb_featured_image_style == 'standard' ) || ( $cb_featured_image_style_cache == 'standard' ) || ( $cb_featured_image_style_cache == 'off' )  ) { cb_featured_image_style( $cb_featured_image_style, $post ); }; ?>
							<?php 
							$website_name = get_post_meta( $cb_post_id, 'website_name', true );
							$android_app_link = get_post_meta( $cb_post_id, 'android_app_link', true );
							$blackberry_app_link = get_post_meta( $cb_post_id, 'blackberry_app_link', true );
							$iphone_app_link = get_post_meta( $cb_post_id, 'iphone_app_link', true );
							$windows_phone_app_link = get_post_meta( $cb_post_id, 'windows_phone_app_link', true );
							$windows_app_link = get_post_meta( $cb_post_id, 'windows_app_link', true );
							$chrome_extension_link = get_post_meta( $cb_post_id, 'chrome_extension_link', true );
							$chrome_app_link = get_post_meta( $cb_post_id, 'chrome_app_link', true );
							$firefox_url = get_post_meta( $cb_post_id, 'firefox_url', true );
							$windows_download_link = get_post_meta( $cb_post_id, 'windows_download_link', true );
							$mac_download_link = get_post_meta( $cb_post_id, 'mac_download_link', true );
							$linux_download_link = get_post_meta( $cb_post_id, 'linux_download_link', true );
							if ($android_app_link != '' || $blackberry_app_link != '' || $iphone_app_link != '' || $windows_phone_app_link != '' || $windows_app_link != '' || $chrome_extension_link != '' || $chrome_app_link != '' || $firefox_url != '') { ?>
							<div class="website-apps">
								<h3 class="apps-title"><?php echo $website_name ?> Is Available On:</h3>
								<?php if($android_app_link != '') { ?>
									<a href="<?php echo $android_app_link ?>"><i class="fa fa-android" aria-hidden="true"></i> Android</a>
								<?php } ?>
								<?php if($blackberry_app_link != '') { ?>
									<a href="<?php echo $blackberry_app_link ?>">BlackBerry</a>
								<?php } ?>
								<?php if($iphone_app_link != '') { ?>
									<a href="<?php echo $iphone_app_link ?>"><i class="fa fa-apple" aria-hidden="true"></i> iPhone</a>
								<?php } ?>
								<?php if($windows_phone_app_link != '') { ?>
									<a href="<?php echo $windows_phone_app_link ?>"><i class="fa fa-windows" aria-hidden="true"></i> Windows Phone</a>
								<?php } ?>
								<?php if($windows_app_link != '') { ?>
									<a href="<?php echo $windows_app_link ?>"><i class="fa fa-windows" aria-hidden="true"></i> Windows</a>
								<?php } ?>
								<?php if($chrome_extension_link != '') { ?>
									<a href="<?php echo $chrome_extension_link ?>"><i class="fa fa-chrome" aria-hidden="true"></i> Chrome Extension</a>
								<?php } ?>
								<?php if($chrome_app_link != '') { ?>
									<a href="<?php echo $chrome_app_link ?>"><i class="fa fa-chrome" aria-hidden="true"></i> Chrome App</a>
								<?php } ?>
								<?php if($firefox_url != '') { ?>
									<a href="<?php echo $firefox_url ?>"><i class="fa fa-firefox" aria-hidden="true"></i> Firefox</a>
								<?php } ?>
							</div>
							<?php }	?>
							<?php 
							if(in_category('websites') || in_category('webapps')) {
							function pure_url($url) {
   if ( substr($url, 0, 7) == 'http://' ) {
      $url = substr($url, 7);
   }
   if ( substr($url, 0, 8) == 'https://' ) {
      $url = substr($url, 8);
   }
   if ( substr($url, 0, 4) == 'www.') {
      $url = substr($url, 4);
   }
   if ( strpos($url, '/') !== false ) {
      $ex = explode('/', $url);
      $url = $ex['0'];
   } 
   return $url;
}
							$website_url = get_post_meta( $cb_post_id, 'website_url', true );
							echo '<div class="alexa-rank"><h3>';
								echo $website_name;
								echo '\'s traffic rank is <span>';
								$alexa_rank = AlexaRankbySiteName(pure_url($website_url));
								echo '</span> globally</h3></div>';
							$rss_link = get_post_meta( $cb_post_id, 'rss_link', true);
	if($rss_link != '') {
		$rss = new DOMDocument();
	$rss->load('http://wordpress.org/news/feed/');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
	$limit = 5;
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$date = date('l F d, Y', strtotime($feed[$x]['date']));
		echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
		echo '<small><em>Posted on '.$date.'</em></small></p>';
		echo '<p>'.$description.'</p>';
	}
							}
?>
							?>
							<?php } ?>
							<section class="cb-entry-content clearfix" <?php  if ( ( $cb_review_checkbox == 'on' ) || ( $cb_review_checkbox == '1' ) ) { echo 'itemprop="reviewBody"'; } else { echo 'itemprop="articleBody"'; } ?>>

								<?php the_content(); ?>
								<?php wp_link_pages('before=<div class="cb-pagination clearfix">&after=</div>&next_or_number=number&pagelink=<span class="cb-page">%</span>'); ?>
								
							</section> <!-- end article section -->
							
							<footer class="cb-article-footer">
								<?php
									if ( ot_get_option('cb_tags_onoff', 'on') != 'off' ) { the_tags('<p class="cb-tags cb-post-footer-block"> ', '', '</p>'); }
									echo cb_sharing_block( $post ); 
									echo cb_post_footer_ad();
									if ( $post->post_type != 'attachment' ) { cb_previous_next_links(); }
									echo cb_about_author( $post );
									cb_related_posts(); 
									comments_template(); 
									
			                     ?>
							</footer> <!-- end article footer -->

						</article> <!-- end article -->						

					</div> <!-- end .cb-main -->

			<?php endwhile; ?>

			<?php endif; ?>

			<?php if ( ( $cb_sidebar_position != 'nosidebar' ) && ( $cb_sidebar_position != 'nosidebar-fw' ) ) { get_sidebar(); } ?>

		</div>

	</div>	

</div> <!-- end #cb-content -->
<?php cb_alp_ldr(); ?>

<?php get_footer(); ?>

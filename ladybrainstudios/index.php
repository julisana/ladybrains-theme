<?php 
    global $post,$wp_query; 
    get_header();
?>
<!-- Container
======================================================================== -->
<div class="blog-filter-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12 blog-filer">
                <ul>
                    <?php
                        if (get_terms( 'portfolio_cat', array('hide_empty' => true) )) {
                    ?>
                    <li class="active">
                        <a href="<?php if( get_option( 'show_on_front' ) == 'page' ) echo get_permalink( get_option('page_for_posts' ) ); else echo bloginfo('url'); ?>">
                            <?php _e('All','oneengine') ?>
                        </a>
                    </li>
                    <?php
                        }

                        $categories = get_terms( 'portfolio_cat', array('hide_empty' => true) );
                        foreach ($categories as $category) {
                    ?>
                    <li>
                        <a href="<?php echo get_term_link( $category, 'portfolio' );?>">
                            <?php echo $category->name ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="site-inner">
    <a name="portfolio"></a>
    <div class="wrap">
    	<div class="container">
    		<div class="row">
    			<div class="blog-wrapper animation-wrapper col-md-12" style="margin:10px 0 10px">
    				<div class="row" id="posts_container">
						<?php
							$i = 0;
							if (get_posts(['post_type' => 'portfolio'])) :
					        	foreach (get_posts(['post_type' => 'portfolio', 'orderby' => 'post_date', 'order' => 'DESC']) as $post) {
                                    /*echo "<pre>";
                                    print_r($post);
                                    echo "</pre>";*/
                                    //the_post();
					    ?>
						<div class="col-md-4 et-blog-post animated fadeInUp" style="-webkit-animation-duration: 500ms; -moz-animation-duration: 500ms; -o-animation-duration: 500ms;animation-duration: 500ms; animation-delay: 300ms; -webkit-animation-delay:300ms; -moz-animation-delay:300ms;-o-animation-delay:300ms;">
                            <div class="image-blog-wrapper">
                                <a href="<?php echo get_permalink($post->ID); ?>">
    								<?php echo get_the_post_thumbnail( $post->ID, 'full', array('class' => 'et-post-thumbnail img-responsive') ); ?>
                                </a>
                                <div class="et-post-data-left mobile-blog">
                                    <span class="et-post-month"><?php echo get_the_time('M', $post); ?></span>
                                    <span class="et-post-date"><?php echo get_the_time('d', $post); ?></span>
                                    <a href="#" data-id="<?php echo $post->ID; ?>" class="et-like-post <?php echo is_like_post($post->ID); ?>">
                                        <span class="et-post-heart"><i class="fa fa-heart"></i><span class="count"><?php echo get_post_meta($post->ID, 'et_like_count', true) ? get_post_meta($post->ID, 'et_like_count', true) : 0; ?></span></span>
                                    </a>
                                </div>
			                </div>
							<div class="clearfix"></div>
							<div class="et-post-data container">
								<div class="row">
									<div class="col-md-2 col-sm-2 et-post-data-left">
										<span class="et-post-month"><?php echo get_the_time('M', $post); ?></span>
										<span class="et-post-date"><?php echo get_the_time('d', $post); ?></span>
										<a href="#" data-id="<?php echo $post->ID; ?>" class="et-like-post <?php echo is_like_post($post->ID); ?>">
											<span class="et-post-heart"><i class="fa fa-heart"></i><span class="count"><?php echo get_post_meta($post->ID, 'et_like_count', true) ? get_post_meta($post->ID, 'et_like_count', true) : 0; ?></span></span>
										</a>
									</div>
									<div class="col-md-10 col-sm-10 et-post-data-right">
										<h1 class="title-blog"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h1>
										<div class="et-post-info">
											<?php _e('Post by','oneengine'); ?> <?php get_the_author_meta(); ?> | <?php the_category(); ?> | <?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?> 
										</div>
										<div class="clearfix"></div>
										<div class="et-post-excerpt">
											<?php echo $post->post_content; ?>
										</div>
										<div class="clearfix"></div>
										<a href="<?php echo get_permalink($post->ID); ?>" class="read-more"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp;<?php _e('Read more','oneengine'); ?></a>
									</div>
								</div>
							</div>
						</div>
					 	<?php 
						$i++;
						if($i % 3 == 0) echo '<div class="clearfix"></div>';
					 			}
					 		endif;
					 		wp_reset_query();
					 	?>
    				</div>
    			</div>
    			<input type="hidden" id="current_page" value="<?php echo get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ?>">
				<input type="hidden" id="max_page" value="<?php echo $wp_query->max_num_pages ?>">	
    		</div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php
    $selectedPages = $pageIds = $pages = [];
    if (oneengine_option('page_select')) {
        $selectedPages = oneengine_option('page_select');
    }

    foreach ($selectedPages as $pageId => $isSelected) {
        if ($isSelected) {
            $pageIds[] = $pageId;
        }
    }
    if (!empty($pageIds)) {
        $pages = get_pages(['include' => $pageIds]);
    }
?>

<?php
    foreach ($pageIds as $pageId) { 
        foreach ($pages as $page) {
            if ($page->ID == $pageId) { ?>
<div class="page-wrapper" style="width: 100% !important; background-color:rgba(0,0,0,.5);margin:15px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <h1><?php echo $page->post_title; ?></h1>
                    <div class="clearfix"></div>
                    <div>
                        <?php echo $page->post_content; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
    	</div>
    </div>
</div>

<?php } } } ?>

<!-- Container / End -->
<?php get_footer(); ?>

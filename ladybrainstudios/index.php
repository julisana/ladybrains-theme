<?php 
    global $post,$wp_query; 
    get_header();
?>
<!-- Container
======================================================================== -->
<div class="site-inner">
    <div class="wrap">
    	<div class="container">
    		<div class="row">
    			<div class="blog-wrapper animation-wrapper col-md-12" style="margin:10px 0 10px">
    				<div class="row" id="posts_container">
						<?php
							$i = 0;
							if (have_posts()) :
					        	while(have_posts()) : the_post();
					    ?>    					
						<div class="col-md-6 et-blog-post animated fadeInUp" style="-webkit-animation-duration: 500ms; -moz-animation-duration: 500ms; -o-animation-duration: 500ms;animation-duration: 500ms; animation-delay: 300ms; -webkit-animation-delay:300ms; -moz-animation-delay:300ms;-o-animation-delay:300ms;">
			            	<div class="image-blog-wrapper">
								<?php the_post_thumbnail( 'full', array('class' => 'et-post-thumbnail img-responsive') ); ?>
                                <div class="et-post-data-left mobile-blog">
                                    <span class="et-post-month"><?php the_time('M');?></span>
                                    <span class="et-post-date"><?php the_time('d');?></span>
                                    <a href="#" data-id="<?php echo $post->ID; ?>" class="et-like-post <?php echo is_like_post($post->ID); ?>">
                                        <span class="et-post-heart"><i class="fa fa-heart"></i><span class="count"><?php echo get_post_meta($post->ID, 'et_like_count', true) ? get_post_meta($post->ID, 'et_like_count', true) : 0; ?></span></span>
                                    </a>
                                </div>
			                </div>
							<div class="clearfix"></div>
							<div class="et-post-data container">
								<div class="row">
									<div class="col-md-2 col-sm-2 et-post-data-left">
										<span class="et-post-month"><?php the_time('M');?></span>
										<span class="et-post-date"><?php the_time('d');?></span>
										<a href="#" data-id="<?php echo $post->ID; ?>" class="et-like-post <?php echo is_like_post($post->ID); ?>">
											<span class="et-post-heart"><i class="fa fa-heart"></i><span class="count"><?php echo get_post_meta($post->ID, 'et_like_count', true) ? get_post_meta($post->ID, 'et_like_count', true) : 0; ?></span></span>
										</a>
									</div>
									<div class="col-md-10 col-sm-10 et-post-data-right">
										<h1 class="title-blog"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
										<div class="et-post-info">
											<?php _e('Post by','oneengine'); ?> <?php the_author(); ?> | <?php the_category(); ?> | <?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?> 
										</div>
										<div class="clearfix"></div>
										<div class="et-post-excerpt">
											<?php the_excerpt() ?>
										</div>
										<div class="clearfix"></div>
										<a href="<?php the_permalink(); ?>" class="read-more"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp;<?php _e('Read more','oneengine'); ?></a>
									</div>
								</div>
							</div>
						</div>
					 	<?php 
						$i++;
						if($i % 2 == 0) echo '<div class="clearfix"></div>';
					 			endwhile;
					 		endif;
					 		wp_reset_query();
					 	?>
    				</div>
    			</div>
    			<input type="hidden" id="current_page" value="<?php echo get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ?>">
				<input type="hidden" id="max_page" value="<?php echo $wp_query->max_num_pages ?>">	
    		</div>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="page-wrapper col-md-10" style="margin: 10px 0;">
                    <div class="row" style="background-color:rgba(0,0,0,.5); background-repeat:no-repeat; background-size:cover; background-attachment: fixed;padding:15px;">
                    <?php $about = get_page_by_path( 'about' ); ?>
                        <h1><?php echo $about->post_title; ?></h1>
                        <div class="clearfix"></div>
                        <div>
                            <?php echo $about->post_content; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
    	</div>
    </div>
</div>
<!-- Container / End -->
<?php get_footer(); ?>
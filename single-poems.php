<?php
/**
 * The Template for displaying scene single posts.
 *
 * 
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
   <main id="main" class="site-main" role="main">
   <article class="post status-publish poem format-standard hentry">
   	
   <header class="poem-title entry-header"><a href="<?php the_permalink(); ?>" rel="bookmark"><h2 class="entry-title"><?php the_title(); ?></h2></a></header>
   <div class="go-home"><a href="http://artfulness.rampages.us/session-one/activity-writing/">Return to the Writing Exercise</div>
   <?php if( $post->post_parent !== 0 ) {
	    require_once( plugin_dir_path( __FILE__ ).'/templates/blackenedpoem.php'); 

	} else {
	    require_once( plugin_dir_path( __FILE__ ).'/templates/poems.php'); 	    
	}; ?>
   </article>

	<div class="child-poems-list">		
	 <?php 
	 $poemTitle ='<h3>Submitted Poems</h3>';
	 $children = wp_list_pages('title_li='.$poemTitle.'&child_of='.get_the_ID().'&post_type=poems&echo=1'); ?>
	 </div>

	

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		?>
	</main>	
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
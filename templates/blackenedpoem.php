	 
	 <?php 
	 $parentlink = get_permalink( $post->post_parent );
	 echo '<a href="' . $parentlink . '"">Go back to the source</a>';
	 ?>
	  <div id="blackened">
	  <?php the_content();?>	  	
	</div>
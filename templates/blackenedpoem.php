	 
	 <?php 
	 $parentlink = get_permalink( $post->post_parent );
	 echo '<div class="poem-parent"><a href="' . $parentlink . '"">Go back to the source</a></div>';
	 ?>
	  <div id="blackened">
	  	<div class="entry-content" id="b-poem">
	  		<?php the_content();?>	  	
	  	</div>	
	</div>
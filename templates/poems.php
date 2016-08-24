<div id="poemsource">
	 <div class="entry-content" id="origin">

	  <?php 
      echo the_content();
	  ?>
	 	
	  </div>	
	  <div class="poem-buttons">
	   <form id="post-submission-form">
				<div>
					<input  type="hidden" name="post-submission-title" id="post-submission-title" required aria-required="true"></input>
				</div>
				
				<div>
					<input  type="hidden" name="post-submission-content" id="post-submission-content"></input>
				</div>
				<div>
					<input  type="hidden" rows="1" cols="20" name="post-submission-parent-id" id="post-submission-parent-id" value="<?php the_id(); ?>"></input>
				</div>
				<input onclick="grabIt();" type="submit" class="poembutton" value="<?php esc_attr_e( 'Submit', 'your-text-domain'); ?>">
		</form>
				<button id="save_image_locally" class="poembutton" >Download an Image</button>	

		</div>	   
</div>



    

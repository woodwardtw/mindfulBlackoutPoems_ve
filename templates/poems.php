<div class="flex-container" id="poemsource">
	  <div class="flex-item" id="origin">
	  <?php 
      echo the_content();

      echo '<div id="parent-id">' . the_id() . '</div>';
	  ?>
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
				<input onclick="grabIt();" type="submit" value="<?php esc_attr_e( 'Submit', 'your-text-domain'); ?>">
			</form>	  	
	  </div>	 
</div>


		<button id="save_image_locally" >Download an Image</button>	

    

<div id="poemsource">
<div class="poem-directions">Click on the words below to erase them. Click on the colored bar to bring them back. When you're done you can submit your poem or download it as image using the buttons at the bottom of the page.</div>

	 <div class="entry-content" id="origin">

	  <?php 
      echo the_content();
	  ?>
	  <div class="source">
	  	Source text: <a href="<?php echo get_post_meta($post->ID, 'primary_source_source_url', true) ?>">
	  		<?php echo get_post_meta($post->ID, 'primary_source_source_title', true) ?>	  		
	  	</a>	
	 </div>	
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
				<!--<input onclick="grabIt();" type="submit" class="poembutton" value="<?php esc_attr_e( 'Submit', 'your-text-domain'); ?>">-->
		</form>

				<?php 
				$child_title = 'fake title';
				$child_body = 'fake body';
				$poem_title = get_the_title();
				$child_parent = '';
				if ($poem_title == 'Virginia')
					{
						$child_parent = 16784;
					} elseif ($poem_title == 'Earth')
					{
						$child_parent = 16788;
					} else {
						$child_parent = 16780;
					}					

				$values = array('child_poem_title' => $child_title,
					'child_poem_body' => $child_body,
					'parent_poem' => $child_parent
					);
				gravity_form( 1, false, false, false, $values, false);
				
				?>
				<button id="save_image_locally" class="button poembutton" >Download Your Poem as an Image</button>	

		</div>	   
</div>

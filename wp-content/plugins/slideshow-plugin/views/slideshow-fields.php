<div class="wrap">
    <div class="form-control">
        <label>
            Width
            <input type="number" class="large-text" name="slideshow_width" value="<?php echo $width; ?>">
        </label>
    </div>
    <br>
    <div class="form-control">
        <label>
            Height
            <input type="number" class="large-text" name="slideshow_height" value="<?php echo $height; ?>">
        </label>
    </div>
    <div class="form-control">
        <label>
            Duration
            <input type="number" class="large-text" name="slideshow_duration" value="<?php echo $duration; ?>">
        </label>
    </div>
    <br>
    <!--<div class="form-control">
		<label>
			Slides
			<input type="file" class="large-text" name="slideshow_slides" multiple>
		</label>
	</div>-->
    <form method='post'>
        <div class='image-preview-wrapper'>
			<?php if($slides) {
				$slides_array = explode(',', $slides);
				foreach($slides_array AS $slide) {
					?>
                    <span style="border: 1px solid #000;display: inline-block;">
                    <img id='image-preview' src='<?php echo wp_get_attachment_url($slide); ?>' height='100' style="display: block;">
                        <?php echo wp_get_attachment_caption($slide); ?>
					</span>
                        <?php
                    
                    
				}
			} ?>
            <img id='image-preview' src='<?php echo wp_get_attachment_url(get_option('media_selector_attachment_id')); ?>' height='100'>
        </div>
        <input id="upload_image_button" type="button" class="button" value="<?php _e('Upload image'); ?>"/>
        <input type='hidden' name='slideshow_slides' id='slideshow_slides' value="<?php echo $slides ?>">
        <!--<input type="submit" name="submit_image_selector" value="Save" class="button-primary">-->
    </form>

</div>
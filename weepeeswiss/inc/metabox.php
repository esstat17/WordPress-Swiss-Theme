<?php
/**
 * Metabox Add Action
 *
 * @since 1.0.0
 * @todo Replace only if your creating your own Plugin
 * @todo dst - Find all and replace text
 * @todo DST - Find all and replace text
 * @todo page - Find all and replace text
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Register Two (2) Meta Boxes for POST.
 * @link Add Meta Box https://developer.wordpress.org/reference/functions/add_meta_box/
 * @link Save Post https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function weepeeswiss_metabox_post() {
		$post_type = 'post';
		add_meta_box( 
			'weepeeswiss_normal_high', __( 'Add Meta Contents', 'weepeeswiss' ),  
			'weepeeswiss_display_normal_high_metabox', // Callback function
			$post_type, 
			'normal', 
			'high' 
		);
}
add_action( 'add_meta_boxes', 'weepeeswiss_metabox_post' );

/**
 * Register Two (2) Meta Boxes for PAGE.
 * @link Add Meta Box https://developer.wordpress.org/reference/functions/add_meta_box/
 * @link Save Post https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function weepeeswiss_metabox_page() {
		$post_type = 'page';
		add_meta_box( 
			'weepeeswiss_normal_high', __( 'Add Meta Contents', 'weepeeswiss' ),  
			'weepeeswiss_display_normal_high_metabox', // Callback function
			$post_type, 
			'normal', 
			'high' 
		);
}
add_action( 'add_meta_boxes', 'weepeeswiss_metabox_page' );


/**
 * Register Two (2) Meta Boxes.
 * @link Add Meta Box https://developer.wordpress.org/reference/functions/add_meta_box/
 * @link Save Post https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function weepeeswiss_post_meta_boxes() {
		$post_type = 'page';
		add_meta_box( 
			'weepeeswiss_normal_high', __( 'Add Meta Contents', 'weepeeswiss' ),  
			'weepeeswiss_display_normal_high_metabox', // Callback function
			$post_type, 
			'normal', 
			'high' 
		);
}
add_action( 'add_meta_boxes', 'weepeeswiss_post_meta_boxes' );

/**
 * Metabox for post IDs dropdown
 *
 * @since 1.0.0
 * @param array $post Current post data
 * @return void
 */

function weepeeswiss_display_normal_high_metabox($post) {
	$options = "";
	$post_id = $post->ID; // Post ID of a curret Post Type `post`	

	// Add some test data here - a custom field, that is
	$meta_key='weepeeswiss_postmeta_key';
	$get_meta = get_post_meta($post_id, $meta_key);

	var_dump($get_meta[2][1]);
?>
			<table class="form-table-weepee form-table-weepee-1" style="width:100%">
					<thead>
						<tr><td><p><?php _e('You can add content before the post, after the post, and side right of the post. You can also insert your shortcode here.', 'weepeeswiss'); ?></p></td></tr>
					<tr>
						<th align="left"><label for="html-content"><?php _e('HTML Content', 'weepeeswiss'); ?></th>
						<th align="left"><label for="position"><?php _e('Placement', 'weepeeswiss'); ?></th>
						<th align="left"><span style="color:#5cb85c;cursor:pointer;" class="dashicons dashicons-plus weepee-plus"></span></th>
					</tr>
				 	</thead>
				 	<tbody>
				 	<tr>
				 	<?php 
				 		if(isset($get_meta) && !empty($get_meta)):
				 			for($i=0; $i<count($get_meta[0]); $i++):	
				 	?>	
						<td style="width: 82%">
							<textarea style="width: 98%" id="weepeeswiss_postmeta_content" class="weepeeswiss_postmeta_content" name="weepeeswiss_postmeta_key[0][]"><?php echo $get_meta[0][$i]; ?></textarea>
						</td>                      
						<td>
							<select id="weepeeswiss-position" class="weepeeswiss_postmeta_position"  style="width: 100%" name="weepeeswiss_postmeta_key[1][]">
								<option <?php  echo $get_meta[1][$i]==1? 'selected="selected"':''; ?> value="1" data-pos="1"><?php _e('Top Content', 'weepeeswiss'); ?></option>
								<option <?php  echo $get_meta[1][$i]==2? 'selected="selected"':''; ?> value="2" data-pos="2"><?php _e('Bottom Content', 'weepeeswiss'); ?></option>
								<option <?php  echo $get_meta[1][$i]==3? 'selected="selected"':''; ?> value="3" data-pos="3"><?php _e('Right Content', 'weepeeswiss'); ?></option>
								<option <?php  echo $get_meta[1][$i]==4? 'selected="selected"':''; ?> value="4" data-pos="4"><?php _e('Welcome Screen Content', 'weepeeswiss'); ?></option>
							<?php if('post' == get_post_type($post_id) ): ?>
								<option <?php  echo $get_meta[1][$i]==5? 'selected="selected"':''; ?> value="5" data-pos="5"><?php _e('Above Comment Form', 'weepeeswiss'); ?></option>
								<option <?php  echo $get_meta[1][$i]==6? 'selected="selected"':''; ?> value="6" data-pos="6"><?php _e('Below Comment Form', 'weepeeswiss'); ?></option>
							<?php endif; ?>
								<option <?php  echo $get_meta[1][$i]==7? 'selected="selected"':''; ?> value="7" data-pos="7"><?php _e('Header Code Insert', 'weepeeswiss'); ?></option>
								<option <?php  echo $get_meta[1][$i]==8? 'selected="selected"':''; ?> value="8" data-pos="8"><?php _e('Footer Code Insert', 'weepeeswiss'); ?></option>
							</select>
						</td>
						<td><span style="color:#c9302c" class="dashicons dashicons-no weepee-no"></span></td>
					</tr>
					<?php
							endfor;
						else:
					?>
					<tr>
						<td style="width: 82%">
							<textarea style="width: 98%" id="weepeeswiss_postmeta_content" class="weepeeswiss_postmeta_content" name="weepeeswiss_postmeta_key[0][]"></textarea>
						</td>                      
						<td>
							<select id="weepeeswiss-position" class="weepeeswiss_postmeta_position"  style="width: 100%" name="weepeeswiss_postmeta_key[1][]">
								<option value="1" data-pos="1"><?php _e('Top Content', 'weepeeswiss'); ?></option>
								<option value="2" data-pos="2"><?php _e('Bottom Content', 'weepeeswiss'); ?></option>
								<option value="3" data-pos="3"><?php _e('Right Content', 'weepeeswiss'); ?></option>
								<option value="4" data-pos="4"><?php _e('Welcome Screen Content', 'weepeeswiss'); ?></option>
							<?php if('post' == get_post_type($post_id) ): ?>
								<option value="5" data-pos="5"><?php _e('Above Comment Form', 'weepeeswiss'); ?></option>
								<option value="6" data-pos="6"><?php _e('Below Comment Form', 'weepeeswiss'); ?></option>
							<?php endif; ?>
								<option value="7" data-pos="7"><?php _e('Header Code Insert', 'weepeeswiss'); ?></option>
								<option value="8" data-pos="8"><?php _e('Footer Code Insert', 'weepeeswiss'); ?></option>
							</select>
						</td>
						<td><span style="color:#c9302c;cursor:pointer;" class="dashicons dashicons-no weepee-no"></span></td>
					</tr>

					<?php
						endif;
					?>
					</tbody>
			</table>
			<br>
			<div class="weepeeswiss-upload-wraps">
				<input id="wps-input-color" class="wps-input-color" name="weepeeswiss_postmeta_key[2][]" type="text" value="<?php echo isset($get_meta[2][0]) ? $get_meta[2][0]: ""; ?>" readonly> <span style="vertical-align:super;" class="wps-or"><?php _e('or', 'weepeeswiss'); ?></span>
				<input style="vertical-align: top;" id="wps-image_url" class="wps-upload-bg regular-text" name="weepeeswiss_postmeta_key[2][]" type="url" value="<?php echo isset($get_meta[2][1]) ? $get_meta[2][1]: ""; ?>" readonly>
				<button type="button" id="wps-insert-bg-img" class="button insert-bg-img add_media"><span class="dashicons dashicons-format-image" style="vertical-align: text-top;"></span><?php  _e('Upload Image', 'weepeeswiss'); ?></button>
				<button type="button" id="wps-clear-img" class="button button-clear-img"><?php  _e('Clear', 'weepeeswiss'); ?></button>
				<div><label><?php _e('Add Welcome Screen Image Background. e.g. 1920px x 1080px', 'weepeeswiss'); ?></label></div>
			</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		'use strict';

	    $('#wps-insert-bg-img').click(function(e) {
	        e.preventDefault();
	        var image = wp.media({ 
	            title: 'Upload Logo',
	            // mutiple: true if you want to upload multiple files at once
	            multiple: false
	        }).open()
	        .on('select', function(e){
	            // This will return the selected image from the Media Uploader, the result is an object
	            var uploaded_image = image.state().get('selection').first();
	            // We convert uploaded_image to a JSON object to make accessing it easier
	            // Output to the console uploaded_image
	            // console.log(uploaded_image);
	            var image_url = uploaded_image.toJSON().url;
	            // Let's assign the url value to the input field
	            $('#wps-image_url').val(image_url);
	        });
	    });

	    $("#wps-clear-img").click(function(event){ 
			$("#wps-image_url").val("");
		})

	    // WP Color Picker
	    $("#wps-input-color").wpColorPicker();

	    // Dynamic JS to add input fields.
	    $(".weepee-plus").click(function(){
	        $(".form-table-weepee tbody").append($(".form-table-weepee tbody tr:last").clone(true));
	    });
	    $(".weepee-no").click(function(){ 
	        this.closest( ".form-table-weepee tbody tr" ).remove();
	    });
		
		// Input Fields Validity Check
		/*
		 * param String fieldName
		 * param Object event
		 */
		var mnmValidityCheck = function(fieldName, event){
			$('.weepeeswiss_postmeta_'+fieldName).each(function(index){
				var me = $(this);
				if(!me.val() && index != 0){
					event.preventDefault();
					if( !$(".weepee-required-"+fieldName+index).length > 0){
						me.closest( ".form-table-weepee tbody tr td" ).append('<span style="float: right; color: #ff0000;" class="weepee-required weepee-required-'+fieldName+index+'">*</span>');
						me.focus();
				  		// console.log(fieldName+' input #'+index+' is missing');
			  		}
		  		} else {
		  			$( '.weepee-required-'+fieldName+index ).remove();
		  			// console.log(fieldName+' input #'+index+' has value');
		  		}
			}); 
		}
		$('input[name=save]').click(function(event){ 
			mnmValidityCheck('content', event);
			mnmValidityCheck('position', event);
		})		  
	});
</script>
<?php
}

/**
 * Save Post for Metabox Best Practices
 *  
 * @since 1.0.0
 * @return void
 */

function weepeeswiss_save_meta_box($post_id){

	// If post is an autosave, avoid it!
	if ( wp_is_post_autosave( $post_id || defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) ) {
		return;
 	}

	// If this isn't a 'page' post type, don't update it.
	// if ( get_post_type( $post_id ) != 'page' ) 
		// return;
	
	$meta_key='weepeeswiss_postmeta_key'; 

	// If the custom field is found, update the postmeta record
		// Also, filter the HTML just to be safe
	if ( isset( $_POST[$meta_key]  ) ) {
		update_post_meta( $post_id, $meta_key,  esc_html( $_POST[$meta_key] ) );
	}
	
	$old_postmeta = get_post_meta($post_id, $meta_key);
	$new_postmeta = isset ( $_POST[$meta_key] )  ? $_POST[$meta_key] : array();
	
	// If there's no values, delete post meta;
	if ( empty ($new_postmeta) ) {
	   // completely delete all meta values for the post
	   delete_post_meta($post_id, $meta_key);
	} else {
	  $already = array();
	  if ( ! empty($old_postmeta) ) {
	    foreach ($old_postmeta as $value) {
	      if ( ! in_array($value, $new_postmeta) ) {
	        // this value was selected, but now it isn't so delete it
	        delete_post_meta($post_id, $meta_key, $value);
	      } else {
	        // this value already saved, we can skip it from saving
	        $already[] = $value;
	      }
	    }
	  }
	  // we only need to save new values 
	  $to_save = array_diff($new_postmeta, $already);
	  if ( ! empty($to_save) ) {
	    foreach ( $to_save as $save_value ) {
	    		add_post_meta( $post_id, $meta_key, $save_value);
	    }
	  }
	}
}
add_action( 'save_post', 'weepeeswiss_save_meta_box' );



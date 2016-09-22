<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */
?>

<form role="search" method="get" id="searchform"
    class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div id="custom-search-input">
    	<div class="input-group">
        	<input type="text" class="form-control" placeholder="<?php _e('Search', 'weepeeswiss' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s">
            <span class="input-group-btn">
                <button id="searchsubmit" class="btn bg-color-1 color-2" type="submit">
                	<i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
        </div>
	</div>
</form>


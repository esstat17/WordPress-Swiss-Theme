<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

	<p class="comments-title">
		<?php
			printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'weepeeswiss' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</p>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'weepeeswiss' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'weepeeswiss' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'weepeeswiss' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ol class="comment-list">
		<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 34,
			) );
		?>
	</ol><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<span class="screen-reader-text"><?php _e( 'Comment navigation', 'weepeeswiss' ); ?></span>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'weepeeswiss' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'weepeeswiss' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'weepeeswiss' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
		// Custom Comment Form 
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields =  array(

			'author' => '<div class="form-group">
				<label for="name" class="col-sm-2 control-label">'. __( 'Name', 'weepeeswiss' ) .' <span class="required">*</span></label>
       			<div class="col-sm-10">
				<input type="text" class="form-control" name="author" id="author" placeholder="'. __( 'Enter your Name', 'weepeeswiss' ) .'" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . '>
				</div></div>',

			'email' => '<div class="form-group">
				<label for="name" class="col-sm-2 control-label">'. __( 'Email', 'weepeeswiss' ) .' <span class="required">*</span></label>
       			<div class="col-sm-10">
				<input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" value="' . esc_attr(  $commenter['comment_author_email'] ) .'"' . $aria_req . '>
				</div></div>',

			'url' => '<div class="form-group">
				<label for="name" class="col-sm-2 control-label">'. __( 'URL', 'weepeeswiss' ) .'</label>
       			<div class="col-sm-10">
				<input type="url" class="form-control" name="url" id="url" placeholder="'. __( 'Enter your URL', 'weepeeswiss' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '">
				</div></div>',
	
		);
		$comments_args = array(
		'class_form'      => 'comment-form form-horizontal',
        // change the title of send button 
        'label_submit'			=> __( 'Submit', 'weepeeswiss' ),
        // change the title of the reply section
        'title_reply_before' 	=> '<div id="reply-title" class="comment-reply-title"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>',
        'title_reply_after'		=> '</div>',
        'title_reply'			=> __( ' Leave Your Thought', 'weepeeswiss' ),
        'comment_notes_before' => '',
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' 	=> '',
        'fields' 				=> $fields,
		'comment_field'			=> '<div class="form-group">
			<label for="comment" class="col-sm-2 control-label">Comment</label>
			<div class="col-sm-10"><textarea class="form-control" name="comment" id="comment" rows="5"' . $aria_req . '></textarea>
			</div></div>',
        'submit_field'			=> '<p class="form-submit">%1$s %2$s</a>',
        'class_submit' 			=> 'submit btn bg-color-1 color-2 pull-right',
);

	comment_form($comments_args);

	?>

</div><!-- #comments -->

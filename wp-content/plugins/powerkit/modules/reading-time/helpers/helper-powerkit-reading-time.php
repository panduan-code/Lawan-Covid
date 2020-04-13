<?php
/**
 * Helpers Reading Time
 *
 * @package    Powerkit
 * @subpackage Modules/Helper
 */

/**
 * Calculate Post Reading Time in Minutes
 *
 * @param int $post_id The post ID.
 */
function powerkit_calculate_post_reading_time( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	$post_content     = get_post_field( 'post_content', $post_id );
	$strip_shortcodes = strip_shortcodes( $post_content );
	$strip_tags       = strip_tags( $strip_shortcodes );
	$locale           = powerkit_get_locale();

	if ( 'ru_RU' === $locale ) {
		$word_count = count( preg_split( '/\s+/', $strip_tags ) );
	} else {
		$word_count = str_word_count( $strip_tags );
	}

	$reading_time = intval( ceil( $word_count / 265 ) );

	return $reading_time;
}

/**
 * Get Post Reading Time from Post Meta
 *
 * @param int $post_id The post ID.
 */
function powerkit_get_post_reading_time( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	// Get existing post meta.
	$reading_time = get_post_meta( $post_id, '_powerkit_reading_time', true );

	// Calculate and save reading time, if there's no existing post meta.
	if ( ! $reading_time ) {
		$reading_time = powerkit_calculate_post_reading_time( $post_id );
		update_post_meta( $post_id, '_powerkit_reading_time', $reading_time );
	}

	return $reading_time;
}

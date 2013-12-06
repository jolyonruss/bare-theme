<?php
/**
 * Bare Theme back compat functionality
 *
 * Prevents Bare Theme from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible and relies on
 * many new functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage Bare_Theme
 * @since Bare Theme 1.0
 */

/**
 * Prevent switching to Bare Theme on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Bare Theme 1.0
 *
 * @return void
 */
function baretheme_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'baretheme_upgrade_notice' );
}
add_action( 'after_switch_theme', 'baretheme_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Bare Theme on WordPress versions prior to 3.6.
 *
 * @since Bare Theme 1.0
 *
 * @return void
 */
function baretheme_upgrade_notice() {
	$message = sprintf( __( 'Bare Theme requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'baretheme' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since Bare Theme 1.0
 *
 * @return void
 */
function baretheme_customize() {
	wp_die( sprintf( __( 'Bare Theme requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'baretheme' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'baretheme_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since Bare Theme 1.0
 *
 * @return void
 */
function baretheme_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Bare Theme requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'baretheme' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'baretheme_preview' );

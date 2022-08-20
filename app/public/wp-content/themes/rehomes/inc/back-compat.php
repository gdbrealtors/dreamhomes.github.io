<?php
/**
 * Prevent switching to Rehomes on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Rehomes 1.0
 */
function rehomes_switch_theme() {
    switch_theme( WP_DEFAULT_THEME );
    unset( $_GET['activated'] );
    add_action( 'admin_notices', 'rehomes_upgrade_notice' );
}

add_action( 'after_switch_theme', 'rehomes_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Rehomes on WordPress versions prior to 4.7.
 *
 * @since Rehomes 1.0
 *
 * @global string $wp_version WordPress version.
 */
function rehomes_upgrade_notice() {
    $message = sprintf( esc_html__( 'Rehomes requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'rehomes' ), $GLOBALS['wp_version'] );
    printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Rehomes 1.0
 *
 * @global string $wp_version WordPress version.
 */
function rehomes_customize() {
    wp_die( sprintf( esc_html__( 'Rehomes requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'rehomes' ), $GLOBALS['wp_version'] ), '', array(
        'back_link' => true,
    ) );
}

add_action( 'load-customize.php', 'rehomes_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Rehomes 1.0
 *
 * @global string $wp_version WordPress version.
 */
function rehomes_preview() {
    if (isset( $_GET['preview'] )) {
        wp_die( sprintf( esc_html__( 'Rehomes requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'rehomes' ), $GLOBALS['wp_version'] ) );
    }
}

add_action( 'template_redirect', 'rehomes_preview' );

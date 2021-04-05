<?php

/*
*	Theme update functions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		https://euthemians.com
*/

/**
 * Display theme update notices in the admin area
 */
function crocal_eutf_admin_notices() {

	$message = '';
	if ( is_super_admin() ) {
	}

}
add_action( 'admin_notices', 'crocal_eutf_admin_notices' );

/**
 * Dismiss notices and update user meta data
 */
function crocal_eutf_notice_dismiss() {
	if ( isset( $_GET['crocal-eutf-dismiss'] ) && check_admin_referer( 'crocal-eutf-dismiss-' . get_current_user_id() ) ) {
		$dismiss = $_GET['crocal-eutf-dismiss'];
		if ( 'dismiss_update_plugins_notice' == $dismiss ) {
			update_user_meta( get_current_user_id(), 'crocal_eutf_dismissed_notice_update_plugins' , 1 );
		}
	}
}
add_action( 'admin_head', 'crocal_eutf_notice_dismiss' );

/**
 * Delete metadata for admin notices when switching themes
 */
function crocal_eutf_update_dismiss() {
	delete_metadata( 'user', null, 'crocal_eutf_dismissed_notice_update_plugins', null, true );
}
add_action( 'switch_theme', 'crocal_eutf_update_dismiss' );


//Omit closing PHP tag to avoid accidental whitespace output errors.

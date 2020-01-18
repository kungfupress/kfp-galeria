<?php
/**
 * File: kfp-galeria/include/save-custom-field.php
 *
 * @package kfp_galeria
 */

defined( 'ABSPATH' ) || die();

add_action( 'save_post', 'kfp_galeria_save_custom_fied' );
/**
 * Graba los campos personalizados que vienen del formulario de edición del post
 *
 * @param int $post_id Post ID.
 *
 * @return bool|int
 */
function kfp_galeria_save_custom_fied( $post_id ) {
	// Comprueba que el nonce es correcto para evitar ataques CSRF.
	if ( ! isset( $_POST['galeria_nonce'] ) || ! wp_verify_nonce( $_POST['galeria_nonce'], 'graba_galeria' ) ) {
		return $post_id;
	}
	// Comprueba que el usuario actual tiene permiso para editar esto
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		wp_die(
			'<h1>' . __( 'Necesitas más privilegios para publicar contenidos.', 'kfp-galeria' ) . '</h1>' .
			'<p>' . __( 'Lo siento, no puedes crear contenidos desde esta cuenta.', 'kfp-galeria' ) . '</p>',
			403
		);
	}
	// Ahora puedes grabar los datos
	$galeria = sanitize_text_field( $_POST['galeria'] );
	update_post_meta( $post_id, '_galeria', $galeria );
	
	return true;
}

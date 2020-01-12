<?php
/**
 * Plugin Name:   KFP Galeria
 * Description:   Crear un campo personalizado para mostrar una galeria
 * Plugin URI:    https://github.com/kungfupress/kfp-galeria
 * Version:       1.0.0
 * Text Domain:   kfp-galeria
 * Plugin Author: Juanan Ruiz
 * Author URI:    https://kungfupress.com/
 *
 * @package kfp_galeria
 */

defined( 'ABSPATH' ) || die();

define( 'KFP_GALERIA_DIR', plugin_dir_path( __FILE__ ) );
define( 'KFP_GALERIA_PLUGIN_FILE', __FILE__ );
define( 'KFP_GALERIA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'KFP_GALERIA_VERSION', '1.0.0' );

// Inicializa el plugin.
require_once KFP_GALERIA_DIR . 'include/plugin-init.php';

add_action( 'add_meta_boxes', 'kfp_galeria_register_meta_box' );
/**
 * Registra Meta Box para la galería
 *
 * @return void
 */
function kfp_galeria_register_meta_box() {
	add_meta_box(
		'kfp-galeria',
		'Galería',
		'kfp_galeria_show_meta_box',
		'post',
		'normal',
		'high'
	);
}

/**
 * Muestra el meta box para asociar una galería de imágenes
 *
 * @param Post $post Objeto con la entrada o contenido actual.
 * @return void
 */
function kfp_galeria_show_meta_box( $post ) {
	$galeria = $post->_galeria;
	$html    = '<div id="mb-vista-previa-galeria">';
	if ( ! empty( $galeria ) ) {
		$galeria_ids = explode( ',', $galeria );
		foreach ( $galeria_ids as $attachment_id ) {
			$img   = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
			$html .= '<div class="mb-miniatura-galeria"><img src="';
			$html .= esc_url( $img[0] ) . '" /></div>';
		}
	}
	$html .= '</div>';
	$html .= '<input id="ids_galeria" type="hidden" size="36" name="galeria" value="';
	$html .= esc_attr( $galeria ) . '" >';
	$html .= '<div class="mb-botonera-galeria">';
	$html .= '<input id="boton_crear_galeria" class="button" type="button" value="';
	$html .= esc_html__( 'Crear/editar galería', 'kfp-galeria' ) . '" >';
	$html .= '<input id="boton_eliminar_galeria" class="button" type="button" value="';
	$html .= esc_html__( 'Eliminar galería', 'kfp-galeria' ) . '" >';
	$html .= '</div>';
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $html;
}

add_action( 'admin_enqueue_scripts', 'kfp_galeria_admin_scripts' );
/**
 * Agrega los scripts que crean la conexión entre los campos de imagen y galería y el media uploader
 *
 * @return void
 */
function kfp_galeria_admin_scripts() {
	if ( is_admin() ) {
		wp_enqueue_media(); // Carga la API de JavaScript para utilizar wp.media.
		wp_register_script( 'kfp-galeria-meta-box', KFP_GALERIA_PLUGIN_URL . 'js/gallery-meta-box.js', array( 'jquery' ), KFP_GALERIA_VERSION, true );
		wp_enqueue_script( 'kfp-galeria-meta-box' );
		wp_enqueue_style( 'kfp-galeria-admin-css', KFP_GALERIA_PLUGIN_URL . 'css/admin.css', array(), KFP_GALERIA_VERSION );
	}
}

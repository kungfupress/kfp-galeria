<?php
/**
 * File: kfp-recetas/include/show-gallery-frontend.php
 *
 * @package kfp_galeria
 */

defined( 'ABSPATH' ) || die();

add_filter( 'the_content', 'kfp_show_gallery' );
/**
 * Agrega los custom fields al contenido del post
 * Observa que los Custom Fields se devuelven como array (por si hay más de uno)
 * Por ello al llamarlo hay que cargar el primer elemento del array con [0]
 *
 * @param string $content Contenido del post actual.
 * @return string
 */
function kfp_show_gallery( $content ) {
	$custom_fields = get_post_custom();
	if ( isset( $custom_fields['_galeria'] ) ) {
		$galeria_ids = explode( ',', $custom_fields['_galeria'][0] );
		$content    .= '<div id="vista-previa-galeria">';
		foreach ( $galeria_ids as $attachment_id ) {
			$img      = wp_get_attachment_image_src( $attachment_id, 'full' );
			$thumb    = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
			$content .= '<a data-fancybox="gallery" class="miniatura-galeria" ';
			$content .= 'href="' . esc_url( $img[0] ) . '">';
			$content .= '<img src="' . esc_url( $thumb[0] ) . '"></a>';
		}
		$content .= '</div>';
	}

	return $content;
}

add_action( 'wp_enqueue_scripts', 'kfp_galeria_scripts' );
/**
 * Agrega plugin de jquery para visualizar la galeria con lightbox.
 *
 * @return void
 */
function kfp_galeria_scripts() {
	if ( is_singular( 'viaje' ) ) {
		wp_register_script(
			'kfp-galeria-lightbox',
			KFP_GALERIA_PLUGIN_URL . 'js/jquery.fancybox.min.js',
			array( 'jquery' ),
			KFP_GALERIA_VERSION,
			true
		);
		wp_enqueue_script( 'kfp-galeria-lightbox' );
		wp_register_style(
			'kfp-galeria-lightbox-css',
			KFP_GALERIA_PLUGIN_URL . 'css/jquery.fancybox.min.css',
			null,
			KFP_GALERIA_VERSION
		);
		wp_enqueue_style( 'kfp-galeria-lightbox-css' );
		wp_register_style(
			'kfp-galeria-frontend-css',
			KFP_GALERIA_PLUGIN_URL . 'css/frontend.css',
			null,
			KFP_GALERIA_VERSION
		);
		wp_enqueue_style( 'kfp-galeria-frontend-css' );
	}
}

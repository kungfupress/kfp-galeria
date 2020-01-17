<?php
/**
 * File: kfp-galeria/include/create-cpt-viaje.php
 *
 * @package kfp_galeria
 */

defined( 'ABSPATH' ) || die();

add_action( 'init', 'kfp_cpt_viaje', 10 );
/**
 * Crea un CPT Viaje con lo mínimo
 *
 * @return void
 */
function kfp_cpt_viaje() {
	$args = array(
		'public' => true,
		'label'  => 'Viajes',
	);
	register_post_type( 'viaje', $args );
}

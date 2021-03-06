<?php
/**
 * Plugin Name:   KFP Galeria
 * Description:   Crear un campo personalizado para mostrar una galeria
 * Plugin URI:    https://github.com/kungfupress/kfp-galeria
 * Version:       1.2.0
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
define( 'KFP_GALERIA_VERSION', '1.2.0' );

require_once KFP_GALERIA_DIR . 'include/create-cpt-viaje.php';
require_once KFP_GALERIA_DIR . 'include/create-metabox.php';
require_once KFP_GALERIA_DIR . 'include/save-custom-field.php';
require_once KFP_GALERIA_DIR . 'include/show-gallery-frontend.php';

<?php

//if (!defined('WPPT0PDFENH_PATH'))
//    define('WPPT0PDFENH_PATH', WP_PLUGIN_DIR . '/wp-post-to-pdf-enhanced');

// require_once(WPPT0PDFENH_PATH . '/tcpdf/config/lang/eng.php');
// to avoid duplicate function error
if ( ! class_exists( 'TCPDF' ) )
	require_once WPPT0PDFENH_PATH . '/tcpdf/tcpdf.php';


// Extend the TCPDF class to print the header only on the first page

class MYPDF extends TCPDF {

	public function header() {

		// call parent header method
		parent::header();
		// disable header
		$this->setPrintHeader( false );
	}
}

<?php

//development note: need to globalize the variables we're calling here, as otherwise, we can't see them from the main class.

//if (!defined('WPPT0PDFENH_PATH'))
//    define('WPPT0PDFENH_PATH', WP_PLUGIN_DIR . '/wp-post-to-pdf-enhanced');

// require_once(WPPT0PDFENH_PATH . '/tcpdf/config/lang/eng.php');
            // to avoid duplicate function error
if(!class_exists('TCPDF'))
    require_once(WPPT0PDFENH_PATH . '/tcpdf/tcpdf.php');

// if we have not set the option to include the header on all pages, define a constant
if ( !isset( $this->options['headerAllPages'] ) )
	define ('WPPT0PDFENH_HEADER_FIRST_PAGE_ONLY', 'Y');

// if we have enabled a custom footer, define those values as constants
if ( isset( $this->options['customFooter'] ) ){
	define ('WPPT0PDFENH_FOOTER_WIDTH', $this->options['footerWidth']);
	define ('WPPT0PDFENH_FOOTER_MIN_HEIGHT', $this->options['footerMinHeight']);
	define ('WPPT0PDFENH_FOOTER_X', $this->options['footerX']);
	define ('WPPT0PDFENH_FOOTER_Y', $this->options['footerY']);
	define ('WPPT0PDFENH_CUSTOM_FOOTER', $this->options['customFooterText']);
	define ('WPPT0PDFENH_FOOTER_BORDER', $this->options['footerBorder']);
	define ('WPPT0PDFENH_FOOTER_FILL', $this->options['footerFill']);
	define ('WPPT0PDFENH_FOOTER_ALIGN', $this->options['footerAlign']);
	define ('WPPT0PDFENH_FOOTER_PAD', $this->options['footerPad']);
	}

// Extend the TCPDF class to print the header only on the first page

class MYPDF extends TCPDF {

    public function Header() {

        if ( defined('WPPT0PDFENH_HEADER_FIRST_PAGE_ONLY') ){
			parent::Header();
            $this->setPrintHeader(false);
            }else{
            // call parent header method for header on all pages
            parent::Header();
            }
        }

    public function Footer() {
       
        if ( defined('WPPT0PDFENH_CUSTOM_FOOTER') ){
            $this->writeHTMLCell(WPPT0PDFENH_FOOTER_WIDTH, WPPT0PDFENH_FOOTER_MIN_HEIGHT, WPPT0PDFENH_FOOTER_X, WPPT0PDFENH_FOOTER_Y, WPPT0PDFENH_CUSTOM_FOOTER, WPPT0PDFENH_FOOTER_BORDER, 0, WPPT0PDFENH_FOOTER_FILL, true, WPPT0PDFENH_FOOTER_ALIGN, WPPT0PDFENH_FOOTER_PAD);
            }else{
			// call parent footer method for default footer
            parent::Footer();
			}
		}
	}
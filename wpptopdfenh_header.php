<?php

//development note: need to globalize the variables we're calling here, as otherwise, we can't see them from the main class.

//if (!defined('WPPT0PDFENH_PATH'))
//    define('WPPT0PDFENH_PATH', WP_PLUGIN_DIR . '/wp-post-to-pdf-enhanced');

// require_once(WPPT0PDFENH_PATH . '/tcpdf/config/lang/eng.php');
            // to avoid duplicate function error
if(!class_exists('TCPDF'))
    require_once(WPPT0PDFENH_PATH . '/tcpdf/tcpdf.php');


// Extend the TCPDF class to print the header only on the first page

class MYPDF extends TCPDF {

    public function Header() {

        // call parent header method
        parent::Header();

        // disable header on additional pages, if set
        if (!$this->options['headerAllPages']){
            $this->setPrintHeader(false);
            }
        }

    public function Footer() {

       
//        if (!$this->options['customFooter']){
            // call parent footer method for default footer
//            parent::Footer();
//            }else{
//	    $customFooterText = $this->options['customFooterText'];
	    $this->SetY(-10);
//	    $this->SetFont('helvetica', 'I', 10);
//	    $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

	    $htmlfooter = '<table style=" border-collapse: collapse; text-align: left; width: 100%;">
	    			<tbody>
	    				<tr>
	    					<td>
	    					199 Armour dr.<br>
	    					</td>
	    					<td>
	    					<br>
	    					</td>
	    				</tr>
	    				<tr>
	    					<td>
	    					Atlanta GA, 30324
	    					</td>
	    					<td style="text-align: right;">
	    					<a href="http://www.TSCustomFurniture.com">www.TSCustomFurniture.com</a><br>
	    					</td>
	    				</tr>
	    				<tr>
	    					<td>
	    					p: 404.810.9081 - fax:404.810.9084
	    					</td>
	    					<td style="text-align: right;">
	    					<a href="mailto:sales@TSCustomFurniture.com">sales@TSCustomFurniture.com</a><br>
	    					</td>
	    				</tr>
	    			</tbody>
	    		</table>';
//	    $htmlfooter .= '<br>Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages();
            $this->writeHTMLCell(0, 0, 10, 260, $htmlfooter, 0, 0, 0, true, 'C', true);
//	    }
	 }
     }


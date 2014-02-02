<?php

        //Add possible shortcodes here

        /* [wpptopdfenh]
         * This one adds a simple PDF icon, ignorant of any other include/exclude settings
         */
        function wpptopdfenh_shortcode_func( $atts )
        {
            return wpptopdfenh_display_shortcode_icon();
        }

        add_shortcode( 'wpptopdfenh', 'wpptopdfenh_shortcode_func' );

        /* [wpptopdfenh_break]
         * This one adds a page break to the PDF. We already ignore the built-in pagination function
         */
        function wpptopdfenh_break_shortcode_func( $atts )
        {
	    return wpptopdfenh_do_shortcode_break();
	}

	add_shortcode( 'wpptopdfenh_break', 'wpptopdfenh_break_shortcode_func' );
	
	function wpptopdfenh_do_shortcode_break()
	{
	    $content = '<tcpdf method="AddPage"></tcpdf>';
	    return $content;
	}
	
?>
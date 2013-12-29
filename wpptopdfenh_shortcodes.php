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

?>
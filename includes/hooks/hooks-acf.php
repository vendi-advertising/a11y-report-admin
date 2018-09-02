<?php

add_filter(
            'acf/settings/save_json',
            function( $paths ) {
                return VENDI_A11Y_PLUGIN_DIR . '/.acf-json';
            }

        );

add_filter(
            'acf/settings/load_json',
            function( $paths ) {
                return [ VENDI_A11Y_PLUGIN_DIR . '/.acf-json' ];
            }
        );

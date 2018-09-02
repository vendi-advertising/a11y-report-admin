<?php

add_filter(
                'wp_mail_from',
                function($from_email)
                {
                    return 'website@a11y.helix.vendiadvertising.com.com';
                }
            );

add_filter(
                'wp_mail_from_name',
                function($from_name)
                {
                    return 'Vendi a11y Server';
                }
            );

add_filter( 'show_admin_bar', '__return_false' );

add_action(
            'admin_menu',
            function()
            {
                remove_menu_page( 'edit.php' );                   //Posts
                remove_menu_page( 'edit.php?post_type=page' );    //Pages
                remove_menu_page( 'edit-comments.php' );          //Comments
            }
        );

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

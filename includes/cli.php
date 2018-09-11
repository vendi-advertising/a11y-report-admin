<?php

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ){
    return;
}

\WP_CLI::add_command( 'vendi a11y purge', '\Vendi\A11Y\CLI\Purge' );

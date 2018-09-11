<?php

declare(strict_types=1);

namespace Vendi\A11Y\CLI;

class Purge
{
    /**
     * Purge all objects from the system
     *
     * ## OPTIONS
     *
     * <type>
     * : The type to show
     * ---
     * options:
     *   - url
     *   - site-audit
     *   - everything
     * ---
     *
     * ## EXAMPLES
     *
     *     wp vendi a11y purge url
     */
    public function __invoke(array $args)
    {
        $type = array_shift($args);
        $types = [];

        switch($type){
            case 'url';
            case 'site-audit':
                $types = [$type];
                break;

            case 'everything':
                $types = ['url', 'site-audit'];
                break;

            default:
                \WP_CLI::error('Invalid type supplied to purge');
                exit;
        }

        global $wpdb;

        foreach($types as $type){
            $count = 0;
            $post_count = $wpdb->delete($wpdb->posts, [ 'post_type' =>  $type ]);
            $wpdb->query("DELETE FROM $wpdb->postmeta WHERE post_id NOT IN (SELECT id FROM $wpdb->posts);");
            $wpdb->query("DELETE FROM $wpdb->term_relationships WHERE object_id NOT IN (SELECT id FROM $wpdb->posts);");
            \WP_CLI::success("Deleted $post_count $type along with corresponding meta data");
        }
    }
}

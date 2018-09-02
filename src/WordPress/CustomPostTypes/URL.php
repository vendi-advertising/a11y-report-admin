<?php

declare(strict_types=1);

namespace Vendi\A11Y\WordPress\CustomPostTypes;

use Vendi\A11Y\Exceptions\A11YException;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

final class URL extends CPTBase
{
    public function __construct()
    {
        parent::__construct('url');
        $this->set_title_case_singular_name('URL');
        $this->set_title_case_plural_name('URLs');
    }

    public function get_register_args() : array
    {
        return [
                'can_export'            => true,
                'capability_type'       => 'page',
                'description'           => 'URL',
                'exclude_from_search'   => true,
                'has_archive'           => false,
                'hierarchical'          => false,
                'label'                 => 'URL',
                'labels'                => $this->_make_labels(),
                'menu_position'         => 5,
                'public'                => false,
                'publicly_queryable'    => false,
                'query_var'             => false,
                'rewrite'               => false,
                'show_in_admin_bar'     => true,
                'show_in_menu'          => true,
                'show_in_nav_menus'     => false,
                'show_in_rest'          => false,
                'show_ui'               => true,
                'supports'              => false,
        ];
    }

    public static function create_new(int $site_audit_id, string $url)
    {
        $obj = new self();

        $args = [
            'post_status' => 'publish',
            'post_type' => $obj->get_type_name(),
        ];

        $acf_keys = [
            'url'           => 'field_5b8bfc14b6a07',
            'audit_state'   => 'field_5b8bfca181f48',
            'crawl_state'   => 'field_5b8bfd0a81f49',
            'site_audit'    => 'field_5b8bfc51b6a08',
        ];

        $post_id = \wp_insert_post($args);

        \update_field($acf_keys['url'],         $url,           $post_id);
        \update_field($acf_keys['site_audit'],  $site_audit_id, $post_id);
        \update_field($acf_keys['audit_state'], 'none',         $post_id);
        \update_field($acf_keys['crawl_state'], 'none',         $post_id);

        self::submit_to_queue($post_id);

        return $post_id;
    }

    public static function get_single_by_id(int $id)
    {
        $obj = new self();

        $args = [
            'post_type'        => $obj->get_type_name(),
            'p'                => $id,
            'post_status'      => 'publish',
        ];

        $posts = \get_posts($args);
        if(!$posts){
            throw new A11YException(sprintf('URL by ID %1$s not found', $id));
        }

        if(1 !== count($posts)){
            throw new A11YException(sprintf('URL by ID %1$s count not one', $id));
        }

        return reset($posts);
    }

    public static function submit_to_queue(int $url_id)
    {
        $url_obj = self::get_single_by_id($url_id);

        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('crawl2', false, true, false, false);
        $url = get_field('url', $url_obj);
        $msg = new AMQPMessage($url);
        $channel->basic_publish($msg, '', $url);
        $channel->close();
        $connection->close();
    }
}

<?php

declare(strict_types=1);

namespace Vendi\A11Y\WordPress\CustomPostTypes;

final class SiteAudit extends CPTBase
{
    public function __construct()
    {
        parent::__construct('site-audit');
        $this->set_title_case_singular_name('Site Audit');
        $this->set_title_case_plural_name('Site Audits');
    }

    public function get_register_args() : array
    {
        return [
                'can_export'            => true,
                'capability_type'       => 'page',
                'description'           => 'Site Audits',
                'exclude_from_search'   => true,
                'has_archive'           => false,
                'hierarchical'          => false,
                'label'                 => 'Site Audits',
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
                'supports'              => [ 'title', 'revisions' ],
        ];
    }

    public static function get_all()
    {
        $obj = new self();

        $args = [
            'posts_per_page'   => -1,
            'orderby'          => 'post_title',
            'order'            => 'DESC',
            'post_type'        => $obj->get_type_name(),
            'post_status'      => 'publish',
        ];
        $posts = \get_posts($args);
        return $posts;
    }

    public static function create_new(string $title, array $domains)
    {
        $obj = new self();

        $args = [
            'post_title' => $title,
            'post_status' => 'publish',
            'post_type' => $obj->get_type_name(),
        ];

        $acf_keys = [
            'domains' => 'field_5b8bfad926e0f',
            'domain'  => 'field_5b8bfb1a26e10',
        ];

        $post_id = \wp_insert_post($args);
        $meta = [];
        foreach($domains as $domain){
            $meta[] = [
                $acf_keys['domain'] => $domain,
            ];
        }

        \update_field($acf_keys['domains'], $meta, $post_id);

        return $post_id;
    }
}

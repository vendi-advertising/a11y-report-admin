<?php

declare(strict_types=1);

namespace Vendi\A11Y\WordPress\CustomPostTypes;

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
}

<?php

use Vendi\Shared\template_router;
use Vendi\A11Y\WordPress\CustomPostTypes\SiteAudit;

template_router::get_instance()->get_header();
?>

<main>
    <h1>Site Audits</h1>
    <?php
    $all_site_audits = SiteAudit::get_all();
    if(count($all_site_audits) > 0){
        echo '<h2>Select a Site Audit to view</h2>';
        echo '<nav>';
        echo '<ul>';
        foreach($all_site_audits as $single_site_audit){
            echo sprintf(
                            '<li><a href="%2$s">%1$s</a></li>',
                            esc_html($single_site_audit->post_title),
                            template_router::get_instance()
                                ->create_url(
                                    'view-site-audit',
                                    [
                                        'id' => $single_site_audit->ID,
                                    ]
                                )
                        );
        }
        echo '</ul>';
        echo '</nav>';
    }else{
        echo '<p>No Site Audits found</p>';
    }

    echo sprintf(
                    '<a href="%1$s">Create a new Site Audit</a>',
                    template_router::get_instance()
                        ->create_url(
                            'new-site-audit'
                        )
                );

    ?>
</main>

<?php
template_router::get_instance()->get_footer();

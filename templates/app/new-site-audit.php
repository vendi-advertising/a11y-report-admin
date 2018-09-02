<?php

use Vendi\Shared\template_router;
use Vendi\Shared\utils;
use Vendi\A11Y\WordPress\CustomPostTypes\SiteAudit;
use Vendi\A11Y\WordPress\CustomPostTypes\URL;

$post_vars = [
    'audit-name' => '',
    'domains' => '',
    'start-url' => '',
];
if(utils::is_post()){
    foreach($post_vars as $k => $v){
        $post_vars[$k] = utils::get_post_value($k);
    }

    $site_audit_id = SiteAudit::create_new(
                                            $post_vars['audit-name'],
                                            explode("\n", $post_vars['domains'])
                                        );
    $first_url_id = URL::create_new(
                                    $site_audit_id,
                                    $post_vars['start-url']
                                );
}

template_router::get_instance()->get_header();
?>

<style>
    h1
    {
        text-align: center;
    }

    form ul
    {
        display: grid;
        grid-row-gap: 1rem;
        grid-template-columns: 1fr;
        margin: 0 auto;
        max-width: 60rem;
    }

    form li
    {
        display: grid;
        grid-column-gap: 2rem;
        grid-row-gap: 2rem;
        grid-template-columns: 1fr 1fr;
    }

    form label
    {
        text-align: right;
    }
</style>

<main>
    <h1>New Site Audit</h1>
    <?php
    if(utils::is_post()){
        echo '<strong>Success</strong>';
    }
    ?>
    <form method="post">
        <ul>
            <li>
                <label for="audit-name">Audit Name</label>
                <input type="text" required name="audit-name" id="audit-name" value="<?php echo esc_attr($post_vars['audit-name']); ?>" />
            </li>
            <li>
                <label for="domains">Domains (one per line)</label>
                <textarea required name="domains" id="domains"><?php echo esc_html($post_vars['domains']); ?></textarea>
            </li>
            <li>
                <label for="start-url">Start URL</label>
                <input type="text" required name="start-url" id="start-url" value="<?php echo esc_attr($post_vars['start-url']); ?>" />
            </li>
            <li>
                <span></span>
                <span><input type="submit" value="Add new Site Audit" /></span>
            </li>
        </ul>
    </form>
</main>

<?php
template_router::get_instance()->get_footer();

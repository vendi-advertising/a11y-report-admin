<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Vendi Accessibility Audit Admin</title>
<?php

wp_head();
?>
<style>
html
{
    font-size: 62.5%;
}

body
{
    font-size: 1.6rem;
    margin: 0;
    padding: 0;
}

header nav ul
{
    list-style-type: none;
    margin: 0;
    padding: 0;
}

header nav ul li
{
    background-color: #eeeeee;
    display: inline-block;
}

header nav ul li a
{
    color: #000;
    display: block;
    padding: 1rem 2rem;
    text-align: center;
    text-decoration: none;
}

header nav ul li a:hover
{
    text-decoration: underline;
}
</style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="<?php echo Vendi\Shared\template_router::get_instance()->create_url('site-audits'); ?>">View Site Audits</a></li>
        </ul>
    </nav>
</header>

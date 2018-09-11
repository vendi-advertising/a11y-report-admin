<?php

use Vendi\Shared\template_router;

$path = VENDI_A11Y_PLUGIN_DIR;

template_router::register_default_context( 'HSBOPT',       'app',   $path, 'home', 'page', 'templates/app'   );
template_router::register_context(         'HSBOPT-API',   'api',   $path,         'page', 'templates/api'   );
// template_router::register_context(         'HSBOPT-PRINT', 'print', $path,         'page', 'templates/print' );
// template_router::register_context(         'HSBOPT-PDF',   'pdf',   $path,         'page', 'templates/pdf'   );
// template_router::register_context(         'HSBOPT-DEBUG', 'debug', $path,         'page', 'templates/debug' );
// template_router::register_context(         'HSBOPT-FONTS', 'fonts', $path,         'page', 'templates/fonts' );

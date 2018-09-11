<?php

$response = Vendi\A11Y\API\URL::handle();
\http_response_code($response->get_response_code());
\header('Content-Type: application/json');
echo \json_encode($response);
exit;

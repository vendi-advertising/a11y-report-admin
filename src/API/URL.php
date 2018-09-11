<?php

declare(strict_types=1);

namespace Vendi\A11Y\API;

use Vendi\A11Y\AbstractClassWithoutMagicGetSet;
use Vendi\A11Y\WordPress\CustomPostTypes\URL as CPTURL;
use Vendi\Shared\utils;

final class URL
{

    /*
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');
     */
    public static function handle() : GeneralAPIResponse
    {
        switch(utils::get_server_value( 'REQUEST_METHOD' )){
            case 'POST':
                return self::handle_post();

            case 'GET':
                return self::handle_get();
        }

        return GeneralAPIResponse::create_api_route_not_implemented('URL::handle');
    }

    public static function handle_get() : GeneralAPIResponse
    {
        $crawler_id = utils::get_get_value('crawler_id');
        $url_data = CPTURL::get_next_for_crawler(1);
        if(!$url_data){
            return GeneralAPIResponse::create_no_work();
        }
        return GeneralAPIResponse::create_success('Next URL for processing', $url_data);
    }

    public static function handle_post() : GeneralAPIResponse
    {
        $crawler_id = utils::get_get_value('crawler_id');
        $url_id = utils::get_get_value('url_id');



        return GeneralAPIResponse::create_api_route_not_implemented('URL::handle_post');
        // if(!utils::is_get()){
        //     return GeneralAPIResponse::create_invalid_http_method_expected_get();
        // }

        // $crawler_id = utils::get_get_value('crawler_id');
    }
}

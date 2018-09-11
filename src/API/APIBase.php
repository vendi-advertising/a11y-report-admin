<?php

declare(strict_types=1);

namespace Vendi\A11Y\API;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Vendi\A11Y\AbstractClassWithoutMagicGetSet;
use Vendi\A11Y\WordPress\CustomPostTypes\URL as CPTURL;
use Vendi\Shared\utils;

abstract class APIBase
{
    private $_logger;

    public function get_logger()
    {
        if(!$this->_logger){
            $this->_logger = new Logger('api');
            $this->_logger->pushHandler(new StreamHandler(VENDI_A11Y_PLUGIN_DIR . '/.logs/api_debug.log', Logger::DEBUG));
            $this->_logger->pushHandler(new StreamHandler(VENDI_A11Y_PLUGIN_DIR . '/.logs/api.log',       Logger::WARNING));
        }

        return $this->_logger;
    }

    final public function handle() : GeneralAPIResponse
    {
        $logger = $this->get_logger();

        $logger->debug('Loading API router');

        $obj = new static();
        $logger->debug('Using API object', $obj);

        switch(utils::get_server_value( 'REQUEST_METHOD' )){
            case 'POST':
                return self::handle_post();

            case 'GET':
                return self::handle_get();
        }

        return GeneralAPIResponse::create_api_route_not_implemented('URL::handle');
    }

    public function handle_get() : GeneralAPIResponse
    {
        return GeneralAPIResponse::create_api_route_not_implemented( \get_class() . '::handle_get');
    }

    public function handle_post() : GeneralAPIResponse
    {
        return GeneralAPIResponse::create_api_route_not_implemented( \get_class() . '::handle_post');
    }

    public function handle_head() : GeneralAPIResponse
    {
        return GeneralAPIResponse::create_api_route_not_implemented( \get_class() . '::handle_head');
    }

    public function handle_delete() : GeneralAPIResponse
    {
        return GeneralAPIResponse::create_api_route_not_implemented( \get_class() . '::handle_delete');
    }

    public function handle_put() : GeneralAPIResponse
    {
        return GeneralAPIResponse::create_api_route_not_implemented( \get_class() . '::handle_put');
    }

    public function handle_patch() : GeneralAPIResponse
    {
        return GeneralAPIResponse::create_api_route_not_implemented( \get_class() . '::handle_patch');
    }
}

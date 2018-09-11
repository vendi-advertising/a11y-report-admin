<?php

declare(strict_types=1);

namespace Vendi\A11Y\API;

use Lukasoppermann\Httpstatus\Httpstatuscodes;
use Vendi\A11Y\AbstractClassWithoutMagicGetSet;

class GeneralAPIResponse extends AbstractClassWithoutMagicGetSet implements \JsonSerializable
{
    private $_response_type;

    private $_response_code;

    private $_message;

    private $_data = [];

    public const RESPONSE_TYPE_ERROR = 'error';
    public const RESPONSE_TYPE_SUCCESS = 'success';

    protected function __construct(string $response_type, int $response_code, string $message = null, array $data = [])
    {
        $this->_response_type = $response_type;
        $this->_response_code = $response_code;
        $this->_message = $message;
        $this->_data = $data;
    }

    public function get_response_type() : string
    {
        return $this->_response_type;
    }

    public function get_response_code() : int
    {
        return $this->_response_code;
    }

    public function get_message() : ?string
    {
        return $this->_message;
    }

    public function get_data() : array
    {
        return $this->_data;
    }

    public function is_error() : bool
    {
        return $this->get_response_type() === self::RESPONSE_TYPE_ERROR;
    }

    public static function create_invalid_http_method_expected_get(array $data = [])
    {
        return self::create_invalid_http_method('GET', $data);
    }

    public static function create_invalid_http_method(string $expected, array $data = [])
    {
        return self::create_error('Invalid HTTP method, expected ' . $expected, Httpstatuscodes::HTTP_METHOD_NOT_ALLOWED, $data);
    }

    public static function create_api_route_not_implemented(string $name, array $data = [])
    {
        return self::create_error('The request API method has not been implemented yet: ' . $name, Httpstatuscodes::HTTP_NOT_IMPLEMENTED, $data);
    }

    public static function create_error(string $message, int $response_code, array $data = [])
    {
        return new static(self::RESPONSE_TYPE_ERROR, $response_code, $message, $data);
    }

    public static function create_success(string $message = null, array $data = [])
    {
        return new static(self::RESPONSE_TYPE_SUCCESS, Httpstatuscodes::HTTP_OK, $message, $data);
    }

    public static function create_no_work()
    {
        return new static(self::RESPONSE_TYPE_SUCCESS, Httpstatuscodes::HTTP_NO_CONTENT, 'No work to do');
    }

    public function jsonSerialize()
    {
        return [
                    'is_error' => $this->is_error(),
                    'response_type' => $this->get_response_type(),
                    'response_code' => $this->get_response_code(),
                    'message' => wp_kses($this->get_message(), []),
                    'data' => $this->get_data(),
        ];
    }
}

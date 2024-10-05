<?php

namespace PPP\Stripe\Terminal;

/**
 * Class ConnectionToken
 *
 * @property string $secret
 *
 * @package Stripe\Terminal
 */
class ConnectionToken extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "terminal.connection_token";

    use \PPP\Stripe\ApiOperations\Create;
}

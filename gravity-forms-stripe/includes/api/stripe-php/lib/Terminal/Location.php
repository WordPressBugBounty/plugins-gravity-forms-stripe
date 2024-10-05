<?php

namespace PPP\Stripe\Terminal;

/**
 * Class Location
 *
 * @property string $id
 * @property string $object
 * @property mixed $address
 * @property bool $deleted
 * @property string $display_name
 *
 * @package Stripe\Terminal
 */
class Location extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "terminal.location";

    use \PPP\Stripe\ApiOperations\All;
    use \PPP\Stripe\ApiOperations\Create;
    use \PPP\Stripe\ApiOperations\Delete;
    use \PPP\Stripe\ApiOperations\Retrieve;
    use \PPP\Stripe\ApiOperations\Update;
}

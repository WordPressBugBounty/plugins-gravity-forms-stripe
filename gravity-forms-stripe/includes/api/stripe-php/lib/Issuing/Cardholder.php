<?php

namespace PPP\Stripe\Issuing;

/**
 * Class Cardholder
 *
 * @property string $id
 * @property string $object
 * @property mixed $billing
 * @property int $created
 * @property string $email
 * @property bool $livemode
 * @property \PPP\Stripe\StripeObject $metadata
 * @property string $name
 * @property string $phone_number
 * @property string $status
 * @property string $type
 *
 * @package Stripe\Issuing
 */
class Cardholder extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "issuing.cardholder";

    use \PPP\Stripe\ApiOperations\All;
    use \PPP\Stripe\ApiOperations\Create;
    use \PPP\Stripe\ApiOperations\Retrieve;
    use \PPP\Stripe\ApiOperations\Update;
}

<?php

namespace PPP\Stripe\Issuing;

/**
 * Class Dispute
 *
 * @property string $id
 * @property string $object
 * @property int $amount
 * @property int $created
 * @property string $currency
 * @property mixed $evidence
 * @property bool $livemode
 * @property \PPP\Stripe\StripeObject $metadata
 * @property string $reason
 * @property string $status
 * @property Transaction $transaction
 *
 * @package Stripe\Issuing
 */
class Dispute extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "issuing.dispute";

    use \PPP\Stripe\ApiOperations\All;
    use \PPP\Stripe\ApiOperations\Create;
    use \PPP\Stripe\ApiOperations\Retrieve;
    use \PPP\Stripe\ApiOperations\Update;
}

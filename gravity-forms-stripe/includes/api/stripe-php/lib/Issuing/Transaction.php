<?php

namespace PPP\Stripe\Issuing;

/**
 * Class Transaction
 *
 * @property string $id
 * @property string $object
 * @property int $amount
 * @property string $authorization
 * @property string $balance_transaction
 * @property string $card
 * @property string $cardholder
 * @property int $created
 * @property string $currency
 * @property string $dispute
 * @property bool $livemode
 * @property mixed $merchant_data
 * @property int $merchant_amount
 * @property string $merchant_currency
 * @property \PPP\Stripe\StripeObject $metadata
 * @property string $type
 *
 * @package Stripe\Issuing
 */
class Transaction extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "issuing.transaction";

    use \PPP\Stripe\ApiOperations\All;
    use \PPP\Stripe\ApiOperations\Create;
    use \PPP\Stripe\ApiOperations\Retrieve;
    use \PPP\Stripe\ApiOperations\Update;
}

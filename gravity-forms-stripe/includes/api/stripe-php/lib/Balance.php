<?php

namespace PPP\Stripe;

/**
 * Class Balance
 *
 * @property string $object
 * @property array $available
 * @property array $connect_reserved
 * @property bool $livemode
 * @property array $pending
 *
 * @package Stripe
 */
class Balance extends SingletonApiResource
{
    const OBJECT_NAME = "balance";

    /**
     * @param array|string|null $opts
     *
     * @throws \PPP\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Balance
     */
    public static function retrieve($opts = null)
    {
        return self::_singletonRetrieve($opts);
    }
}

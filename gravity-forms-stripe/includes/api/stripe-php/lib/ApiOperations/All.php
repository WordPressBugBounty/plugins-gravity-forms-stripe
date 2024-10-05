<?php

namespace PPP\Stripe\ApiOperations;

/**
 * Trait for listable resources. Adds a `all()` static method to the class.
 *
 * This trait should only be applied to classes that derive from StripeObject.
 */
trait All
{
    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \PPP\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \PPP\Stripe\Collection of ApiResources
     */
    public static function all($params = null, $opts = null)
    {
        self::_validateParams($params);
        $url = static::classUrl();

        list($response, $opts) = static::_staticRequest('get', $url, $params, $opts);
        $obj = \PPP\Stripe\Util\Util::convertToStripeObject($response->json, $opts);
        if (!($obj instanceof \PPP\Stripe\Collection)) {
            throw new \PPP\Stripe\Exception\UnexpectedValueException(
                'Expected type ' . \PPP\Stripe\Collection::class . ', got "' . get_class($obj) . '" instead.'
            );
        }
        $obj->setLastResponse($response);
        $obj->setFilters($params);
        return $obj;
    }
}

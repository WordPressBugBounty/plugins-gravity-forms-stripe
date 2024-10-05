<?php

namespace PPP\Stripe\Exception\OAuth;

/**
 * Implements properties and methods common to all (non-SPL) Stripe OAuth
 * exceptions.
 */
abstract class OAuthErrorException extends \PPP\Stripe\Exception\ApiErrorException
{
    protected function constructErrorObject()
    {
        if (is_null($this->jsonBody)) {
            return null;
        }

        return \PPP\Stripe\OAuthErrorObject::constructFrom($this->jsonBody);
    }
}

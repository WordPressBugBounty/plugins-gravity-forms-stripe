<?php

namespace PPP\Stripe\Util;

use PPP\Stripe\StripeObject;

abstract class Util
{
    private static $isMbstringAvailable = null;
    private static $isHashEqualsAvailable = null;

    /**
     * Whether the provided array (or other) is a list rather than a dictionary.
     * A list is defined as an array for which all the keys are consecutive
     * integers starting at 0. Empty arrays are considered to be lists.
     *
     * @param array|mixed $array
     * @return boolean true if the given object is a list.
     */
    public static function isList($array)
    {
        if (!is_array($array)) {
            return false;
        }
        if ($array === []) {
            return true;
        }
        if (array_keys($array) !== range(0, count($array) - 1)) {
                return false;
            }
        return true;
    }

    /**
     * Converts a response from the Stripe API to the corresponding PHP object.
     *
     * @param array $resp The response from the Stripe API.
     * @param array $opts
     * @return StripeObject|array
     */
    public static function convertToStripeObject($resp, $opts)
    {
        $types = [
            // data structures
            \PPP\Stripe\Collection::OBJECT_NAME => \PPP\Stripe\Collection::class,

            // business objects
            \PPP\Stripe\Account::OBJECT_NAME => \PPP\Stripe\Account::class,
            \PPP\Stripe\AccountLink::OBJECT_NAME => \PPP\Stripe\AccountLink::class,
            \PPP\Stripe\ApplePayDomain::OBJECT_NAME => \PPP\Stripe\ApplePayDomain::class,
            \PPP\Stripe\ApplicationFee::OBJECT_NAME => \PPP\Stripe\ApplicationFee::class,
            \PPP\Stripe\ApplicationFeeRefund::OBJECT_NAME => \PPP\Stripe\ApplicationFeeRefund::class,
            \PPP\Stripe\Balance::OBJECT_NAME => \PPP\Stripe\Balance::class,
            \PPP\Stripe\BalanceTransaction::OBJECT_NAME => \PPP\Stripe\BalanceTransaction::class,
            \PPP\Stripe\BankAccount::OBJECT_NAME => \PPP\Stripe\BankAccount::class,
            \PPP\Stripe\Capability::OBJECT_NAME => \PPP\Stripe\Capability::class,
            \PPP\Stripe\Card::OBJECT_NAME => \PPP\Stripe\Card::class,
            \PPP\Stripe\Charge::OBJECT_NAME => \PPP\Stripe\Charge::class,
            \PPP\Stripe\Checkout\Session::OBJECT_NAME => \PPP\Stripe\Checkout\Session::class,
            \PPP\Stripe\CountrySpec::OBJECT_NAME => \PPP\Stripe\CountrySpec::class,
            \PPP\Stripe\Coupon::OBJECT_NAME => \PPP\Stripe\Coupon::class,
            \PPP\Stripe\CreditNote::OBJECT_NAME => \PPP\Stripe\CreditNote::class,
            \PPP\Stripe\Customer::OBJECT_NAME => \PPP\Stripe\Customer::class,
            \PPP\Stripe\CustomerBalanceTransaction::OBJECT_NAME => \PPP\Stripe\CustomerBalanceTransaction::class,
            \PPP\Stripe\Discount::OBJECT_NAME => \PPP\Stripe\Discount::class,
            \PPP\Stripe\Dispute::OBJECT_NAME => \PPP\Stripe\Dispute::class,
            \PPP\Stripe\EphemeralKey::OBJECT_NAME => \PPP\Stripe\EphemeralKey::class,
            \PPP\Stripe\Event::OBJECT_NAME => \PPP\Stripe\Event::class,
            \PPP\Stripe\ExchangeRate::OBJECT_NAME => \PPP\Stripe\ExchangeRate::class,
            \PPP\Stripe\File::OBJECT_NAME => \PPP\Stripe\File::class,
            \PPP\Stripe\File::OBJECT_NAME_ALT => \PPP\Stripe\File::class,
            \PPP\Stripe\FileLink::OBJECT_NAME => \PPP\Stripe\FileLink::class,
            \PPP\Stripe\Invoice::OBJECT_NAME => \PPP\Stripe\Invoice::class,
            \PPP\Stripe\InvoiceItem::OBJECT_NAME => \PPP\Stripe\InvoiceItem::class,
            \PPP\Stripe\InvoiceLineItem::OBJECT_NAME => \PPP\Stripe\InvoiceLineItem::class,
            \PPP\Stripe\Issuing\Authorization::OBJECT_NAME => \PPP\Stripe\Issuing\Authorization::class,
            \PPP\Stripe\Issuing\Card::OBJECT_NAME => \PPP\Stripe\Issuing\Card::class,
            \PPP\Stripe\Issuing\CardDetails::OBJECT_NAME => \PPP\Stripe\Issuing\CardDetails::class,
            \PPP\Stripe\Issuing\Cardholder::OBJECT_NAME => \PPP\Stripe\Issuing\Cardholder::class,
            \PPP\Stripe\Issuing\Dispute::OBJECT_NAME => \PPP\Stripe\Issuing\Dispute::class,
            \PPP\Stripe\Issuing\Transaction::OBJECT_NAME => \PPP\Stripe\Issuing\Transaction::class,
            \PPP\Stripe\LoginLink::OBJECT_NAME => \PPP\Stripe\LoginLink::class,
            \PPP\Stripe\Order::OBJECT_NAME => \PPP\Stripe\Order::class,
            \PPP\Stripe\OrderItem::OBJECT_NAME => \PPP\Stripe\OrderItem::class,
            \PPP\Stripe\OrderReturn::OBJECT_NAME => \PPP\Stripe\OrderReturn::class,
            \PPP\Stripe\PaymentIntent::OBJECT_NAME => \PPP\Stripe\PaymentIntent::class,
            \PPP\Stripe\PaymentMethod::OBJECT_NAME => \PPP\Stripe\PaymentMethod::class,
            \PPP\Stripe\Payout::OBJECT_NAME => \PPP\Stripe\Payout::class,
            \PPP\Stripe\Person::OBJECT_NAME => \PPP\Stripe\Person::class,
            \PPP\Stripe\Plan::OBJECT_NAME => \PPP\Stripe\Plan::class,
            \PPP\Stripe\Product::OBJECT_NAME => \PPP\Stripe\Product::class,
            \PPP\Stripe\Radar\EarlyFraudWarning::OBJECT_NAME => \PPP\Stripe\Radar\EarlyFraudWarning::class,
            \PPP\Stripe\Radar\ValueList::OBJECT_NAME => \PPP\Stripe\Radar\ValueList::class,
            \PPP\Stripe\Radar\ValueListItem::OBJECT_NAME => \PPP\Stripe\Radar\ValueListItem::class,
            \PPP\Stripe\Recipient::OBJECT_NAME => \PPP\Stripe\Recipient::class,
            \PPP\Stripe\RecipientTransfer::OBJECT_NAME => \PPP\Stripe\RecipientTransfer::class,
            \PPP\Stripe\Refund::OBJECT_NAME => \PPP\Stripe\Refund::class,
            \PPP\Stripe\Reporting\ReportRun::OBJECT_NAME => \PPP\Stripe\Reporting\ReportRun::class,
            \PPP\Stripe\Reporting\ReportType::OBJECT_NAME => \PPP\Stripe\Reporting\ReportType::class,
            \PPP\Stripe\Review::OBJECT_NAME => \PPP\Stripe\Review::class,
            \PPP\Stripe\SetupIntent::OBJECT_NAME => \PPP\Stripe\SetupIntent::class,
            \PPP\Stripe\Sigma\ScheduledQueryRun::OBJECT_NAME => \PPP\Stripe\Sigma\ScheduledQueryRun::class,
            \PPP\Stripe\SKU::OBJECT_NAME => \PPP\Stripe\SKU::class,
            \PPP\Stripe\Source::OBJECT_NAME => \PPP\Stripe\Source::class,
            \PPP\Stripe\SourceTransaction::OBJECT_NAME => \PPP\Stripe\SourceTransaction::class,
            \PPP\Stripe\Subscription::OBJECT_NAME => \PPP\Stripe\Subscription::class,
            \PPP\Stripe\SubscriptionItem::OBJECT_NAME => \PPP\Stripe\SubscriptionItem::class,
            \PPP\Stripe\SubscriptionSchedule::OBJECT_NAME => \PPP\Stripe\SubscriptionSchedule::class,
            \PPP\Stripe\TaxId::OBJECT_NAME => \PPP\Stripe\TaxId::class,
            \PPP\Stripe\TaxRate::OBJECT_NAME => \PPP\Stripe\TaxRate::class,
            \PPP\Stripe\ThreeDSecure::OBJECT_NAME => \PPP\Stripe\ThreeDSecure::class,
            \PPP\Stripe\Terminal\ConnectionToken::OBJECT_NAME => \PPP\Stripe\Terminal\ConnectionToken::class,
            \PPP\Stripe\Terminal\Location::OBJECT_NAME => \PPP\Stripe\Terminal\Location::class,
            \PPP\Stripe\Terminal\Reader::OBJECT_NAME => \PPP\Stripe\Terminal\Reader::class,
            \PPP\Stripe\Token::OBJECT_NAME => \PPP\Stripe\Token::class,
            \PPP\Stripe\Topup::OBJECT_NAME => \PPP\Stripe\Topup::class,
            \PPP\Stripe\Transfer::OBJECT_NAME => \PPP\Stripe\Transfer::class,
            \PPP\Stripe\TransferReversal::OBJECT_NAME => \PPP\Stripe\TransferReversal::class,
            \PPP\Stripe\UsageRecord::OBJECT_NAME => \PPP\Stripe\UsageRecord::class,
            \PPP\Stripe\UsageRecordSummary::OBJECT_NAME => \PPP\Stripe\UsageRecordSummary::class,
            \PPP\Stripe\WebhookEndpoint::OBJECT_NAME => \PPP\Stripe\WebhookEndpoint::class,
        ];
        if (self::isList($resp)) {
            $mapped = [];
            foreach ($resp as $i) {
                array_push($mapped, self::convertToStripeObject($i, $opts));
            }
            return $mapped;
        } elseif (is_array($resp)) {
            if (isset($resp['object']) && is_string($resp['object']) && isset($types[$resp['object']])) {
                $class = $types[$resp['object']];
            } else {
                $class = \PPP\Stripe\StripeObject::class;
            }
            return $class::constructFrom($resp, $opts);
        } else {
            return $resp;
        }
    }

    /**
     * @param string|mixed $value A string to UTF8-encode.
     *
     * @return string|mixed The UTF8-encoded string, or the object passed in if
     *    it wasn't a string.
     */
    public static function utf8($value)
    {
        if (self::$isMbstringAvailable === null) {
            self::$isMbstringAvailable = function_exists('mb_detect_encoding');

            if (!self::$isMbstringAvailable) {
                trigger_error("It looks like the mbstring extension is not enabled. " .
                    "UTF-8 strings will not properly be encoded. Ask your system " .
                    "administrator to enable the mbstring extension, or write to " .
                    "support@stripe.com if you have any questions.", E_USER_WARNING);
            }
        }

        if (is_string($value) && self::$isMbstringAvailable && mb_detect_encoding($value, "UTF-8", true) != "UTF-8") {
            return utf8_encode($value);
        } else {
            return $value;
        }
    }

    /**
     * Compares two strings for equality. The time taken is independent of the
     * number of characters that match.
     *
     * @param string $a one of the strings to compare.
     * @param string $b the other string to compare.
     * @return bool true if the strings are equal, false otherwise.
     */
    public static function secureCompare($a, $b)
    {
        if (self::$isHashEqualsAvailable === null) {
            self::$isHashEqualsAvailable = function_exists('hash_equals');
        }

        if (self::$isHashEqualsAvailable) {
            return hash_equals($a, $b);
        } else {
            if (strlen($a) != strlen($b)) {
                return false;
            }

            $result = 0;
            for ($i = 0; $i < strlen($a); $i++) {
                $result |= ord($a[$i]) ^ ord($b[$i]);
            }
            return ($result == 0);
        }
    }

    /**
     * Recursively goes through an array of parameters. If a parameter is an instance of
     * ApiResource, then it is replaced by the resource's ID.
     * Also clears out null values.
     *
     * @param mixed $h
     * @return mixed
     */
    public static function objectsToIds($h)
    {
        if ($h instanceof \PPP\Stripe\ApiResource) {
            return $h->id;
        } elseif (static::isList($h)) {
            $results = [];
            foreach ($h as $v) {
                array_push($results, static::objectsToIds($v));
        }
            return $results;
        } elseif (is_array($h)) {
            $results = [];
            foreach ($h as $k => $v) {
            if (is_null($v)) {
                continue;
            }
                $results[$k] = static::objectsToIds($v);
            }
            return $results;
                } else {
            return $h;
        }
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public static function encodeParameters($params)
    {
        $flattenedParams = self::flattenParams($params);
        $pieces = [];
        foreach ($flattenedParams as $param) {
            list($k, $v) = $param;
            array_push($pieces, self::urlEncode($k) . '=' . self::urlEncode($v));
        }
        return implode('&', $pieces);
    }

    /**
     * @param array $params
     * @param string|null $parentKey
     *
     * @return array
     */
    public static function flattenParams($params, $parentKey = null)
    {
        $result = [];

        foreach ($params as $key => $value) {
            $calculatedKey = $parentKey ? "{$parentKey}[{$key}]" : $key;

            if (self::isList($value)) {
                $result = array_merge($result, self::flattenParamsList($value, $calculatedKey));
            } elseif (is_array($value)) {
                $result = array_merge($result, self::flattenParams($value, $calculatedKey));
            } else {
                array_push($result, [$calculatedKey, $value]);
            }
        }

        return $result;
    }

    /**
     * @param array $value
     * @param string $calculatedKey
     *
     * @return array
     */
    public static function flattenParamsList($value, $calculatedKey)
    {
        $result = [];

        foreach ($value as $i => $elem) {
            if (self::isList($elem)) {
                $result = array_merge($result, self::flattenParamsList($elem, $calculatedKey));
            } elseif (is_array($elem)) {
                $result = array_merge($result, self::flattenParams($elem, "{$calculatedKey}[{$i}]"));
            } else {
                array_push($result, ["{$calculatedKey}[{$i}]", $elem]);
                }
            }

        return $result;
                }

    /**
     * @param string $key A string to URL-encode.
     *
     * @return string The URL-encoded string.
     */
    public static function urlEncode($key)
    {
        $s = urlencode($key);

        // Don't use strict form encoding by changing the square bracket control
        // characters back to their literals. This is fine by the server, and
        // makes these parameter strings easier to read.
        $s = str_replace('%5B', '[', $s);
        $s = str_replace('%5D', ']', $s);

        return $s;
    }

    public static function normalizeId($id)
    {
        if (is_array($id)) {
            $params = $id;
            $id = $params['id'];
            unset($params['id']);
            } else {
            $params = [];
            }
        return [$id, $params];
        }

    /**
     * Returns UNIX timestamp in milliseconds
     *
     * @return integer current time in millis
     */
    public static function currentTimeMillis()
    {
        return (int) round(microtime(true) * 1000);
    }
}

<?php

namespace PPP\Stripe;

/**
 * Class Card
 *
 * @property string $id
 * @property string $object
 * @property string $account
 * @property string $address_city
 * @property string $address_country
 * @property string $address_line1
 * @property string $address_line1_check
 * @property string $address_line2
 * @property string $address_state
 * @property string $address_zip
 * @property string $address_zip_check
 * @property string[] $available_payout_methods
 * @property string $brand
 * @property string $country
 * @property string $currency
 * @property string $customer
 * @property string $cvc_check
 * @property bool $default_for_currency
 * @property string $dynamic_last4
 * @property int $exp_month
 * @property int $exp_year
 * @property string $fingerprint
 * @property string $funding
 * @property string $last4
 * @property StripeObject $metadata
 * @property string $name
 * @property string $recipient
 * @property string $tokenization_method
 *
 * @package Stripe
 */
class Card extends ApiResource
{
    const OBJECT_NAME = "card";

    use ApiOperations\Delete;
    use ApiOperations\Update;

    /**
     * Possible string representations of the CVC check status.
     * @link https://stripe.com/docs/api/cards/object#card_object-cvc_check
     */
    const CVC_CHECK_FAIL        = 'fail';
    const CVC_CHECK_PASS        = 'pass';
    const CVC_CHECK_UNAVAILABLE = 'unavailable';
    const CVC_CHECK_UNCHECKED   = 'unchecked';

    /**
     * Possible string representations of the funding of the card.
     * @link https://stripe.com/docs/api/cards/object#card_object-funding
     */
    const FUNDING_CREDIT  = 'credit';
    const FUNDING_DEBIT   = 'debit';
    const FUNDING_PREPAID = 'prepaid';
    const FUNDING_UNKNOWN = 'unknown';

    /**
     * Possible string representations of the tokenization method when using Apple Pay or Google Pay.
     * @link https://stripe.com/docs/api/cards/object#card_object-tokenization_method
     */
    const TOKENIZATION_METHOD_APPLE_PAY  = 'apple_pay';
    const TOKENIZATION_METHOD_GOOGLE_PAY = 'google_pay';

    /**
     * @return string The instance URL for this resource. It needs to be special
     *    cased because cards are nested resources that may belong to different
     *    top-level resources.
     */
    public function instanceUrl()
    {
        if ($this['customer']) {
            $base = Customer::classUrl();
            $parent = $this['customer'];
            $path = 'sources';
        } elseif ($this['account']) {
            $base = Account::classUrl();
            $parent = $this['account'];
            $path = 'external_accounts';
        } elseif ($this['recipient']) {
            $base = Recipient::classUrl();
            $parent = $this['recipient'];
            $path = 'cards';
        } else {
            $msg = "Cards cannot be accessed without a customer ID, account ID or recipient ID.";
            throw new Exception\UnexpectedValueException($msg);
        }
        $parentExtn = urlencode(Util\Util::utf8($parent));
        $extn = urlencode(Util\Util::utf8($this['id']));
        return "$base/$parentExtn/$path/$extn";
    }

    /**
     * @param array|string $_id
     * @param array|string|null $_opts
     *
     * @throws \PPP\Stripe\Exception\BadMethodCallException
     */
    public static function retrieve($_id, $_opts = null)
    {
        $msg = "Cards cannot be retrieved without a customer ID or an " .
               "account ID. Retrieve a card using " .
               "`Customer::retrieveSource('customer_id', 'card_id')` or " .
               "`Account::retrieveExternalAccount('account_id', 'card_id')`.";
        throw new Exception\BadMethodCallException($msg);
    }

    /**
     * @param string $_id
     * @param array|null $_params
     * @param array|string|null $_options
     *
     * @throws \PPP\Stripe\Exception\BadMethodCallException
     */
    public static function update($_id, $_params = null, $_options = null)
    {
        $msg = "Cards cannot be updated without a customer ID or an " .
               "account ID. Update a card using " .
               "`Customer::updateSource('customer_id', 'card_id', " .
               "\$updateParams)` or `Account::updateExternalAccount(" .
               "'account_id', 'card_id', \$updateParams)`.";
        throw new Exception\BadMethodCallException($msg);
    }
}

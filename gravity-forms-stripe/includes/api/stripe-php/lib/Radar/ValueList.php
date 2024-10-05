<?php

namespace PPP\Stripe\Radar;

/**
 * Class ValueList
 *
 * @property string $id
 * @property string $object
 * @property string $alias
 * @property int $created
 * @property string $created_by
 * @property string $item_type
 * @property Collection $list_items
 * @property bool $livemode
 * @property StripeObject $metadata
 * @property mixed $name
 * @property int $updated
 * @property string $updated_by
 *
 * @package Stripe\Radar
 */
class ValueList extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "radar.value_list";

    use \PPP\Stripe\ApiOperations\All;
    use \PPP\Stripe\ApiOperations\Create;
    use \PPP\Stripe\ApiOperations\Delete;
    use \PPP\Stripe\ApiOperations\Retrieve;
    use \PPP\Stripe\ApiOperations\Update;
}

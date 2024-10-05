<?php

namespace PPP\Stripe\Radar;

/**
 * Class ValueListItem
 *
 * @property string $id
 * @property string $object
 * @property int $created
 * @property string $created_by
 * @property string $list
 * @property bool $livemode
 * @property string $value
 *
 * @package Stripe\Radar
 */
class ValueListItem extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "radar.value_list_item";

    use \PPP\Stripe\ApiOperations\All;
    use \PPP\Stripe\ApiOperations\Create;
    use \PPP\Stripe\ApiOperations\Delete;
    use \PPP\Stripe\ApiOperations\Retrieve;
}

<?php

namespace PPP\Stripe\Sigma;

/**
 * Class Authorization
 *
 * @property string $id
 * @property string $object
 * @property int $created
 * @property int $data_load_time
 * @property string $error
 * @property \PPP\Stripe\File $file
 * @property bool $livemode
 * @property int $result_available_until
 * @property string $sql
 * @property string $status
 * @property string $title
 *
 * @package Stripe\Sigma
 */
class ScheduledQueryRun extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "scheduled_query_run";

    use \PPP\Stripe\ApiOperations\All;
    use \PPP\Stripe\ApiOperations\Retrieve;

    public static function classUrl()
    {
        return "/v1/sigma/scheduled_query_runs";
    }
}

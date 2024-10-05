<?php

namespace PPP\Stripe\Reporting;

/**
 * Class ReportRun
 *
 * @property string $id
 * @property string $object
 * @property int $created
 * @property string $error
 * @property bool $livemode
 * @property mixed $parameters
 * @property string $report_type
 * @property mixed $result
 * @property string $status
 * @property int $succeeded_at
 *
 * @package Stripe\Reporting
 */
class ReportRun extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "reporting.report_run";

    use \PPP\Stripe\ApiOperations\All;
    use \PPP\Stripe\ApiOperations\Create;
    use \PPP\Stripe\ApiOperations\Retrieve;
}

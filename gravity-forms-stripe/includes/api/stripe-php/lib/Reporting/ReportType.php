<?php

namespace PPP\Stripe\Reporting;

/**
 * Class ReportType
 *
 * @property string $id
 * @property string $object
 * @property int $data_available_end
 * @property int $data_available_start
 * @property string $name
 * @property int $updated
 * @property string $version
 *
 * @package Stripe\Reporting
 */
class ReportType extends \PPP\Stripe\ApiResource
{
    const OBJECT_NAME = "reporting.report_type";

    use \PPP\Stripe\ApiOperations\All;
    use \PPP\Stripe\ApiOperations\Retrieve;
}

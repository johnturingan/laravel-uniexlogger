<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 11/09/2017
 * Time: 7:04 PM
 */

namespace UniExLogger\Exceptions;

/**
 * Class TokenInvalidException
 * @package UniExLogger\Exceptions
 */
class MaintenanceException extends BaseException
{

    /**
     * Default StatusCode
     * @var int
     */
    protected $statusCode = 503;


    /**
     * Prefix that will be add to the message for easy indexing
     * @var string
     */
    protected $prefix = 'SiteOnMaintenance';

}
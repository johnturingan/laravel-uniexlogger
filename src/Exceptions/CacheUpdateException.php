<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 14/09/2017
 * Time: 11:34 AM
 */

namespace UniExLogger\Exceptions;


/**
 * Class CacheUpdateException
 * @package App\Exceptions
 */
class CacheUpdateException extends BaseException
{

    /**
     * Default StatusCode
     * @var int
     */
    protected $statusCode = 500;


    /**
     * Prefix that will be add to the message for easy indexing
     * @var string
     */
    protected $prefix = 'CacheUpdate';

}
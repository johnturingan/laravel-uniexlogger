<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 11/09/2017
 * Time: 7:04 PM
 */

namespace UniExLogger\Exceptions;

/**
 * Class TokenExpiredException
 * @package UniExLogger\Exceptions
 */
class TokenExpiredException extends BaseException
{

    /**
     * Default StatusCode
     * @var int
     */
    protected $statusCode = 401;

    /**
     * Prefix that will be add to the message for easy indexing
     * @var string
     */
    protected $prefix = 'TokenExpired';

}
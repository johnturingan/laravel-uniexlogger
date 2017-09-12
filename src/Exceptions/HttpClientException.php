<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 11/09/2017
 * Time: 7:04 PM
 */

namespace UniExLogger\Exceptions;

/**
 * Class HttpClientException
 * @package UniExLogger\Exceptions
 */
class HttpClientException extends BaseException
{

    /**
     * Prefix that will be add to the message for easy indexing
     * @var string
     */
    protected $prefix = 'HttpClient';

}
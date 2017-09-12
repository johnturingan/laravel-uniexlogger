<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 11/09/2017
 * Time: 7:04 PM
 */

namespace UniExLogger\Exceptions;


/**
 * Class SiteConfigurationException
 * @package UniExLogger\Exceptions
 */
class SiteConfigurationException extends BaseException
{


    /**
     * Prefix that will be add to the message for easy indexing
     * @var string
     */
    protected $prefix = 'SiteConfiguration';

}
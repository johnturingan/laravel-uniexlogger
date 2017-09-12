<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 11/09/2017
 * Time: 3:17 PM
 */

namespace UniExLogger;

use UniExLogger\Domain\InfoData;
use UniExLogger\Exceptions\BaseException as PromBaseException;

/**
 * Interface LogManager
 * @package UniExLogger
 */
interface ILogger
{

    /**
     * @param PromBaseException $e
     * @return mixed
     */
    public function exception(PromBaseException $e);


    /**
     * Log Info
     * @param InfoData $info
     */
    public function info(InfoData $info);

}
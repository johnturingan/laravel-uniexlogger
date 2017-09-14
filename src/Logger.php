<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 11/09/2017
 * Time: 3:17 PM
 */

namespace UniExLogger;

use Gelf\Publisher;
use Gelf\Transport\UdpTransport;
use Psr\Log\LoggerInterface;
use UniExLogger\Domain\InfoData;
use UniExLogger\Exceptions\BaseException as PromBaseException;
use Monolog\Handler\GelfHandler;
use Monolog\Logger as Monolog;


/**
 * Class LogManager
 * @package UniExLogger
 */
class Logger implements ILogger
{

    /**
     * @var string
     */
    protected $contextPrefix;

    /**
     * @var Monolog
     */
    private $log;


    /**
     * Logger constructor.
     */
    function __construct()
    {

        $this->contextPrefix = config('uniexlogger.context_prefix');

        $this->log = app(LoggerInterface::class);

        if (! config('app.debug')) {


            $transport = new UdpTransport(
                config('uniexlogger.graylog_host'),
                config('uniexlogger.graylog_port'),
                UdpTransport::CHUNK_MAX_COUNT
            );

            $publisher = new Publisher($transport);
            $gelfHandler = new GelfHandler($publisher);

            $this->log = \Log::getMonolog();

            $this->log->pushHandler($gelfHandler);

        }
    }


    /**
     * Log Exception
     * @param PromBaseException $e
     * @return void
     */
    public function exception(PromBaseException $e)
    {

        if ($this->shouldLog($e)) {

            $prefix = $e->getPrefix();
            $cp = $this->contextPrefix;

            $data = [];
            $data[$cp . '.appFault'] = $e->getAppFault();
            $data[$cp . '.code'] = $e->getCode();
            $data[$cp . '.url'] = $e->getUrl();
            $data[$cp . '.domain'] = $e->getDomain();
            $data[$cp . '.requestData'] = $e->getRequestData();
            $data[$cp . '.headers'] = $e->getHeaders();

            try {
                $this->log->critical( $prefix . ': ' . $e->getMessage(), $data );
            } catch (\Exception $e) {}

        }

    }

    /**
     * Log Info
     * @param InfoData $info
     */
    public function info(InfoData $info)
    {

        $prefix = config('uniexlogger.prefix');

        $cp = $this->contextPrefix;

        $data = [];
        $data[$cp . '.code'] = $info->getCode();
        $data[$cp . '.url'] = $info->getUrl();
        $data[$cp . '.domain'] = $info->getDomain();
        $data[$cp . '.requestData'] = $info->getRequestData();
        $data[$cp . '.headers'] = $info->getHeaders();

        try {
            $this->log->info( $prefix . ': ' . $info->getMessage(), $data );
        } catch (\Exception $e) {}
    }

    /**
     * @param PromBaseException $e
     * @return bool
     */
    private function shouldLog(PromBaseException $e)
    {

        $should_log_namespace = config('uniexlogger.should_log');

        foreach ($should_log_namespace as $ns => $value) {

            if(($e instanceof $ns) && $value === 0 )
            {

                return false;

                break;
            }

        }

        return true;
    }

}
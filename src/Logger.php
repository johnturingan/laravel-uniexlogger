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

        $this->contextPrefix = config('prom-log.context_prefix');

        $this->log = app(LoggerInterface::class);

        if (! config('app.debug')) {


            $transport = new UdpTransport(
                config('prom-log.graylog_host'),
                config('prom-log.graylog_port'),
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

    /**
     * Log Info
     * @param InfoData $info
     */
    public function info(InfoData $info)
    {

        $prefix = config('prom-log.prefix');

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
}
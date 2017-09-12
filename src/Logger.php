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
     * @var \Gelf\Transport\UdpTransport
     */
    protected $transport;

    /**
     * @var Publisher
     */
    protected $publisher;

    /**
     * @var GelfHandler
     */
    protected $gelfHandler;

    /**
     * @var Monolog
     */
    private $monolog;


    /**
     * Logger constructor.
     */
    function __construct()
    {

        $this->transport = new UdpTransport(
            config('prom-log.graylog_host'),
            config('prom-log.graylog_port'),
            UdpTransport::CHUNK_MAX_COUNT
        );

        $this->contextPrefix = config('prom-log.context_prefix');

        $this->publisher = new Publisher($this->transport);
        $this->gelfHandler = new GelfHandler($this->publisher);

        $this->monolog = \Log::getMonolog();

        $this->monolog->pushHandler($this->gelfHandler);
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
        $data[$cp . '.code'] = $e->getCode();
        $data[$cp . '.url'] = $e->getUrl();
        $data[$cp . '.domain'] = $e->getDomain();
        $data[$cp . '.requestData'] = $e->getRequestData();
        $data[$cp . '.headers'] = $e->getHeaders();

        $this->monolog->critical( $prefix . ': ' . $e->getMessage(), $data );

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

        $this->monolog->info( $prefix . ': ' . $info->getMessage(), $data );
    }
}
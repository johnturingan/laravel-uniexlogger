<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 11/09/2017
 * Time: 3:28 PM
 */

namespace UniExLogger\Exceptions;


use Throwable;
use UniExLogger\ILogger;

/**
 * Class BaseException
 * @package UniExLogger\Exceptions
 */
abstract class BaseException extends \Exception
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $userId;

    /**
     * @var string
     */
    protected $sessionId;

    /**
     * Default StatusCode
     * @var int
     */
    protected $statusCode = 500;

    /**
     * Application where it throws exception
     * @var string
     */
    protected $appFault = null;

    /**
     * Prefix that will be add to the message for easy indexing
     * @var string
     */
    protected $prefix;

    /**
     * Url of the current request
     * @var string
     */
    protected $url;

    /**
     * Domain of the current request
     * @var string
     */
    protected $domain;

    /**
     * Client IP address
     * @var string
     */
    protected $ip;

    /**
     * Client Platform used
     * @var string
     */
    protected $platform;

    /**
     * Site Localization if necessary
     * @var string
     */
    protected $language;

    /**
     * Request Data of the current request
     * @var array
     */
    protected $requestData = [];

    /**
     * List or headers
     * @var array
     */
    protected $headers = [];

    /**
     * @var bool
     */
    protected $loggable = false;

    /**
     * BaseException constructor.
     * @param string $message
     * @param null $code
     * @param Throwable|null $previous
     */
    function __construct($message, $code = null, Throwable $previous = null)
    {

        if (is_null($code)) {
            $code = $this->statusCode;
        }

        $this->prefix = $this->prefix ?? config('uniexlogger.prefix');

        $this->setMessage($message);

        parent::__construct($message, $code, $previous);
    }


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId ($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setUserId ($id)
    {
        $this->userId = $id;

        return $this;
    }


    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setSessionId ($id)
    {
        $this->sessionId = $id;

        return $this;
    }


    /**
     * @return string
     */
    public function getAppFault()
    {
        return $this->appFault;
    }

    /**
     * @param string $appFault
     * @return $this
     */
    public function setAppFault($appFault)
    {
        $this->appFault = $appFault;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return $this
     */
    public function setPrefix(?string $prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }


    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(?string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain(?string $domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param null|string $ip
     * @return $this
     */
    public function setIp(?string $ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @param null|string $platform
     * @return $this
     */
    public function setPlatform(?string $platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage(?string $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequestData(): array
    {
        return $this->requestData;
    }

    /**
     * @param array $requestData
     * @return $this
     */
    public function setRequestData(array $requestData)
    {
        $this->requestData = $requestData;

        return $this;
    }


    /**
     * @return array
     */
    public function getHeaders(): array
    {

        $reqHeaders = config('uniexlogger.request_headers', []);

        $headers = [];

        foreach ($reqHeaders as $header) {

            if (isset($this->headers[$header])) {

                $headers[$header] = $this->headers[$header];

            }

        }

        return $headers;

    }

    /**
     * @param $headers
     * @return $this
     */
    public function setHeaders($headers)
    {

        $this->headers = (array) $headers;

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(?string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param int $code
     * @return $this
     */
    public function setCode (int $code)
    {

        $this->code = $code;

        return $this;

    }

    /**
     * @return bool
     */
    public function shouldLog()
    {
        return $this->loggable;
    }

    /**
     * @param $bool
     * @return $this
     */
    public function ableLog($bool)
    {
        $this->loggable = $bool;

        return $this;
    }

    /**
     * Log type
     */
    public function report()
    {
        /**
         * @var $logger ILogger
         */
        $logger = app(ILogger::class);

        $logger->exception($this);

    }

}
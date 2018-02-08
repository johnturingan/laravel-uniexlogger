<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 11/09/2017
 * Time: 3:22 PM
 */

namespace UniExLogger\Domain;

use Illuminate\Http\Request;

/**
 * Class InfoData
 */
class InfoData
{

    /**
     * @var string
     */
    protected $id;

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
     * Custom code for info
     * @var int
     */
    protected $code = 0;

    /**
     * Message you want to Log
     * @var string
     */
    protected $message;

    /**
     * @var Request
     */
    private $request;



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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain(string $domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this;
     */
    public function setLanguage(string $language)
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

        $reqHeaders = config('uniexlogger.request_headers');

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
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return $this
     */
    public function setCode(int $code)
    {
        $this->code = $code;

        return $this;
    }

}
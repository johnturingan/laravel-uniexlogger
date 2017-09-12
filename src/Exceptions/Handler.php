<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 12/09/2017
 * Time: 2:17 PM
 */

namespace UniExLogger\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\ExceptionHandler as SymfonyDisplayer;

use UniExLogger\ILogger;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Handler
 * @package UniExLogger\Exceptions
 */
class Handler extends ExceptionHandler
{

    /**
     * @var ILogger
     */
    protected $logger;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        BaseException::class,
        NotFoundHttpException::class
    ];

    /**
     * Handler constructor.
     * @param LoggerInterface $log
     */
    function __construct(LoggerInterface $log)
    {
        parent::__construct($log);

        $this->logger = app(ILogger::class);
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     *
     * @return void
     */
    public function report(\Exception $e)
    {

        if ($e instanceof BaseException) {

            $this->logger->exception($e);

        }

        parent::report($e);
    }

    /**
     * Render an exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, \Exception $e)
    {

        if ($e instanceof HttpException) {
            return $this->renderHttpException($e);
        }

        if (view()->exists("errors.{$e->getCode()}")) {

            return response()->view("errors.{$e->getCode()}", [ 'message' => $e->getMessage() ], 200);

        }

        return $this->convertExceptionToResponse($e);

    }

    public function renderDebug (\Exception $e)
    {

        if ($e instanceof BaseException) {

            $context = [
                'message' => $e->getMessage(),
                'url' => $e->getUrl(),
                'language' => $e->getLanguage(),
                'domain' => $e->getDomain()
            ];

            $message = implode_assoc($context, ': ', ' ');

            $e->setMessage($message);

        }

        (new SymfonyDisplayer(true))->handle($e);

        return false;

    }
}
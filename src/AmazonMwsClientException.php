<?php

namespace Yuca;

use Exception;
use SimpleXMLElement;

/**
 * Marketplace Web Service  Exception provides details of errors 
 * returned by Marketplace Web Service  service
 */
class AmazonMwsClientException extends Exception
{
    /**
     * @var null
     */
    protected $message = null;

    /**
     * @var null
     */
    private $statusCode = -1;

    /**
     * @var null
     */
    private $errorCode = null;

    /**
     * @var null
     */
    private $errorType = null;

    /**
     * @var null
     */
    private $requestId = null;

    /**
     * @var null
     */
    private $responseHeaders = null;

    /**
     * Constructs AmazonMwsClientException
     * @param SimpleXMLElement $error details of exception.
     */
    public function __construct(SimpleXMLElement $error, array $responseHeaders = [])
    {
        $this->message = $error->Error->Message;
        parent::__construct($this->message);
 
        if (isset($error->Error->Type)) {
            $this->errorType = $error->Error->Type;
        }

        if (isset($error->Error->Code)) {
            $this->statusCode = $error->Error->Code;
        }

        if (isset($error->RequestID)) {
            $this->requestId = $error->RequestID;
        }

        if ($responseHeaders) {
            $this->responseHeaders = $responseHeaders;
        }
    }

    /**
     * Gets error type returned by the service if available.
     *
     * @return string Error Code returned by the service
     */
    public function getErrorCode(){
        return $this->errorCode;
    }
   
    /**
     * Gets error type returned by the service.
     *
     * @return string Error Type returned by the service.
     * Possible types:  Sender, Receiver or Unknown
     */
    public function getErrorType(){
        return $this->errorType;
    }
    
    
    /**
     * Gets error message
     *
     * @return string Error message
     */
    public function getErrorMessage() {
        return $this->message;
    }
    
    /**
     * Gets status code returned by the service if available. If status
     * code is set to -1, it means that status code was unavailable at the
     * time exception was thrown
     *
     * @return int status code returned by the service
     */
    public function getStatusCode() {
        return $this->statusCode;
    }
    
    /**
     * Gets Request ID returned by the service if available.
     *
     * @return string Request ID returned by the service
     */
    public function getRequestId() {
        return $this->requestId;
    }

    /**
     * Get the response headers
     *     
     * @return array
     */
    public function getResponseHeaders() {
        return $this->responseHeaders;
    }
}

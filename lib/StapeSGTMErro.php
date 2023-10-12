<?php
class CustomHttpError extends Exception {
    public $status;
    public $statusText;
    public $error;

    public function __construct($status, $statusText, $error, $message = "", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->status = $status;
        $this->statusText = $statusText;
        $this->error = $error;
        echo $error;
    }
}
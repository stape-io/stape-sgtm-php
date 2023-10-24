<?php

declare(strict_types = 1);

namespace Stape\Sgtm;

class SGTMException extends \Exception {
    private ?int $status;
    private ?string $statusText;
    private ?string $error;

    public function __construct(
		?int $status,
		?string $statusText,
	 	?string $error,
		string $message = "",
	 	int $code = 0,
		\Throwable $previous = null
	)
	{
        parent::__construct($message, $code, $previous);
        $this->status = $status;
        $this->statusText = $statusText;
        $this->error = $error;
    }

	public function getStatus(): ?int
	{
		return $this->status;
	}

	public function getStatusText(): ?string
	{
		return $this->statusText;
	}

	public function getError(): ?string
	{
		return $this->error;
	}

}
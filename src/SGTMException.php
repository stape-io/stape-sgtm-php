<?php

declare(strict_types=1);

namespace Stape\Sgtm;

class SGTMException extends \Exception
{
    private ?int $status;
    private ?string $error;

    public function __construct(
        ?int $status = null,
        ?string $error = null,
        string $message = "",
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->status = $status;
        $this->error = $error;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

}

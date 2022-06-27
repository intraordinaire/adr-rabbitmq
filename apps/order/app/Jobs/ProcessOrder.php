<?php

namespace App\Jobs;

class ProcessOrder extends BaseJob
{
    public function __construct(array $payload)
    {
        parent::__construct($payload);
    }
}

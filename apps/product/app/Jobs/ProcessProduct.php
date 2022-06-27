<?php

namespace App\Jobs;

class ProcessProduct extends BaseJob
{
    public function __construct(array $payload)
    {
        parent::__construct($payload);
    }
}

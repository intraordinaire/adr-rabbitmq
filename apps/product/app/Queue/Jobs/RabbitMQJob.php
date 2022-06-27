<?php

namespace App\Queue\Jobs;

use Illuminate\Queue\Jobs\JobName;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob as BaseJob;

class RabbitMQJob extends BaseJob
{
    /**
     * @inheritdoc
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function fire(): void
    {
        $payload = $this->payload();

        [$class, $method] = JobName::parse($payload['job']);

        ($this->instance = $this->resolve($class))->{$method}($this, $payload['data']);

        $this->delete();
    }
}

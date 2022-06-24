# adr-rabbitmq

POC project to test rabbit-mq in cross service communications.

Services can be distributed in multiple locations & technologies.

## Installation

### Step by step

⚠️ _Be sure to have docker installed on you machine before._

Copy ``/apps/php-order/.env.example`` to ``/apps/php-order/.env`` 

1. Build images ``docker-compose build`` (first time only)
2. And run ``docker-compose up -d`` 

### Laravel App
The default Laravel page should be available at ``http://localhost/``

### Nest App
The default Nest page should be available at ``http://localhost:3000/``

### RabbitMQ Environment
The RabbitMQ should be available at ``http://localhost:15672``

Use default user ```guest``` and password ``guest``

### Stop app

Run ``docker-compose down``


## Usage

3 Queues are available in RabbitMQ

 - ``php-orders`` : Classic queue to handle orders processing
 - ``node-products`` : Classic queue to handle products updates
 - ``products-orders`` : Stream queue to broadcast some events on orders

### PHP create messages to ``php-orders`` & ``product-orders``

Enter the docker console/terminal (At least 3 tabs) of the PHP container

 - ``php artisan rabbitmq:consume php-orders`` : will start listening on the ``php-orders`` queue
 - ``php artisan rabbitmq:consume product-orders`` : will start listening on the ``product-orders`` queue
 - ``php artisan order:process {int?}`` :  Create the given number of jobs (default to one) to be processed by the ``php-orders`` queue
 - ``php artisan order:product {int?}`` :  Create the given number of jobs (default to one) to be processed by the ``product-orders`` queue

### Node create messages to ``node-products`` & ``product-orders``

_TODO_

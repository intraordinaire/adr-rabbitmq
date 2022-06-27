# adr-rabbitmq

POC project to test rabbit-mq in cross service communications.

Services can be distributed in multiple locations & technologies.

## Installation

### Step by step

⚠️ _Be sure to have docker installed on you machine before._

1. Copy ``/apps/order/.env.example`` to ``/apps/order/.env``
2. Copy ``/apps/product/.env.example`` to ``/apps/product/.env``
3. Build images ``docker-compose build`` (first time only)
4. And run ``docker-compose up -d`` 

### Order App
The order app page should be available at ``http://localhost/``

### Product App
The product app page should be available at ``http://localhost:8080/``

### RabbitMQ Environment
The RabbitMQ should be available at ``http://localhost:15672``

Use default user ```guest``` and password ``guest``

### Stop app

Run ``docker-compose down``


## Usage

3 Queues are available in RabbitMQ

 - ``orders`` : Classic queue to handle orders processing
 - ``products`` : Classic queue to handle products updates
 - ``products-orders`` : Stream queue to broadcast some events on orders

### Create messages to ``orders`` & ``product-orders``

Enter the docker console/terminal (open multiple tabs to follow all processes) of the order container

 - ``docker exec -it adr-rabbitmq-order-1 bash`` 
 - ``php artisan rabbitmq:consume orders`` : will start listening on the ``orders`` queue
 - ``php artisan rabbitmq:consume product-orders`` : will start listening on the ``product-orders`` queue
 - ``php artisan order:process {int?}`` :  Create the given number of jobs (default to one) to be processed by the ``orders`` queue
 - ``php artisan order:product {int?}`` :  Create the given number of jobs (default to one) to be processed by the ``product-orders`` queue
 - ``php artisan order:full {int?}`` :  Create jobs on both queue, ``orders`` & ``product-orders``

### Create messages to ``products``

Enter the docker console/terminal (open multiple tabs to follow all processes) of the product container

- ``docker exec -it adr-rabbitmq-product-1 bash``
- ``php artisan rabbitmq:consume products`` : will start listening on the ``products`` queue
- ``php artisan rabbitmq:consume product-orders`` : will start listening on the ``product-orders`` queue
- ``php artisan product:process {int?}`` :  Create the given number of jobs (default to one) to be processed by the ``product`` queue
- ``php artisan product:full {int?}`` :  Create jobs on both queue, ``products`` & ``product-orders``


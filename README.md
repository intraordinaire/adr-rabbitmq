# adr-rabbitmq

POC project to test rabbit-mq in cross service communications.
Services can be distributed in multiple locations & technologies.

## Installation

### Docker

⚠️ _Be sure to have docker installed on you machine before._

1. Build ``docker-compose build`` (first time only)
2. And run ``docker-compose up -d`` 

### Laravel App

The default Laravel page should be available at ``http://localhost/``


### Nest App
The default Nest page should be available at ``http://localhost:3000/``

### RabbitMQ Environment
The RabbitMQ should be available at ``http://localhost:15672``
Use default user ```guest``` and password ``guest``

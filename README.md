You have to be installed:
- MySQL (or you can use docker-compose up)
- SQLite
- PHP > 7.1

You have to create the initial table using the scripts on ´config/scripts/mysql/´

Run the following command, to create the event stream  to todo

bin/console event-store:event-stream:create

Create database for read model running this command

bin/console doctrine:database:create
bin/console doctrine:schema:update --force


Run event listener worker for todo projections:

bin/console event-store:projection:run todo


Execute PHP server

bin/console server:run

Go to http://127.0.0.1:8000/

TODO:

- use an async bus (command and event) https://github.com/prooph/psb-zeromq-producer/blob/master/README.md#usage-examples

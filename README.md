# Organization - User
## Endpoints, Command, Excel csv Import

[![N|Solid](https://laravel.com/img/logotype.min.svg)](https://laravel.com/)

This project importing the organizations.csv with command.

## Features

-  Organizations add on organizations table. 
-  User add on users table. 
-  During user creation, a Welcome and Password Mail is sent. 

Organization and User model actions is done with service-repository pattern.

## Installation

Organization - User requires [Docker](https://www.docker.com/) to run.

Install the dependencies and devDependencies and start the server.

```sh
cd organization-user
sail up -d OR docker-compose up -d
```

Database migration...

```sh
sail artisan migrate
```

Command for import Organizations.csv 

```sh
sail artisan import:organization
```

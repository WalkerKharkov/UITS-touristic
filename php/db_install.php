<?php
$queries = array(
                'CREATE TABLE clients (
                    id INT (10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    user_id INT (11) UNSIGNED NOT NULL,
                    phone VARCHAR (15) NOT NULL,
                    discount TINYINT (2) DEFAULT 0,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE countries (
                    id SMALLINT (3) UNSIGNED NOT NULL AUTO_INCREMENT,
                    name VARCHAR (50) NOT NULL,
                    description LONGTEXT,
                    visa_id TINYINT (1) UNSIGNED NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE hotels (
                    id INT (10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    name VARCHAR (30) NOT NULL,
                    category TINYINT (1) NOT NULL,
                    description LONGTEXT,
                    resort_id SMALLINT (3) UNSIGNED NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE orders (
                    id INT (10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    date TIMESTAMP NOT NULL,
                    client_id INT (10) UNSIGNED NOT NULL,
                    manager_id INT (10) UNSIGNED NOT NULL,
                    order_status_id TINYINT (1) UNSIGNED NOT NULL,
                    hotel_id INT (10) UNSIGNED NOT NULL,
                    room_id INT (11) UNSIGNED NOT NULL,
                    trip_id INT (11) UNSIGNED NOT NULL,
                    stay_period TINYINT (3) NOT NULL,
                    transfer_price FLOAT (6) DEFAULT 0,
                    total_price FLOAT (9) NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE order_statuses (
                    id TINYINT (1) UNSIGNED NOT NULL AUTO_INCREMENT,
                    type VARCHAR (25) NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE resorts (
                    id SMALLINT (3) UNSIGNED NOT NULL AUTO_INCREMENT,
                    name VARCHAR (30) NOT NULL,
                    description LONGTEXT,
                    country_id SMALLINT (3) UNSIGNED NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE roles (
                    id TINYINT (1) UNSIGNED NOT NULL AUTO_INCREMENT,
                    role VARCHAR (15),
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE rooms (
                    id INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    hotel_id INT (11) UNSIGNED NOT NULL,
                    room_type_id TINYINT (1) UNSIGNED NOT NULL,
                    price FLOAT (9) NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE room_types (
                    id TINYINT (1) UNSIGNED NOT NULL AUTO_INCREMENT,
                    type VARCHAR (15) NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE transports (
                    id TINYINT (1) UNSIGNED NOT NULL AUTO_INCREMENT,
                    type VARCHAR (30) NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE trips (
                    id INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    transport_id TINYINT (1) UNSIGNED NOT NULL,
                    departure VARCHAR (30) NOT NULL,
                    arrival VARCHAR (30) NOT NULL,
                    departure_date TIMESTAMP NOT NULL,
                    arrival_date TIMESTAMP NOT NULL,
                    trip_time TIME NOT NULL,
                    price FLOAT (9) NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE users (
                    id INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    name VARCHAR (30) NOT NULL,
                    surname VARCHAR (30) NOT NULL,
                    login VARCHAR (20),
                    password VARCHAR (15),
                    email VARCHAR (30),
                    role_id TINYINT (1) UNSIGNED NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'CREATE TABLE visas (
                    id TINYINT (1) UNSIGNED NOT NULL AUTO_INCREMENT,
                    type VARCHAR (50) NOT NULL,
                    PRIMARY KEY (id)
                    ) Engine = InnoDB CHARACTER SET=UTF8;
                ',
                'ALTER TABLE countries ADD FOREIGN KEY (visa_id) REFERENCES visas (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE resorts ADD FOREIGN KEY (country_id) REFERENCES countries (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE hotels ADD FOREIGN KEY (resort_id) REFERENCES resorts (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE rooms ADD FOREIGN KEY (hotel_id) REFERENCES hotels (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE rooms ADD FOREIGN KEY (room_type_id) REFERENCES room_types (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE orders ADD FOREIGN KEY (room_id) REFERENCES rooms (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE orders ADD FOREIGN KEY (hotel_id) REFERENCES hotels (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE orders ADD FOREIGN KEY (client_id) REFERENCES clients (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE orders ADD FOREIGN KEY (manager_id) REFERENCES clients (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE clients ADD FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE users ADD FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE orders ADD FOREIGN KEY (trip_id) REFERENCES trips (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE orders ADD FOREIGN KEY (order_status_id) REFERENCES order_statuses (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'ALTER TABLE trips ADD FOREIGN KEY (transport_id) REFERENCES transports (id) ON UPDATE RESTRICT ON DELETE RESTRICT;',
                'INSERT INTO roles VALUES ( NULL, "admin" );',
                'INSERT INTO roles VALUES ( NULL, "manager" );',
                'INSERT INTO roles VALUES ( NULL, "client" );',
                'INSERT INTO transports VALUES ( NULL, "plain" );',
                'INSERT INTO transports VALUES ( NULL, "train" );',
                'INSERT INTO transports VALUES ( NULL, "bus" );',
                'INSERT INTO transports VALUES ( NULL, "ship" );',
                'INSERT INTO visas VALUES ( NULL, "not required" );',
                'INSERT INTO visas VALUES ( NULL, "schengen" );',
                'INSERT INTO visas VALUES ( NULL, "on arrival" );',
                'INSERT INTO visas VALUES ( NULL, "prepaid" );',
                'INSERT INTO order_statuses VALUES ( NULL, "waiting for payments" );',
                'INSERT INTO order_statuses VALUES ( NULL, "partially paid" );',
                'INSERT INTO order_statuses VALUES ( NULL, "paid" );',
                'INSERT INTO order_statuses VALUES ( NULL, "successfully completed" );',
                'INSERT INTO order_statuses VALUES ( NULL, "cancelled" );'
);

$server   = 'localhost';
$user     = 'root';
$password = '';
$db_name  = 'test';

if ( ! $con = mysqli_connect( $server, $user, $password, $db_name ) ){
    die ( 'Error database connection!' );
}
$query = 'CREATE DATABASE tourism';
if ( ! mysqli_query( $con, $query ) ){
    die ( 'Error database creation!' );
}
mysqli_close( $con );
echo 'database created';

$db_name = 'tourism';
if ( ! $con = @mysqli_connect( $server, $user, $password, $db_name ) ){
    die ( 'Error database connection!' );
}
$query = '';

foreach ( $queries as $query ){
    mysqli_query( $con, $query );
}

echo ' and structured...';
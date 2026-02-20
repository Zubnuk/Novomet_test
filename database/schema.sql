

CREATE DATABASE IF NOT EXISTS transport_system
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE transport_system;

CREATE TABLE transport_type (
    type_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);


CREATE TABLE driver (
    driver_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL
);


CREATE TABLE route (
    route_id INT AUTO_INCREMENT PRIMARY KEY,
    route_number VARCHAR(20) NOT NULL UNIQUE
);


CREATE TABLE stop (
    stop_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    latitude DECIMAL(9,6) NOT NULL,
    longitude DECIMAL(9,6) NOT NULL
);


CREATE TABLE route_stop (
    route_id INT NOT NULL,
    stop_id INT NOT NULL,
    stop_order INT NOT NULL,

    PRIMARY KEY (route_id, stop_id),

    CONSTRAINT fk_route_stop_route
        FOREIGN KEY (route_id)
        REFERENCES route(route_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_route_stop_stop
        FOREIGN KEY (stop_id)
        REFERENCES stop(stop_id)
        ON DELETE CASCADE
);


CREATE TABLE transport (
    transport_id INT AUTO_INCREMENT PRIMARY KEY,
    plate_number VARCHAR(20) NOT NULL UNIQUE,
    model VARCHAR(100),
    description TEXT,
    `condition` VARCHAR(50),
    year INT,

    type_id INT NOT NULL,
    route_id INT NOT NULL,
    driver_id INT NOT NULL,

    CONSTRAINT fk_transport_type
        FOREIGN KEY (type_id)
        REFERENCES transport_type(type_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_transport_route
        FOREIGN KEY (route_id)
        REFERENCES route(route_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_transport_driver
        FOREIGN KEY (driver_id)
        REFERENCES driver(driver_id)
        ON DELETE CASCADE
);
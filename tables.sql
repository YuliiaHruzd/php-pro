CREATE TABLE parks (
id int(8) NOT NULL,
address VARCHAR(256) NOT NULL,
PRIMARY KEY(id)
);

CREATE TABLE cars (
id int(8) NOT NULL,
park_id int(8) NOT NULL,
model VARCHAR(256) NOT NULL,
price FLOAT(7,4) NOT NULL,
PRIMARY KEY(id)
);

CREATE TABLE drivers (
id int(8) NOT NULL,
car_id int(8) NOT NULL,
name VARCHAR(256) NOT NULL,
phone VARCHAR(256),
PRIMARY KEY(id)
);

CREATE TABLE orders (
id int(8) NOT NULL,
driver_id int(8) NOT NULL,
customer_id int(8) NOT NULL,
start text NOT NULL,
finish text NOT NULL,
total FLOAT(7,4) NOT NULL,
PRIMARY KEY(id)
);

CREATE TABLE customers (
id int(8) NOT NULL,
name VARCHAR(256) NOT NULL,
phone VARCHAR(256),
PRIMARY KEY(id)
);

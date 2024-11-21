ALTER TABLE customers modify column name text;

insert into cars set id= 1, park_id= 1, model = 'bmw', price=777;
insert into cars set id= 2, park_id= 2, model = 'mers', price=888;
insert into cars set id= 3, park_id= 3, model = 'audi', price=999;

insert into drivers set id= 1, car_id= 1, name = 'mike', phone='10000123';
insert into drivers set id= 2, car_id= 2, name = 'den', phone='10000321';
insert into drivers set id= 3, car_id= 3, name = 'ira', phone='10000123';

insert into customers set id= 1, name = 'customer1', phone='10000127';
insert into customers set id= 2, name = 'customer2', phone='10000328';
insert into customers set id= 3, name = 'customer3', phone='10000129';

insert into orders set id= 1, customer_id = 1, driver_id= 1, start='fdfdf', finish='dfdfd', total=123;
insert into orders set id= 2, customer_id = 2, driver_id= 2, start='fdfdf', finish='dfdfd', total=126;
insert into orders set id= 3, customer_id = 3, driver_id= 3, start='fdfdf', finish='dfdfd', total=127;

insert into parks set id= 1, address = 'address1';
insert into parks set id= 2, address = 'address2';
insert into parks set id= 3, address = 'address3';

update parks set address='new_adress' where parks.id = 3;

delete FROM parks where parks.id = 3;

SELECT * FROM orders
                  join bdsm.customers c on c.id = orders.customer_id
                  join bdsm.drivers d on d.id = orders.driver_id;

ALTER TABLE parks add column test varchar(256);

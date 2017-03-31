Marina Kent

List the name of the girl scout that has refereed the most customers.

	Note: I am counting getting the same customer multiple times (for example, if girlscout1 refers me twice, 
	I'm counting it as two referrals.)
	
	-------answer -------
	create view grouped as select gsid, count(*) as num from Orders group by gsid;
	create view maxGroup as select gsid, MAX(num) from grouped;											
	select name from Girlscouts where (gsid = (select gsid from maxGroup));

List the name of the customer that has made the most orders.

	-------answer-------
	create view countOrders as select cid as countCID, count(cid) as num from Orders group by cid;
	select name from Customer, countOrders WHERE countCID = cid AND num  = (select max(num) from countOrders);

List the name of the customer that has ordered the most cookies. Note, its a bit
different from the previous query. 

	-------answer--------
	select name from (
	(select * from ( 
	(select SUM(quantity) as num, cid as cid1 from (
	(select * from Cookies inner join Orders on Orders.orderID = Cookies.CookieOrderID) as x) 
	group by cid) as y) 
	inner join Customer where y.cid1 = Customer.cid) as j) 
	where num = (select MAX(num) from (
	(select * from ( (select SUM(quantity) as num, cid as cid1 from (
	(select * from Cookies inner join Orders on Orders.orderID = Cookies.CookieOrderID) as x) 
	group by cid) as y) 
	inner join Customer where y.cid1 = Customer.cid) as u));

What is the most popular cookie type? i.e. you will need to look at all orders, and
the quantities of the cookies in the order.

	-------answer--------
	create view cookieSum as select type, SUM(quantity) as num from Cookies group by type;
	select type from cookieSum where
		(num = 
		(select MAX(num) from cookieSum));

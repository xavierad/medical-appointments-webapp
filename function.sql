delimiter $$
create function no_shows(gender char(1), year char(4), low_age integer, high_age integer)
returns integer
begin
	declare result;
	select count(A.date_timestamp) into result
	from appointment A left join consultation C
   	on A.date_timestamp = C.date_timestamp
    and A.VAT_doctor = C.VAT_doctor
    where C.date_timestamp is null
    and C.VAT_doctor is null
end$$
delimiter ;



    $sql = "SELECT A.VAT_doctor, A.date_timestamp, A._description, A.VAT_client
            FROM  appointment A
            LEFT JOIN consultation C
            ON A.date_timestamp = C.date_timestamp
            AND A.VAT_doctor = C.VAT_doctor
            WHERE C.date_timestamp is null
            AND C.VAT_doctor is null
            AND A.VAT_client = $VAT";



delimiter $$
create function count_accounts1(c_name varchar(255))
returns integer
begin
    declare a_count integer;
    select count(account_number) into a_count
    from depositor
    where customer_name = c_name;
    return a_count;
end$$
delimiter ;

delimiter $$

create function absolute_balance(c_name varchar(255))
;returns integer
begin
  declare result, num1, num2 integer;
  select sum(balance) into num1
  from account natural join depositor
  where customer_name = c_name;
  select sum(amount) into num2
  from loan natural join borrower
  where customer_name = c_name;
  return abs(num1 - num2);
end$$

delimiter
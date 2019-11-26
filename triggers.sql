/* 1-
Write a trigger to update the age of the clients according to the birth date
and the current date. The trigger should fire whenever a new appointment
for a client is inserted into the database.
*/

-- for each new appointment created
delimiter $$
create trigger check_age before update on client
for each row
begin
 if new.amount < 0 then
   insert into account values (new.loan_number,
                               new.branch_name,
                               (-1)*new.amount);
 insert into depositor (
   select customer_name, loan_number
   from borrower as b
   where b.loan_number = new.loan_number);
 set new.amount = 0;
 end if;
end$$
delimiter ;

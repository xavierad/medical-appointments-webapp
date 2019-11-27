/* 1-
Write a trigger to update the age of the clients according to the birth date
and the current date. The trigger should fire whenever a new appointment
for a client is inserted into the database.
*/

-- for each new appointment created
delimiter $$
create trigger check_age before insert on appointment
for each row
begin
  update client set client.age = (select DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(client.birth_date, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(client.birth_date, '00-%m-%d')) ) where client.VAT=appointment.VAT_client
end$$
delimiter ;

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
  update client set client.age = select (TIMESTAMPDIFF(YEAR,client.birth_date,CURDATE()));
  where client.VAT=appointment.VAT_client
end$$
delimiter ;



/* 2-
Write triggers to ensure that (a) an individual that is a receptionist or
a nurse at the clinic cannot simultaneously be a doctor, and (b) doctors
cannot simultaneously be trainees and permanent staff.
*/
-- a)
delimiter $$
create trigger ensure_recep before insert on receptionist
for each row
begin
  if receptionist.VAT in select(VAT from doctor) then CONC("A doctor with de VAT number ",receptionist.VAT, " already exists!")
end$$
delimiter ;

delimiter $$
create trigger ensure_nurse before insert on nurse
for each row
begin
  if nurse.VAT in select(VAT from doctor) then CONC("A doctor with de VAT number ",nurse.VAT, " already exists!")
end$$
delimiter ;

-- b)
delimiter $$
create trigger ensure_train_not_perm before insert on trainee
for each row
begin
  if trainee.VAT in select(VAT from permanent) then CONC("A permanent with de VAT number ",trainee.VAT, " already exists!")
end$$
delimiter ;

delimiter $$
create trigger ensure_perm_not_train before insert on permanent
for each row
begin
  if trainee.VAT in select(VAT from permanent) then CONC("A permanent with de VAT number ",trainee.VAT, " already exists!")
end$$
delimiter ;

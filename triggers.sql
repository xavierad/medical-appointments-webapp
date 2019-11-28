/* 1-
Write a trigger to update the age of the clients according to the birth date
and the current date. The trigger should fire whenever a new appointment
for a client is inserted into the database.
*/

-- for each new appointment created
drop trigger if exists check_age;
delimiter $$
create trigger check_age before insert on appointment
for each row
begin
  update client set client.age = (select TIMESTAMPDIFF(YEAR,client.birth_date,CURDATE()))
  where client.VAT=new.VAT_client;
end$$
delimiter ;



/* 2-
Write triggers to ensure that (a) an individual that is a receptionist or
a nurse at the clinic cannot simultaneously be a doctor, and (b) doctors
cannot simultaneously be trainee_doctors and permanent_doctor staff.
*/
-- a)
-- ensure recep is not doctor
drop trigger if exists ensure_recep_insert;
delimiter $$
create trigger ensure_recep_insert before insert on receptionist
for each row
begin
  if new.VAT in (select VAT from doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a doctor with this VAT number! A doctor cannot be a receptionist!';
  end if;
end$$
delimiter ;

drop trigger if exists ensure_recep_update;
delimiter $$
create trigger ensure_recep_update before update on receptionist
for each row
begin
  if new.VAT in (select VAT from doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a doctor with this VAT number! A doctor cannot be a receptionist!';
  end if;
end$$
delimiter ;

-- ensure nurse is not doctor
drop trigger if exists ensure_nurse_insert;
delimiter $$
create trigger ensure_nurse_insert before insert on nurse
for each row
begin
  if new.VAT in (select VAT from doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a doctor with this VAT number! A doctor cannot be a nurse!';
  end if;
end$$
delimiter ;

drop trigger if exists ensure_nurse_update;
delimiter $$
create trigger ensure_nurse_update before update on nurse
for each row
begin
  if new.VAT in (select VAT from doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a doctor with this VAT number! A doctor cannot be a nurse!';
  end if;
end$$
delimiter ;

-- ensure doctor is not recep neither nurse
drop trigger if exists ensure_doctor_insert;
delimiter $$
create trigger ensure_doctor_insert before insert on doctor
for each row
begin
  if new.VAT in (select VAT from receptionist) then
    signal sqlstate '45000'
    set message_text = 'Already exists a receptionist with this VAT number! A receptionist cannot be a doctor!';
  elseif new.VAT in (select VAT from nurse) then
    signal sqlstate '45000'
    set message_text = 'Already exists a nurse with this VAT number! A nurse cannot be a doctor!';
  end if;
end$$
delimiter ;

drop trigger if exists ensure_doctor_update;
delimiter $$
create trigger ensure_doctor_update before update on doctor
for each row
begin
  if new.VAT in (select VAT from receptionist) then
    signal sqlstate '45000'
    set message_text = 'Already exists a receptionist with this VAT number! A receptionist cannot be a doctor!';
  elseif new.VAT in (select VAT from nurse) then
    signal sqlstate '45000'
    set message_text = 'Already exists a nurse with this VAT number! A nurse cannot be a doctor!';
  end if;
end$$
delimiter ;



-- b)
-- ensure trainee cannot be a permanent doctor
drop trigger if exists ensure_train_not_perm_insert;
delimiter $$
create trigger ensure_train_not_perm_insert before insert on trainee_doctor
for each row
begin
  if new.VAT in (select VAT from permanent_doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a permanent doctor with this VAT number! A permanent cannot be a trainee!';
  elseif new.supervisor in  (select VAT from permanent_doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a supervisor (permanent doctor) with this VAT number! A supervisor cannot be a trainee!';
  end if;
end$$
delimiter ;

drop trigger if exists ensure_train_not_perm_update;
delimiter $$
create trigger ensure_train_not_perm_update before update on trainee_doctor
for each row
begin
  if new.VAT in (select VAT from permanent_doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a permanent doctor with this VAT number! A permanent cannot be a trainee!';
  elseif new.supervisor in  (select VAT from permanent_doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a supervisor (permanent doctor) with this VAT number! A supervisor cannot be a trainee!';
  end if;
end$$
delimiter ;

-- ensure permanent doctor cannot be trainee doctor.
drop trigger if exists ensure_perm_not_train_insert;
delimiter $$
create trigger ensure_perm_not_train_insert before insert on permanent_doctor
for each row
begin
  if new.VAT in (select VAT from trainee_doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a trainee doctor with this VAT number! A trainee doctor cannot be a permanent!';
  end if;
end$$
delimiter ;

drop trigger if exists ensure_perm_not_train_update;
delimiter $$
create trigger ensure_perm_not_train_update before update on permanent_doctor
for each row
begin
  if new.VAT in (select VAT from trainee_doctor) then
    signal sqlstate '45000'
    set message_text = 'Already exists a trainee doctor with this VAT number! A trainee doctor cannot be a permanent!';
  end if;
end$$
delimiter ;

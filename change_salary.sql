DROP PROCEDURE IF EXISTS change_salary;

DELIMITER $$

CREATE PROCEDURE change_salary (IN number_years integer)
BEGIN

UPDATE employee,
( SELECT info_doctor.VAT_doctor as doctor_VAT, info_doctor.salary, consultation_info._count as consult_count
  FROM
  (
    select salary, employee.VAT as VAT_doctor
    from employee
    inner join doctor on doctor.VAT = employee.VAT
    inner join permanent_doctor on permanent_doctor.VAT = employee.VAT
    where permanent_doctor.years > number_years
    group by employee.VAT
  ) as info_doctor,
  (
    select count(consultation.VAT_doctor) as _count, employee.VAT as VAT_doctor
    from employee
    inner join doctor on doctor.VAT = employee.VAT
    inner join permanent_doctor on permanent_doctor.VAT = employee.VAT
    inner join consultation on consultation.VAT_doctor = employee.VAT
    where permanent_doctor.years > number_years
    and year(consultation.date_timestamp) = year(curdate())
    group by employee.VAT
  ) as consultation_info
  WHERE info_doctor.VAT_doctor = consultation_info.VAT_doctor
) as update_info
SET employee.salary = 1.10 * employee.salary
WHERE employee.VAT = update_info.doctor_VAT
AND update_info.consult_count > 100;

UPDATE employee,
( SELECT info_doctor.VAT_doctor as doctor_VAT, info_doctor.salary, consultation_info._count as consult_count
  FROM
  (
    select salary, employee.VAT as VAT_doctor
    from employee
    inner join doctor on doctor.VAT = employee.VAT
    inner join permanent_doctor on permanent_doctor.VAT = employee.VAT
    where permanent_doctor.years > number_years
    group by employee.VAT
  ) as info_doctor,
  (
    select count(consultation.VAT_doctor) as _count, employee.VAT as VAT_doctor
    from employee
    inner join doctor on doctor.VAT = employee.VAT
    inner join permanent_doctor on permanent_doctor.VAT = employee.VAT
    inner join consultation on consultation.VAT_doctor = employee.VAT
    where permanent_doctor.years > number_years
    and year(consultation.date_timestamp) = year(curdate())
    group by employee.VAT
  ) as consultation_info
  WHERE info_doctor.VAT_doctor = consultation_info.VAT_doctor
) as update_info
SET employee.salary = 1.05 * employee.salary
WHERE employee.VAT = update_info.doctor_VAT
AND update_info.consult_count <= 100;

END $$
DELIMITER ;

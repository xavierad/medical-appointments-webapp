delimiter $$
create function no_shows(_gender char(1), _year char(4), lower_age integer, upper_age integer)
returns integer
begin
	declare n_app, n_con integer;

	SELECT count(A.VAT_client) into n_app
	FROM appointment A, client C
	WHERE C.VAT = A.VAT_client
	AND C.gender = _gender
	AND A.date_timestamp LIKE CONCAT(_year, '%')
	AND C.age BETWEEN lower_age AND upper_age;

	SELECT count(CO.VAT_doctor) into n_con
	FROM consultation CO, appointment A, client CL
	WHERE CO.VAT_doctor = A.VAT_doctor
	AND CO.date_timestamp = A.date_timestamp
	AND A.VAT_client = CL.VAT
	AND CL.gender = _gender
	AND CO.date_timestamp LIKE CONCAT(_year, '%')
	AND CL.age BETWEEN lower_age AND upper_age;

	return (n_app-n_con);
end$$
delimiter ;

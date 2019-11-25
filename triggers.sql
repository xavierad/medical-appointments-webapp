/* 1-
Write a trigger to update the age of the clients according to the birth date
and the current date. The trigger should fire whenever a new appointment
for a client is inserted into the database.
*/

-- for each new client

-- for each existing client
set GLOBAL event_scheduler = on;
create event update_age
  on schedule every 1 day
  starts current_timestamp
  do
    update client set age = age + 1 where date("Y-m-d")=client.birth_date;

create procedure users_get(
    xAvailable bit
)
BEGIN
	select
		`users`.`id`, 
		`users`.`name`, 
		`users`.`address`
	from 
		`users`
	where 
		`users`.`available` = xAvailable;
END;
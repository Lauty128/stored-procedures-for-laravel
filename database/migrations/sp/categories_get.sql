create procedure categories_get()
BEGIN
	select
		*
	from 
		`categories`;
END;
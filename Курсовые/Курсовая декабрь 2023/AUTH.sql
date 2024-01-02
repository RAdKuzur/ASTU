
CREATE PROCEDURE Auth2
    @param1 NVARCHAR(50),
    @param2 NVARCHAR(50)
AS
BEGIN
    SELECT *
    FROM Users
    WHERE login = @param1 AND password = @param2
END
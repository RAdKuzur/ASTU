CREATE PROCEDURE INSERT_USER
     @name            NVARCHAR (50) ,
     @surname         NVARCHAR (50) ,
     @login           NVARCHAR (50) ,
     @password        NVARCHAR (50) ,
     @role            INT 
AS
BEGIN
   INSERT INTO Users ([login], [password], [name], [surname], [role]) 
              VALUES (@login, @password, @name, @surname, @role)
END
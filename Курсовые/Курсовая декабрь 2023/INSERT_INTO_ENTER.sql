CREATE PROCEDURE INSERT_ENTER 
     @Document_number NVARCHAR (50) ,
     @Register_Date   DATE,         
     @Id_Type         INT,            
     @Id_status       INT,            
     @Date_get_post   DATE,           
     @Id_Client       INT,            
     @Corr_type       NVARCHAR (50) ,            
     @Description     NVARCHAR (MAX), 
     @Id_User         INT,
     @Copy            NVARCHAR (50) 
AS
BEGIN
   INSERT INTO TableDocument (Document_number, Register_Date, Id_Type, Id_status, Date_get_post , Id_Client, Corr_type, [Description], Id_User, [Copy]) 
                      VALUES (@Document_number, @Register_Date, @Id_Type, @Id_status, @Date_get_post , @Id_Client,@Corr_type, @Description, @Id_User, @Copy)
END
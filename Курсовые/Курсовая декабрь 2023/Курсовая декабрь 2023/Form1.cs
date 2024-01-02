using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Курсовая_декабрь_2023
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {


            
            string connectionString = "Data Source=(localdb)\\mssqllocaldb;Initial Catalog=BaseDocument;Integrated Security=True;Pooling=False";
            int userId = 0;
            int role = 2;
            // Создание подключения
            SqlConnection connection = new SqlConnection(connectionString);
            string param1 = textBox1.Text;
            string param2 = textBox2.Text;
            connection.Open();
          
          
            using (SqlConnection connection1 = new SqlConnection(connectionString))
            {
                SqlCommand command1 = new SqlCommand("Auth2", connection1);
                command1.CommandType = CommandType.StoredProcedure;
                command1.Parameters.Add(new SqlParameter("@param1", SqlDbType.NVarChar, 50)).Value = param1;
                command1.Parameters.Add(new SqlParameter("@param2", SqlDbType.NVarChar, 50)).Value = param2;

                connection1.Open();

                using (SqlDataReader reader1 = command1.ExecuteReader())
                { 
                    while (reader1.Read())
                    {
                        // Получение данных из результата запроса
                        // Например:
                        userId = reader1.GetInt32(0);
                        string login = reader1.GetString(1);
                        string password = reader1.GetString(2);
                        string name = reader1.GetString(3);
                        string surname = reader1.GetString(4);
                        role = reader1.GetInt32(5);
                        // и т.д.
                    } 
                    if (userId != 0)
                    {
                        Var.admin = role;
                        Var.id = userId;
                        Form2 newForm = new Form2();
                        newForm.Show();
                        this.Hide();
                    }
                    else
                    {
                        MessageBox.Show("Неправильный логин и/или пароль");
                    }

                    connection.Close();
                }
                connection1.Close();
            }
            


            // SqlCommand command = new SqlCommand($"SELECT * FROM Users WHERE login = '{textBox1.Text}' AND password = '{textBox2.Text}'", connection); 
           

        }
    }
}

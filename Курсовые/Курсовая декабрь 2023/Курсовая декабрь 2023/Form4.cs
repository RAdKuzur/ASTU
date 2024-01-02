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
using static System.Windows.Forms.VisualStyles.VisualStyleElement;

namespace Курсовая_декабрь_2023
{
    public partial class Form4 : Form
    {
        public Form4()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
          
        }

        private void button2_Click(object sender, EventArgs e)
        {
        }

        private void button1_Click_1(object sender, EventArgs e)
        {
            if (textBox1.Text == "" || textBox2.Text == "" || textBox3.Text == "" ||  textBox4.Text == "" || comboBox1.Text == "")
            {
                MessageBox.Show("Заполнены не все поля");
            }
            else {
                string name = textBox1.Text;
                string surname = textBox2.Text;
                string login = textBox3.Text;
                string password = textBox4.Text;
                string role_string = comboBox1.Text;
                int role = -1;
                if (role_string == "Стажёр")
                {
                    role = 0;
                }
                if (role_string == "Администратор")
                {
                    role = 1;
                }
                if (role_string == "Сотрудник")
                {
                    role = 2;
                }

                string connectionString = "Data Source=(localdb)\\mssqllocaldb;Initial Catalog=BaseDocument;Integrated Security=True;Pooling=False";
                using (SqlConnection connection1 = new SqlConnection(connectionString))
                {
                    SqlCommand command1 = new SqlCommand("INSERT_USER", connection1);
                    connection1.Open();
                    command1.CommandType = CommandType.StoredProcedure;
                    command1.Parameters.Add(new SqlParameter("@name", SqlDbType.NVarChar, 50)).Value = name;
                    command1.Parameters.Add(new SqlParameter("@surname", SqlDbType.NVarChar, 50)).Value = surname;
                    command1.Parameters.Add(new SqlParameter("@login", SqlDbType.NVarChar, 50)).Value = login;
                    command1.Parameters.Add(new SqlParameter("@password", SqlDbType.NVarChar, 50)).Value = password;
                    command1.Parameters.Add(new SqlParameter("@role", SqlDbType.Int)).Value = role;
                    command1.ExecuteNonQuery();

                    connection1.Close();
                    MessageBox.Show("Пользователь добавлен в систему");
                }
            }
        }

        private void button2_Click_1(object sender, EventArgs e)
        {
            this.Hide();
        }
    }
}

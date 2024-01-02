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
    public partial class Form3 : Form
    {
        public Form3()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            int id = 0;
            string connectionString = "Data Source=(localdb)\\mssqllocaldb;Initial Catalog=BaseDocument;Integrated Security=True;Pooling=False";
            // Создание подключения
            SqlConnection connection = new SqlConnection(connectionString);
            connection.Open();
            if (dateTimePicker1.Value.Date <= dateTimePicker2.Value.Date) {
                if (textBox1.Text !="" && comboBox1.Text != "" && textBox2.Text != "" && comboBox2.Text != "" && comboBox3.Text != "" && comboBox4.Text != "") {
                    //запись в переменные
                    string type_corr = comboBox1.Text;
                    string number = textBox1.Text;
                    string date1 = dateTimePicker1.Value.Year.ToString() + "-" + dateTimePicker1.Value.Month.ToString() + "-" + dateTimePicker1.Value.Day.ToString();
                    string send = textBox2.Text;
                    string type_doc = comboBox2.Text;
                    string status_copy = comboBox3.Text;                
                    string date2 = dateTimePicker2.Value.Year.ToString() + "-" + dateTimePicker2.Value.Month.ToString() + "-" + dateTimePicker2.Value.Day.ToString();
                    string status_secret = comboBox4.Text;
                    string description = textBox4.Text;
                    int id_secret = 0;
                    if(status_secret == "Общедоступно")
                    {
                        id_secret = 1;
                    }
                    if (status_secret == "Секретно")
                    {
                        id_secret = 2;
                    }
                    if (status_secret == "Совершенно секретно")
                    {
                        id_secret = 3;
                    }
                    if (status_secret == "Особой важности")
                    {
                        id_secret = 4;
                    }
                    //проверка на тип документа
                    SqlCommand command = new SqlCommand($"SELECT * FROM TypeDocument WHERE name = N'{type_doc}'", connection);
                    using (SqlDataReader reader = command.ExecuteReader())
                    {
                        int i = 0;
                        while (reader.Read())
                        {
                           id = reader.GetInt32(0);
                        }
                        reader.Close();
                        if (id != 0)
                        {
                            // Работа с БД клиентов и 
                            int id_type_doc = id;
                            SqlCommand command1 = new SqlCommand($"SELECT * FROM Client WHERE name_client = N'{send}'", connection);
                            using (SqlDataReader reader1 = command1.ExecuteReader())
                            {
                                id = 0;
                                while (reader1.Read())
                                {
                                    id = reader1.GetInt32(0);
                                }
                                reader1.Close();
                                if (id != 0)
                                {
                                    int id_client = id;
                                    if (Var.admin == 0 && status_secret != "Общедоступно")
                                    {
                                        MessageBox.Show("У вашей учётной записи недостаточно прав для добавления/просмотра секретной информации в БД");
                                    }
                                    else
                                    {



                                        //Процедура вноса в БД 
                                        using (SqlConnection connectionEnter = new SqlConnection(connectionString))
                                        {

                                            
                                            SqlCommand commandEnter = new SqlCommand("INSERT_ENTER", connectionEnter);
                                            connectionEnter.Open();
                                            commandEnter.CommandType = CommandType.StoredProcedure;


                                            //параметры процедуры
                                            commandEnter.Parameters.Add(new SqlParameter("@Document_number", SqlDbType.NVarChar, 50)).Value = number;
                                            commandEnter.Parameters.Add(new SqlParameter("@Register_Date", SqlDbType.Date)).Value = date1;
                                            commandEnter.Parameters.Add(new SqlParameter("@Id_Type", SqlDbType.Int)).Value = Convert.ToInt32(id_type_doc);
                                            commandEnter.Parameters.Add(new SqlParameter("@Id_status", SqlDbType.Int)).Value = Convert.ToInt32(id_secret);
                                            commandEnter.Parameters.Add(new SqlParameter("@Date_get_post", SqlDbType.Date)).Value = date2;
                                            commandEnter.Parameters.Add(new SqlParameter("@Id_Client", SqlDbType.Int)).Value = Convert.ToInt32(id_client);
                                            commandEnter.Parameters.Add(new SqlParameter("@Corr_type", SqlDbType.NVarChar, 50)).Value = (type_corr);
                                            commandEnter.Parameters.Add(new SqlParameter("@Description", SqlDbType.NVarChar, 50)).Value = description;
                                            commandEnter.Parameters.Add(new SqlParameter("@Id_User", SqlDbType.Int)).Value = Var.id;
                                            commandEnter.Parameters.Add(new SqlParameter("@Copy", SqlDbType.NVarChar, 50)).Value = status_copy;
                                            commandEnter.ExecuteNonQuery();
                                            



                                            connectionEnter.Close();
                                            MessageBox.Show("Добавлена запись в БД");                                        }
                                            /*
                                             * 
                                             * 
                                             * Здесь должна быть процедура INSERT_ENTER
                                             * 
                                             * 
                                             */
                                            //MessageBox.Show("Cool");
                                        }
                                }
                                else
                                {

                                    //добавление нового клиента
                                    SqlCommand command2 = new SqlCommand($"INSERT INTO Client (name_client) VALUES (N'{send}')", connection);
                                    command2.ExecuteNonQuery();
                                    MessageBox.Show("Подобного типа клиента в БД не существует. Он будет добавлен в БД автоматически.Попробуйте добавить документ заново");
                                }
                            }
                        }
                        else
                        {
                            MessageBox.Show("Подобного типа документа не существует. Для добавления обратитесь к администратору.");
                        }

                    }
                }
                else
                {
                    MessageBox.Show("Заполнены не все поля!!!");
                }
            }
            else
            {
                MessageBox.Show("Неправильный формат даты!!!");
            }
            connection.Close();
        }

        private void label14_Click(object sender, EventArgs e)
        {

        }

        private void textBox4_TextChanged(object sender, EventArgs e)
        {

        }

        private void tabPage4_Click(object sender, EventArgs e)
        {

        }

        private void label14_Click_1(object sender, EventArgs e)
        {

        }

        private void button6_Click(object sender, EventArgs e)
        {
            this.Hide();
        }

        private void button7_Click(object sender, EventArgs e)
        {
            this.Hide();
        }

        private void button5_Click(object sender, EventArgs e)
        {
            this.Hide();
        }

        private void button8_Click(object sender, EventArgs e)
        {
            this.Hide();
        }

        private void button9_Click(object sender, EventArgs e)
        {
            if (Var.admin == 1)
            {
                Form4 newForm = new Form4();
                newForm.Show();
            }
            else
            {
                MessageBox.Show("У вас нет прав администратора");
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            int id = 0;
            string connectionString = "Data Source=(localdb)\\mssqllocaldb;Initial Catalog=BaseDocument;Integrated Security=True;Pooling=False";
            // Создание подключения
            SqlConnection connection = new SqlConnection(connectionString);
            connection.Open();
            if (dateTimePicker4.Value.Date <= dateTimePicker3.Value.Date)
            {
                try
                {
                    if (textBox7.Text != "" && comboBox5.Text != "" && textBox8.Text != "" && comboBox8.Text != "" && comboBox7.Text != "" && comboBox6.Text != "")
                    {
                        //запись в переменные
                        string type_corr = comboBox5.Text;
                        string number = textBox7.Text;
                        string date1 = dateTimePicker4.Value.Year.ToString() + "-" + dateTimePicker4.Value.Month.ToString() + "-" + dateTimePicker4.Value.Day.ToString();
                        string send = textBox8.Text;
                        string type_doc = comboBox8.Text;
                        string status_copy = comboBox7.Text;
                        string date2 = dateTimePicker3.Value.Year.ToString() + "-" + dateTimePicker3.Value.Month.ToString() + "-" + dateTimePicker3.Value.Day.ToString();
                        string status_secret = comboBox6.Text;
                        string description = textBox5.Text;
                        int id_secret = 0;
                        if (status_secret == "Общедоступно")
                        {
                            id_secret = 1;
                        }
                        if (status_secret == "Секретно")
                        {
                            id_secret = 2;
                        }
                        if (status_secret == "Совершенно секретно")
                        {
                            id_secret = 3;
                        }
                        if (status_secret == "Особой важности")
                        {
                            id_secret = 4;
                        }
                        //проверка на тип документа
                        SqlCommand command = new SqlCommand($"SELECT * FROM TypeDocument WHERE name = N'{type_doc}'", connection);
                        using (SqlDataReader reader = command.ExecuteReader())
                        {
                            int i = 0;
                            while (reader.Read())
                            {
                                id = reader.GetInt32(0);
                            }
                            reader.Close();
                            if (id != 0)
                            {
                                // Работа с БД клиентов и 
                                int id_type_doc = id;
                                SqlCommand command1 = new SqlCommand($"SELECT * FROM Client WHERE name_client = N'{send}'", connection);
                                using (SqlDataReader reader1 = command1.ExecuteReader())
                                {
                                    id = 0;
                                    while (reader1.Read())
                                    {
                                        id = reader1.GetInt32(0);
                                    }
                                    reader1.Close();
                                    if (id != 0)
                                    {
                                        int id_client = id;
                                        if (Var.admin == 0 && status_secret != "Общедоступно")
                                        {
                                            MessageBox.Show("У вашей учётной записи недостаточно прав для добавления/просмотра секретной информации в БД");
                                        }
                                        else
                                        {


                                            using (SqlConnection connectionEnter = new SqlConnection(connectionString))
                                            {


                                                SqlCommand commandEnter = new SqlCommand("INSERT_ENTER", connectionEnter);
                                                connectionEnter.Open();
                                                commandEnter.CommandType = CommandType.StoredProcedure;


                                                //параметры процедуры
                                                commandEnter.Parameters.Add(new SqlParameter("@Document_number", SqlDbType.NVarChar, 50)).Value = number;
                                                commandEnter.Parameters.Add(new SqlParameter("@Register_Date", SqlDbType.Date)).Value = date1;
                                                commandEnter.Parameters.Add(new SqlParameter("@Id_Type", SqlDbType.Int)).Value = Convert.ToInt32(id_type_doc);
                                                commandEnter.Parameters.Add(new SqlParameter("@Id_status", SqlDbType.Int)).Value = Convert.ToInt32(id_secret);
                                                commandEnter.Parameters.Add(new SqlParameter("@Date_get_post", SqlDbType.Date)).Value = date2;
                                                commandEnter.Parameters.Add(new SqlParameter("@Id_Client", SqlDbType.Int)).Value = Convert.ToInt32(id_client);
                                                commandEnter.Parameters.Add(new SqlParameter("@Corr_type", SqlDbType.NVarChar, 50)).Value = (type_corr);
                                                commandEnter.Parameters.Add(new SqlParameter("@Description", SqlDbType.NVarChar, 50)).Value = description;
                                                commandEnter.Parameters.Add(new SqlParameter("@Id_User", SqlDbType.Int)).Value = Var.id;
                                                commandEnter.Parameters.Add(new SqlParameter("@Copy", SqlDbType.NVarChar, 50)).Value = status_copy;
                                                commandEnter.ExecuteNonQuery();



                                                MessageBox.Show("Добавлена запись в БД");
                                                connectionEnter.Close();
                                            }
                                            /*
                                             * 
                                             * 
                                             * Здесь должна быть процедура INSERT_ENTER
                                             * 
                                             * 
                                             */
                                            //MessageBox.Show("Cool");
                                        }
                                    }
                                    else
                                    {
                                        //добавление нового клиента
                                        SqlCommand command2 = new SqlCommand($"INSERT INTO Client (name_client) VALUES (N'{send}')", connection);
                                        command2.ExecuteNonQuery();
                                        MessageBox.Show("Подобного типа клиента в БД не существует. Он будет добавлен в БД автоматически.Попробуйте добавить документ заново");
                                    }
                                }
                            }
                            else
                            {
                                MessageBox.Show("Подобного типа документа не существует. Для добавления обратитесь к администратору.");
                            }

                        }
                    }
                    else
                    {
                        MessageBox.Show("Заполнены не все поля!!!");
                    }
                }
                catch (SqlException ex)
                {
                    MessageBox.Show("Ошибка подключения к базе данных! Обратитесь к администратору");
                }
            }
            else
            {
                MessageBox.Show("Неправильный формат даты!!!");
            }
            connection.Close();
        }

        private void Form3_Load(object sender, EventArgs e)
        {
            string connectionString = "Data Source=(localdb)\\mssqllocaldb;Initial Catalog=BaseDocument;Integrated Security=True;Pooling=False";
            // Создание подключения
            SqlConnection connection = new SqlConnection(connectionString);
            connection.Open();
            SqlCommand command1 = new SqlCommand($"SELECT * FROM Users WHERE Id = {Var.id}", connection);
            using (SqlDataReader reader1 = command1.ExecuteReader())
            {
                while (reader1.Read())
                {
                    // Получение данных из результата запроса
                    // Например:
                    int userId = reader1.GetInt32(0);
                    string login = reader1.GetString(1);
                    string password = reader1.GetString(2);
                    string name = reader1.GetString(3);
                    string surname = reader1.GetString(4);
                    int role = reader1.GetInt32(5);
                    // и т.д.
                    label28.Text = name + surname;
                    label29.Text = label28.Text;
                }
                connection.Close();
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            // Вывод общей информации
            string connectionString = "Data Source=(localdb)\\mssqllocaldb;Initial Catalog=BaseDocument;Integrated Security=True;Pooling=False";
            SqlConnection connection = new SqlConnection(connectionString);
            connection.Open();
            SqlDataAdapter adapter;
            if (Var.admin != 0)
            {
                adapter = new SqlDataAdapter($"SELECT Document_number AS Номер_Документа, Corr_type AS Тип, Copy AS Статус, Register_Date AS Дата_регистрации FROM TableDocument ", connection);
            }
            else
            {
                adapter = new SqlDataAdapter($"SELECT Document_number AS Номер_Документа, Corr_type AS Тип, Copy AS Статус, Register_Date AS Дата_регистрации FROM TableDocument WHERE Id_status = 1 ", connection);
            }
            DataTable table = new DataTable();
            adapter.Fill(table);
            dataGridView1.DataSource = table;
            connection.Close();
        }

        private void button4_Click(object sender, EventArgs e)
        {          
            
            // Вывод информации по фильтрам
            string connectionString = "Data Source=(localdb)\\mssqllocaldb;Initial Catalog=BaseDocument;Integrated Security=True;Pooling=False";
            SqlConnection connection = new SqlConnection(connectionString);
            connection.Open();
            try
            {
                if (dateTimePicker1.Value.Date <= dateTimePicker2.Value.Date)
                {
                    string date1 = dateTimePicker5.Value.Year.ToString() + "-" + dateTimePicker5.Value.Month.ToString() + "-" + dateTimePicker5.Value.Day.ToString();
                    string date2 = dateTimePicker6.Value.Year.ToString() + "-" + dateTimePicker6.Value.Month.ToString() + "-" + dateTimePicker6.Value.Day.ToString();
                    string query = $"SELECT Document_number AS Номер_Документа, Corr_type AS Тип, Copy AS Статус, Register_Date AS Дата_регистрации FROM TableDocument WHERE Date_get_post BETWEEN '{date1}' AND '{date2}'";
                    string status_secret = comboBox10.Text;
                    int id_secret = 0;
                    if (status_secret == "Общедоступно")
                    {
                        id_secret = 1;
                    }
                    if (status_secret == "Секретно")
                    {
                        id_secret = 2;
                    }
                    if (status_secret == "Совершенно секретно")
                    {
                        id_secret = 3;
                    }
                    if (status_secret == "Особой важности")
                    {
                        id_secret = 4;
                    }

                    if (comboBox9.Text != "")
                    {
                        query = query + $"AND Corr_type = N'{comboBox9.Text}'";
                    }
                    if (textBox9.Text != "")
                    {
                        query = query + $"AND Document_number = N'{textBox9.Text}'";
                    }
                    if (Var.admin > 0 || id_secret == 1)
                    {
                        if (comboBox10.Text != "")
                        {
                            query = query + $"AND Id_status = {id_secret}";
                        }
                    }
                    else
                    {
                        query = query + $"AND Id_status = 1";
                        MessageBox.Show("У вас недостаточно прав для просмотра секретных документов. Секретные документы показаны не будут");
                    }

                    SqlDataAdapter adapter = new SqlDataAdapter(query, connection);
                    DataTable table = new DataTable();
                    adapter.Fill(table);
                    dataGridView1.DataSource = table;
                }
            }
            catch (SqlException ex)
            {
                MessageBox.Show("Ошибка подключения к базе данных! Обратитесь к администратору");
            }
             connection.Close();

        }
    }
}

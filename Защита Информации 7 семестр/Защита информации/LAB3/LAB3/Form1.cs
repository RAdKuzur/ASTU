using System.Diagnostics.Eventing.Reader;
using System.Windows.Forms;
namespace LAB3
{
    public partial class Form1 : Form
    {
        private int n; // Количество пользователей
        private int m; // Количество объектов
        private string[,] users; // Матрица пользователей
        private string[,] objects; // Матрица объектов
        private string[,] objects_name;
        int global_index = 0;
        private int[,] access; // Матрица прав доступа
        public Form1()
        {
            InitializeComponent();
            SetupDataGridViews();
        }
        private void Form1_Load(object sender, EventArgs e)
        {
            listBox1.Visible = false;
            richTextBox1.Visible = false;
            button5.Visible = false;
        }
        private void SetupDataGridViews()
        {
            // Настройка DataGridView для пользователей
            dataGridView1.Columns.Add("User", "Пользователь");
            dataGridView1.AllowUserToAddRows = true; // разрешить добавление строк
            // Настройка DataGridView для объектов
            dataGridView2.Columns.Add("Object", "Объект");
            dataGridView2.AllowUserToAddRows = true; // разрешить добавление строк
        }
        private void button1_Click(object sender, EventArgs e)
        {
            // Получаем N и M из DataGridView
            n = dataGridView1.Rows.Count - 1; // количество заполненных строк
            m = dataGridView2.Rows.Count - 1; // количество заполненных строк

            // Инициализация матриц
            users = new string[n, 1];
            objects = new string[m, 1];
            objects_name = new string[m, 1];
            // Заполнение матрицы пользователей
            for (int i = 0; i < n; i++)
            {
                users[i, 0] = dataGridView1.Rows[i].Cells[0].Value?.ToString() ?? string.Empty;
            }
            // Заполнение матрицы объектов
            for (int j = 0; j < m; j++)
            {
                objects[j, 0] = dataGridView2.Rows[j].Cells[0].Value?.ToString() ?? string.Empty;
            }
            for (int i = 0; i < n; i++)
            {
                comboBox1.Items.Add(users[i, 0]);
            }
            for (int i = 0; i < m; i++)
            {
                listBox1.Items.Add(objects[i, 0]);
            }
            MessageBox.Show("Матрицы созданы!", "Информация", MessageBoxButtons.OK, MessageBoxIcon.Information);
            // Чтение прав доступа из DataGridView
            CreateDataGridView(n, m + 1);
        }
        private void CreateDataGridView(int rowCount, int columnCount)
        {
            access = new int[rowCount, columnCount];
            // Очищаем предыдущий DataGridView, если он существует
            dataGridView3.Rows.Clear();
            dataGridView3.Columns.Clear();
            // Создаем колонки
            for (int j = 0; j < columnCount; j++)
            {
                dataGridView3.Columns.Add($"Column{j}", $"Столбец {j + 1}");
            }
            // Создаем строки
            for (int i = 0; i < rowCount; i++)
            {
                dataGridView3.Rows.Add();
            }
            // Устанавливаем возможность редактирования
            dataGridView3.AllowUserToAddRows = false; // Запретить добавление пустой последней строки

        }
        private void button2_Click(object sender, EventArgs e)
        {
            for (int i = 0; i < n; i++)
            {
                for (int j = 0; j < m + 1; j++)
                {
                    access[i, j] = Convert.ToInt32(dataGridView3.Rows[i].Cells[j].Value);
                }
            }
            MessageBox.Show("Матрицы созданы!", "Информация", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }
        private void button3_Click(object sender, EventArgs e)
        {
            string user = "";
            string obj = "";
            int index_user = 0;
            int index_object = 0;
            for (int i = 0; i < n; i++)
            {
                if (comboBox1.Text == users[i, 0])
                {
                    user = users[i, 0];
                    index_user = i;
                }
            }
            for (int i = 0; i < m; i++)
            {
                if (listBox1.SelectedItem == objects[i, 0])
                {
                    obj = objects[i, 0];
                    index_object = i;
                 
                }
            }
            if (access[index_user, 0] == 1)
            {
                if (access[index_user, index_object + 1] == 0)
                {
                    listBox1.Visible = true;
                    richTextBox1.Visible = false;
                    richTextBox1.Enabled = false;
                    button5.Visible = false;
                    richTextBox1.Text = objects_name[index_object, 0];
                    

                }
                else if (access[index_user, index_object + 1] == 1)
                {
                    listBox1.Visible = true;
                    richTextBox1.Visible = true;
                    richTextBox1.Enabled = false;
                    button5.Visible = false;
                    richTextBox1.Text = objects_name[index_object, 0];
                }
                else
                {
                    listBox1.Visible = true;
                    richTextBox1.Visible = true;
                    richTextBox1.Enabled = true;
                    button5.Visible = true;
                    richTextBox1.Text = objects_name[index_object, 0];
                    global_index = index_object;
                }
            }
            else
            {
                listBox1.Visible = false;
                richTextBox1.Visible = false;
                richTextBox1.Enabled = false;
                button5.Visible = false;
                richTextBox1.Text = "BANNED";
            }
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (tabControl1.SelectedTab == tabPage1)
            {
                tabControl1.SelectedTab = tabPage2; // Переключаемся на tabPage2
            }
            else
            {
                tabControl1.SelectedTab = tabPage1; // Переключаемся на tabPage1
            }
        }

        private void button5_Click(object sender, EventArgs e)
        {
            objects_name[global_index, 0] = richTextBox1.Text;
        }
    }
}

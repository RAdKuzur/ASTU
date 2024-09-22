using System.Diagnostics.Eventing.Reader;
using System.Windows.Forms;
namespace LAB3
{
    public partial class Form1 : Form
    {
        private int n; // ���������� �������������
        private int m; // ���������� ��������
        private string[,] users; // ������� �������������
        private string[,] objects; // ������� ��������
        private string[,] objects_name;
        int global_index = 0;
        private int[,] access; // ������� ���� �������
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
            // ��������� DataGridView ��� �������������
            dataGridView1.Columns.Add("User", "������������");
            dataGridView1.AllowUserToAddRows = true; // ��������� ���������� �����
            // ��������� DataGridView ��� ��������
            dataGridView2.Columns.Add("Object", "������");
            dataGridView2.AllowUserToAddRows = true; // ��������� ���������� �����
        }
        private void button1_Click(object sender, EventArgs e)
        {
            // �������� N � M �� DataGridView
            n = dataGridView1.Rows.Count - 1; // ���������� ����������� �����
            m = dataGridView2.Rows.Count - 1; // ���������� ����������� �����

            // ������������� ������
            users = new string[n, 1];
            objects = new string[m, 1];
            objects_name = new string[m, 1];
            // ���������� ������� �������������
            for (int i = 0; i < n; i++)
            {
                users[i, 0] = dataGridView1.Rows[i].Cells[0].Value?.ToString() ?? string.Empty;
            }
            // ���������� ������� ��������
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
            MessageBox.Show("������� �������!", "����������", MessageBoxButtons.OK, MessageBoxIcon.Information);
            // ������ ���� ������� �� DataGridView
            CreateDataGridView(n, m + 1);
        }
        private void CreateDataGridView(int rowCount, int columnCount)
        {
            access = new int[rowCount, columnCount];
            // ������� ���������� DataGridView, ���� �� ����������
            dataGridView3.Rows.Clear();
            dataGridView3.Columns.Clear();
            // ������� �������
            for (int j = 0; j < columnCount; j++)
            {
                dataGridView3.Columns.Add($"Column{j}", $"������� {j + 1}");
            }
            // ������� ������
            for (int i = 0; i < rowCount; i++)
            {
                dataGridView3.Rows.Add();
            }
            // ������������� ����������� ��������������
            dataGridView3.AllowUserToAddRows = false; // ��������� ���������� ������ ��������� ������

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
            MessageBox.Show("������� �������!", "����������", MessageBoxButtons.OK, MessageBoxIcon.Information);
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
                tabControl1.SelectedTab = tabPage2; // ������������� �� tabPage2
            }
            else
            {
                tabControl1.SelectedTab = tabPage1; // ������������� �� tabPage1
            }
        }

        private void button5_Click(object sender, EventArgs e)
        {
            objects_name[global_index, 0] = richTextBox1.Text;
        }
    }
}

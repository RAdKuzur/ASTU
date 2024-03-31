using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using static System.Windows.Forms.VisualStyles.VisualStyleElement;

namespace LAB_7_SADCHIKOV
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            dataGridView1.Dock = DockStyle.Fill;

            // Добавляем DataGridView на форму
            Controls.Add(dataGridView1);

            // Создаем таблицу с двумя столбцами
            dataGridView1.ColumnCount = 4;
            dataGridView1.Columns[0].Name = "Фамилия";
            dataGridView1.Columns[1].Name = "Адрес";
            dataGridView1.Columns[2].Name = "Телефон";
            dataGridView1.Columns[3].Name = "Категория";
            // Добавляем несколько строк в таблицу
            string[] row1 = new string[] { "Иванов", "Улица 1","112","Друг" };
            string[] row2 = new string[] { "Петров", "Улица 2","911","Родственник" };
            string[] row3 = new string[] { "Смирнов", "Улица 3","01","Коллега" };
            dataGridView1.Rows.Add(row1);
            dataGridView1.Rows.Add(row2);
            dataGridView1.Rows.Add(row3);
        }

        private void добавитьToolStripMenuItem_Click(object sender, EventArgs e)
        {
            string filePath = @"C:\Temp\example2.txt";

            // Открываем файл для записи (если файла нет, он будет создан)
            using (FileStream fs = new FileStream(filePath, FileMode.OpenOrCreate, FileAccess.Write))
            {
                // Создаем объект StreamWriter для записи в файл
                using (StreamWriter writer = new StreamWriter(fs))
                {
                    foreach (DataGridViewRow row in dataGridView1.Rows)
                    {
                        if (!row.IsNewRow) // Проверяем, что это не пустая строка для добавления новых данных
                        {
                            string name = row.Cells["Фамилия"].Value.ToString();
                            string address = row.Cells["Адрес"].Value.ToString();
                            string number = row.Cells["Телефон"].Value.ToString();
                            string status = row.Cells["Категория"].Value.ToString();
                            // Делаем что-то с полученными данными, например, выводим их в консоль
                            writer.WriteLine(name);
                            writer.WriteLine(address);
                            writer.WriteLine(number);
                            writer.WriteLine(status);

                        }
                    }
                }

            }
        }
        private void ClearDataGridView()
        {
            // Очищаем данные из DataGridView
            dataGridView1.Rows.Clear();
        }
        private void загрузитьToolStripMenuItem_Click(object sender, EventArgs e)
        {
            ClearDataGridView();
            string filePath = @"C:\Temp\example2.txt";

            if (File.Exists(filePath))
            {
                // Открываем файл для чтения
                using (FileStream fs = new FileStream(filePath, FileMode.Open, FileAccess.Read))
                {
                    // Создаем объект StreamReader для чтения из файла
                    using (StreamReader reader = new StreamReader(fs))
                    {
                        // Считываем и выводим содержимое файла
                        string name;
                        while ((name = reader.ReadLine()) != null)
                        {
                            string address = reader.ReadLine();
                            string number = reader.ReadLine();
                            string status = reader.ReadLine();      
                            string[] row1 = new string[] { name, address , number , status};
                            dataGridView1.Rows.Add(row1);
                        }
                    }
                }
            }
            else
            {

            }
        }
        private void DeleteSelectedRows()
        {
            // Получаем выбранные строки
            foreach (DataGridViewRow row in dataGridView1.SelectedRows)
            {
                if (!row.IsNewRow) // Проверяем, что это не пустая строка для добавления новых данных
                {
                    dataGridView1.Rows.Remove(row); // Удаляем строку из DataGridView
                }
            }
        }
        private void удалитьToolStripMenuItem_Click(object sender, EventArgs e)
        {
            DeleteSelectedRows();
        }
        private void SearchInDataGridView(string searchText)
        {
            // Проходим по всем строкам и ячейкам в DataGridView
            foreach (DataGridViewRow row in dataGridView1.Rows)
            {
                foreach (DataGridViewCell cell in row.Cells)
                {
                    if (cell.Value != null && cell.Value.ToString().Contains(searchText))
                    {
                        // Нашли совпадение - выделяем строку и выходим из циклов
                        cell.Selected = true;
                        dataGridView1.CurrentCell = cell;
                        return;
                    }
                }
            }

            // Если ничего не найдено, очищаем выделение
            dataGridView1.ClearSelection();
        }
   
        private void поискToolStripMenuItem_Click(object sender, EventArgs e)
        {

            Form3 searchForm = new Form3();
            searchForm.SearchByLastNameEvent += SearchByLastNameInTable;
            searchForm.Show();
        }

        private void выходToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void добавитьToolStripMenuItem1_Click(object sender, EventArgs e)
        {
            Form2 addRecordForm = new Form2();
            addRecordForm.AddRecordEvent += AddRecordToTable;
            addRecordForm.Show();
        }
        private void AddRecordToTable(Record record)
        {
          
            string[] row1 = new string[] { record.LastName, record.Address, record.PhoneNumber, record.Status };
            dataGridView1.Rows.Add(row1);
        }
   
        private void SearchByLastNameInTable(string lastName)
        {
            // Предположим, что dataGridView1 - это ваш DataGridView
            foreach (DataGridViewRow row in dataGridView1.Rows)
            {
                if (row.Cells["Фамилия"].Value != null && row.Cells["Фамилия"].Value.ToString().Equals(lastName, StringComparison.OrdinalIgnoreCase))
                {
                    // Нашли совпадение по фамилии - выделяем строку
                    dataGridView1.CurrentCell = row.Cells["Фамилия"];
                    dataGridView1.Rows[row.Index].Selected = true;
                    dataGridView1.FirstDisplayedScrollingRowIndex = row.Index;
                    return;
                }
            }

            // Если фамилия не найдена, выводим сообщение
            MessageBox.Show("Фамилия не найдена.", "Поиск по фамилии", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }
    }
}

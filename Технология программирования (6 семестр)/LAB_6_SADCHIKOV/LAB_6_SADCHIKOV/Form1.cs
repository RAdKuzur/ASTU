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

namespace LAB_6_SADCHIKOV
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        private void файлToolStripMenuItem_Click(object sender, EventArgs e)
        {

        }
        private void выходToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Close();
        }
        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }
        private void Form1_Load(object sender, EventArgs e)
        {
        
        }
        private void добавитьToolStripMenuItem_Click(object sender, EventArgs e)
        {
            switch (tabControl1.SelectedIndex)
            {
                case 0:
                    {
                        listBox1.Items.Add(textBox1.Text);
                    }
                    break;
                case 1:
                    {
                        listBox2.Items.Add(textBox2.Text);
                    }
                    break;
                case 2:
                    {
                        listBox3.Items.Add(textBox3.Text);
                    }
                    break;
                case 3:
                    {
                        listBox4.Items.Add(textBox4.Text);
                    }
                    break;
                case 4:
                    {
                        listBox5.Items.Add(textBox5.Text);
                    }
                    break;
                case 5:
                    {
                        listBox6.Items.Add(textBox6.Text);
                    }
                    break;
                case 6:
                    {
                        listBox7.Items.Add(textBox7.Text);
                    }
                    break;
                case 7:
                    {
                        listBox8.Items.Add(textBox8.Text);
                    }
                    break;
                case 8:
                    {
                        listBox9.Items.Add(textBox9.Text);
                    }
                    break;
                case 9:
                    {
                        listBox10.Items.Add(textBox10.Text);
                    }
                    break;
                case 10:
                    {
                        listBox11.Items.Add(textBox11.Text);
                    }
                    break;
                case 11:
                    {
                        listBox12.Items.Add(textBox12.Text);
                    }
                    break;

            }
        }
        private void сохранитьToolStripMenuItem_Click(object sender, EventArgs e)
        {
            string filePath = @"C:\Temp\example.txt";

            // Открываем файл для записи (если файла нет, он будет создан)
            using (FileStream fs = new FileStream(filePath, FileMode.OpenOrCreate, FileAccess.Write))
            {
                // Создаем объект StreamWriter для записи в файл
                using (StreamWriter writer = new StreamWriter(fs))
                {
                    // Записываем информацию в файл
                    // writer.WriteLine("Пример текста для записи в файл.");
                    // writer.WriteLine("Дополнительная строка.");
                    for (int i = 0; i < listBox1.Items.Count; i++)
                    {
                        writer.WriteLine("1");
                        writer.WriteLine(listBox1.Items[i]);
                    }

                    for (int i = 0; i < listBox2.Items.Count; i++)
                    {
                        writer.WriteLine("2");
                        writer.WriteLine(listBox2.Items[i]);
                    }

                    for (int i = 0; i < listBox3.Items.Count; i++)
                    {
                        writer.WriteLine("3");
                        writer.WriteLine(listBox3.Items[i]);
                    }

                    for (int i = 0; i < listBox4.Items.Count; i++)
                    {
                        writer.WriteLine("4");
                        writer.WriteLine(listBox4.Items[i]);
                    }

                    for (int i = 0; i < listBox5.Items.Count; i++)
                    {
                        writer.WriteLine("5");
                        writer.WriteLine(listBox5.Items[i]);
                    }

                    for (int i = 0; i < listBox6.Items.Count; i++)
                    {
                        writer.WriteLine("6");
                        writer.WriteLine(listBox6.Items[i]);
                    }

                    for (int i = 0; i < listBox7.Items.Count; i++)
                    {
                        writer.WriteLine("7");
                        writer.WriteLine(listBox7.Items[i]);
                    }

                    for (int i = 0; i < listBox8.Items.Count; i++)
                    {
                        writer.WriteLine("8");
                        writer.WriteLine(listBox8.Items[i]);
                    }

                    for (int i = 0; i < listBox9.Items.Count; i++)
                    {
                        writer.WriteLine("9");
                        writer.WriteLine(listBox9.Items[i]);
                    }

                    for (int i = 0; i < listBox10.Items.Count; i++)
                    {
                        writer.WriteLine("10");
                        writer.WriteLine(listBox10.Items[i]);
                    }

                    for (int i = 0; i < listBox11.Items.Count; i++)
                    {
                        writer.WriteLine("11");
                        writer.WriteLine(listBox11.Items[i]);
                    }

                    for (int i = 0; i < listBox12.Items.Count; i++)
                    {
                        writer.WriteLine("12");
                        writer.WriteLine(listBox12.Items[i]);
                    }
                }

            }
        }
        private void загрузитьToolStripMenuItem_Click(object sender, EventArgs e)
        {
            listBox1.Items.Clear();
            listBox2.Items.Clear();
            listBox3.Items.Clear();
            listBox4.Items.Clear();
            listBox5.Items.Clear();
            listBox6.Items.Clear();
            listBox7.Items.Clear();
            listBox8.Items.Clear();
            listBox9.Items.Clear();
            listBox10.Items.Clear();
            listBox11.Items.Clear();
            listBox12.Items.Clear();
            string filePath = @"C:\Temp\example.txt";

            if (File.Exists(filePath))
            {
                // Открываем файл для чтения
                using (FileStream fs = new FileStream(filePath, FileMode.Open, FileAccess.Read))
                {
                    // Создаем объект StreamReader для чтения из файла
                    using (StreamReader reader = new StreamReader(fs))
                    {
                        // Считываем и выводим содержимое файла
                        string line;
                        while ((line = reader.ReadLine()) != null)
                        {
                            string line_2 = reader.ReadLine();
                            switch (line)
                            {

                                case "1":
                                    {
                                        listBox1.Items.Add(line_2);
                                    }
                                    break;
                                case "2":
                                    {
                                        listBox2.Items.Add(line_2);
                                    }
                                    break;
                                case "3":
                                    {
                                        listBox3.Items.Add(line_2);
                                    }
                                    break;
                                case "4":
                                    {
                                        listBox4.Items.Add(line_2);
                                    }
                                    break;
                                case "5":
                                    {
                                        listBox5.Items.Add(line_2);
                                    }
                                    break;
                                case "6":
                                    {
                                        listBox6.Items.Add(line_2);
                                    }
                                    break;
                                case "7":
                                    {
                                        listBox7.Items.Add(line_2);
                                    }
                                    break;
                                case "8":
                                    {
                                        listBox8.Items.Add(line_2);
                                    }
                                    break;
                                case "9":
                                    {
                                        listBox9.Items.Add(line_2);
                                    }
                                    break;
                                case "10":
                                    {
                                        listBox10.Items.Add(line_2);
                                    }
                                    break;
                                case "11":
                                    {
                                        listBox11.Items.Add(line_2);
                                    }
                                    break;
                                case "12":
                                    {
                                        listBox12.Items.Add(line_2);
                                    }
                                    break;















                            }
                        }
                    }
                }
            }
            else
            {
                
            }
        }
        private void удалитьToolStripMenuItem1_Click(object sender, EventArgs e)
        {
            listBox1.Items.Clear();
            listBox2.Items.Clear();
            listBox3.Items.Clear();
            listBox4.Items.Clear();
            listBox5.Items.Clear();
            listBox6.Items.Clear();
            listBox7.Items.Clear();
            listBox8.Items.Clear();
            listBox9.Items.Clear();
            listBox10.Items.Clear();
            listBox11.Items.Clear();
            listBox12.Items.Clear();
        }

        private void изменитьToolStripMenuItem_Click(object sender, EventArgs e)
        {
            switch (tabControl1.SelectedIndex)
            {
                case 0:
                    {
                        listBox1.Items.RemoveAt(listBox1.SelectedIndex);
                        listBox1.Items.Add(textBox1.Text);
                    }
                    break;
                case 1:
                    {
                        listBox2.Items.RemoveAt(listBox2.SelectedIndex);
                        listBox2.Items.Add(textBox2.Text);
                    }
                    break;
                case 2:
                    {
                        listBox3.Items.RemoveAt(listBox3.SelectedIndex);
                        listBox3.Items.Add(textBox3.Text);
                    }
                    break;
                case 3:
                    {
                        listBox4.Items.RemoveAt(listBox4.SelectedIndex);
                        listBox4.Items.Add(textBox4.Text);
                    }
                    break;
                case 4:
                    {
                        listBox5.Items.RemoveAt(listBox5.SelectedIndex);
                        listBox5.Items.Add(textBox5.Text);
                    }
                    break;
                case 5:
                    {
                        listBox6.Items.RemoveAt(listBox6.SelectedIndex);
                        listBox6.Items.Add(textBox6.Text);
                    }
                    break;
                case 6:
                    {
                        listBox7.Items.RemoveAt(listBox7.SelectedIndex);
                        listBox7.Items.Add(textBox7.Text);
                    }
                    break;
                case 7:
                    {
                        listBox8.Items.RemoveAt(listBox8.SelectedIndex);
                        listBox8.Items.Add(textBox8.Text);
                    }
                    break;
                case 8:
                    {
                        listBox9.Items.RemoveAt(listBox9.SelectedIndex);
                        listBox9.Items.Add(textBox9.Text);
                    }
                    break;
                case 9:
                    {
                        listBox10.Items.RemoveAt(listBox10.SelectedIndex);
                        listBox10.Items.Add(textBox10.Text);
                    }
                    break;
                case 10:
                    {
                        listBox11.Items.RemoveAt(listBox11.SelectedIndex);
                        listBox11.Items.Add(textBox11.Text);
                    }
                    break;
                case 11:
                    {
                        listBox12.Items.RemoveAt(listBox12.SelectedIndex);
                        listBox12.Items.Add(textBox12.Text);
                    }
                    break;

            }
        }
        private void справкаToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("Разработчик:Радмир Программа выпущена в 2024 году");
        }
    }
}

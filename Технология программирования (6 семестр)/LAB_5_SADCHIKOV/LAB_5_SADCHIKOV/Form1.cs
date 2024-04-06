using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace LAB_5_SADCHIKOV
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            textBox1.Text = listBox1.Items.Count.ToString();
            textBox2.Text = listBox2.Items.Count.ToString();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            listBox1.Items.AddRange(listBox2.Items);
            listBox2.Items.Clear();
            textBox1.Text = listBox1.Items.Count.ToString();
            textBox2.Text = listBox2.Items.Count.ToString();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            listBox2.Items.AddRange(listBox1.Items);
            listBox1.Items.Clear();
            textBox1.Text = listBox1.Items.Count.ToString();
            textBox2.Text = listBox2.Items.Count.ToString();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if(listBox2.SelectedIndex != -1)
            {
                listBox1.Items.Add(listBox2.Items[listBox2.SelectedIndex]);
                listBox2.Items.RemoveAt(listBox2.SelectedIndex);
            }
            textBox1.Text = listBox1.Items.Count.ToString();
            textBox2.Text = listBox2.Items.Count.ToString();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (listBox1.SelectedIndex != -1)
            {
                listBox2.Items.Add(listBox1.Items[listBox1.SelectedIndex]);
                listBox1.Items.RemoveAt(listBox1.SelectedIndex);
            }
            textBox1.Text = listBox1.Items.Count.ToString();
            textBox2.Text = listBox2.Items.Count.ToString();
        }
    }
}

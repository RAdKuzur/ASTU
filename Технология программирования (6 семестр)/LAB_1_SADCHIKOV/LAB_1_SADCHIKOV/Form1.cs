using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace LAB_1_SADCHIKOV
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button11_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                textBox2.Text = textBox2.Text + "0";



            }
            else
            {
                textBox1.Text = textBox1.Text + "0";
            }
        }

        private void button13_Click(object sender, EventArgs e)
        {
            Var.flag = 1;
            label1.Text = "+";

        }

        private void button14_Click(object sender, EventArgs e)
        {
            Var.flag = 1;
            label1.Text = "-";
        }

        private void button15_Click(object sender, EventArgs e)
        {
            Var.flag = 1;
            label1.Text = "/";
        }

        private void button16_Click(object sender, EventArgs e)
        {
            Var.flag = 1;
            label1.Text = "*";
        }

        private void button12_Click(object sender, EventArgs e)
        {
            textBox1.Text = "";
            textBox2.Text = "";
            textBox3.Text = "";
            label1.Text = "";
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if(Var.flag == 1) {
                textBox2.Text = textBox2.Text + "1";



            }
            else
            {
                textBox1.Text = textBox1.Text + "1";
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                textBox2.Text = textBox2.Text + "2";



            }
            else
            {
                textBox1.Text = textBox1.Text + "2";
            }
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                textBox2.Text = textBox2.Text + "3";



            }
            else
            {
                textBox1.Text = textBox1.Text + "3";
            }
        }

        private void button5_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                textBox2.Text = textBox2.Text + "4";



            }
            else
            {
                textBox1.Text = textBox1.Text + "4";
            }
        }

        private void button6_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                textBox2.Text = textBox2.Text + "5";



            }
            else
            {
                textBox1.Text = textBox1.Text + "5";
            }
        }

        private void button7_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                textBox2.Text = textBox2.Text + "6";



            }
            else
            {
                textBox1.Text = textBox1.Text + "6";
            }
        }

        private void button8_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                textBox2.Text = textBox2.Text + "7";



            }
            else
            {
                textBox1.Text = textBox1.Text + "7";
            }
        }

        private void button9_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                textBox2.Text = textBox2.Text + "8";



            }
            else
            {
                textBox1.Text = textBox1.Text + "8";
            }
        }

        private void button10_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                textBox2.Text = textBox2.Text + "9";



            }
            else
            {
                textBox1.Text = textBox1.Text + "9";
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Var.flag = 0;
            double a = Convert.ToDouble(textBox1.Text);
            double b = Convert.ToDouble(textBox2.Text);
            double c = 0;
            if (label1.Text == "*")
            {
                c = a * b;
            }
            if (label1.Text == "/")
            {
                if (b == 0)
                {
                    MessageBox.Show("Делить на 0 нельзя");
                }
                else
                {
                    c = a / b;
                }
            }
            if (label1.Text == "-")
            {
                c = a - b;
            }

            if (label1.Text == "+")
            {
                c = a + b;
            }
            if (label1.Text == "sqr")
            {
                c = Math.Pow(a,b);
            }
            if (label1.Text == "*")
            {
                double d = 1 / b;
                c = Math.Pow(a, d);
            }
            textBox3.Text = c.ToString();
        }

        private void button18_Click(object sender, EventArgs e)
        {
  
            if (Var.flag == 1)
            {
                if (textBox2.Text[0] == '-')
                {
                    textBox2.Text = textBox2.Text.Replace("-", "");
                }
                else
                {
                    textBox2.Text = "-" + textBox2.Text;

                }


            }
            else
            {
                if (textBox1.Text[0] == '-')
                {
                    textBox1.Text = textBox1.Text.Replace("-","");
                }
                else
                {
                    textBox1.Text = "-" + textBox1.Text;

                }
            }
        }

        private void button17_Click(object sender, EventArgs e)
        {
            if (Var.flag == 1)
            {
                if (textBox2.Text.Contains(","))
                {

                }
                else
                {
                    textBox2.Text = textBox2.Text + ",";
                }


            }
            else
            {
                if (textBox1.Text.Contains(","))
                {

                }
                else
                {
                    textBox1.Text = textBox1.Text + ",";
                }
               
            }
        }

        private void button19_Click(object sender, EventArgs e)
        {
            label1.Text = "sqr";
            Var.flag = 1;
        }

        private void button20_Click(object sender, EventArgs e)
        {
            label1.Text = "sqrt";

            Var.flag = 1;
            double a = Math.Sqrt(Convert.ToDouble(textBox1.Text));
            textBox3.Text = a.ToString();
            Var.flag = 0;
        }
    }
}

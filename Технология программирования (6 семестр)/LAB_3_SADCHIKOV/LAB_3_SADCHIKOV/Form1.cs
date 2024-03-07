using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Reflection.Emit;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace LAB_3_SADCHIKOV
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (checkedListBox2.GetItemChecked(0))
            {
                checkedListBox3.Items.Add(textBox1.Text);
            }
            if (checkedListBox2.GetItemChecked(1))
            {
                checkedListBox4.Items.Add(textBox1.Text);
            }
            textBox1.Text = "";
        }

        private void radioButton1_CheckedChanged(object sender, EventArgs e)
        {

        }
        private void button2_Click(object sender, EventArgs e)
        {
            int counter = 0;
             label2.Text = "";
             for (int i = 0; i < checkedListBox3.Items.Count; i++)
             {
                if (checkedListBox3.GetItemChecked(i))
                {
                    counter++;
                }
             }
             int k = 0;
             for(int i = 0; i < checkedListBox3.Items.Count; i++)
             {
                if (checkedListBox3.GetItemChecked(i))
                {
                    k++;
                    if (i != 0)
                    {
                        if (k != counter)
                            label2.Text = label2.Text + " , " + checkedListBox3.Items[i].ToString();
                        else
                        {
                            label2.Text = label2.Text + " AND " + checkedListBox3.Items[i].ToString();
                        }
                    }
                    else
                    {
                        label2.Text = checkedListBox3.Items[i].ToString();
                    }
                }
             }



            if (counter > 1)
                {
                label2.Text = label2.Text + " ARE ";
                }
             else
             {
                label2.Text = label2.Text + " IS ";
            }
            if (checkedListBox1.GetItemChecked(0))
            {
                label2.Text = label2.Text + " " +checkedListBox1.Items[0].ToString();
            }
            if (checkedListBox1.GetItemChecked(1))
            {
                label2.Text = label2.Text + " " + checkedListBox1.Items[1].ToString();
            }
            if (checkedListBox1.GetItemChecked(2))
            {
                label2.Text = label2.Text + " " + checkedListBox1.Items[2].ToString();
            }

            for (int i = 0; i < checkedListBox4.Items.Count; i++)
            {
                if (checkedListBox4.GetItemChecked(i))
                {
                    label2.Text = label2.Text + " " + checkedListBox4.Items[i].ToString();
                }

            }



        }
    }
}

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace LAB_4_SADCHIKOV
{
    public partial class Form1 : Form
    {
        int n = 6;
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {

            string str_variant = comboBox1.Text;
            int variant = 0;
           
            int[] SetA = new int[n];
            int[] SetB = new int[n];
            if (str_variant == "Пересечение")
            {
                variant = 1;
            }
            if (str_variant == "Объединение")
            {
                variant = 2;
            }
            if (str_variant == "Разность")
            {
                variant = 3;
            }
            for (int i = 0; i < n; i++)
            {
                checkedListBox3.SetItemChecked(i, false);
            }
            for (int i = 0; i < n; i++)
            {
                if (checkedListBox1.GetItemChecked(i)) {
                    SetA[i] = 1;
                }
            }
            for(int i = 0; i < n; i++)
            {
                if (checkedListBox2.GetItemChecked(i))
                {
                    SetB[i] = 1;
                }
            }

            if(comboBox1.Text == "Пересечение")
            {
                for (int i = 0; i < n; i++)
                {
                    if (SetA[i] == 1 && SetB[i] == 1)
                    {
                        checkedListBox3.SetItemChecked(i, true);
                    }
                }

            }
            if (comboBox1.Text == "Объединение")
            {
                for (int i = 0; i < n; i++)
                {
                    if (SetA[i] == 1 || SetB[i] == 1)
                    {
                        checkedListBox3.SetItemChecked(i, true);
                    }

                }
            }
            if (comboBox1.Text == "Разность")
            {
                for (int i = 0; i < n; i++)
                {
                    if (SetA[i] == 1 && SetB[i] == 0)
                    {
                        checkedListBox3.SetItemChecked(i, true);
                    }
                }
            }
            int crit1 = 0;
            int crit2 = 0;
            int crit3 = 0;
            for (int i = 0; i < 3; i++)
            {
               checkedListBox5.SetItemChecked(i, false);
            }
            for (int i = 0; i < n; i++)
            {
                if(SetA[i] == SetB[i])
                {
                    crit1++;
                }
                if (SetA[i] == 1 && SetB[i] == 0 || SetA[i] == SetB[i])
                {
                    crit2++;
                }
                if (SetA[i] == 0 && SetB[i] == 1 || SetA[i] == SetB[i])
                {
                    crit3++;
                }
            }
            if ((crit1 == n)) {
                checkedListBox5.SetItemChecked(0, true);
            }
            if ((crit2 == n))
            {
                checkedListBox5.SetItemChecked(2, true);
            }
            if ((crit3 == n))
            {
                checkedListBox5.SetItemChecked(1, true);
            }

        }

        private void button2_Click(object sender, EventArgs e)
        {
            n++;
            Random rnd = new Random();
            int value = rnd.Next(); 
            checkedListBox1.Items.Add(value);
            checkedListBox2.Items.Add(value);
            checkedListBox3.Items.Add(value);
        }
    }
}

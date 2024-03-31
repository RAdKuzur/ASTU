using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace LAB_7_SADCHIKOV
{
    public partial class Form3 : Form
    {
        public Form3()
        {
            InitializeComponent();
        }
        public delegate void SearchByLastNameDelegate(string lastName);
        public event SearchByLastNameDelegate SearchByLastNameEvent;

        private void button1_Click(object sender, EventArgs e)
        {
            string lastName = textBox1.Text;
            SearchByLastNameEvent?.Invoke(lastName);
        }
            
    }
}

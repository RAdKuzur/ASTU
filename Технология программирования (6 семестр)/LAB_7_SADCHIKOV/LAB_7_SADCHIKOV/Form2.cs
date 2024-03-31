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

    public partial class Form2 : Form
    {
        public delegate void AddRecordDelegate(Record record);
        public event AddRecordDelegate AddRecordEvent;
        public Form2()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            string lastName = textBox1.Text;
            string address = textBox3.Text;
            string phoneNumber = textBox2.Text;
            string status =comboBox1.Text;
            Record newRecord = new Record { LastName = lastName, Address = address, PhoneNumber = phoneNumber, Status = status };
            AddRecordEvent?.Invoke(newRecord);
        }
    }
}

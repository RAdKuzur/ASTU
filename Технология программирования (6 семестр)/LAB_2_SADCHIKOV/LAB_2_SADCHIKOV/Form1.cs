using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace LAB_2_SADCHIKOV
{
    public partial class Form1 : Form
    {
        DateTime date;
        public Form1()
        {
            InitializeComponent();
        }
        int flag = 0;
        bool Start = false;
        void StartTime()
        {
            Start = true;
            Stopwath();
        }
        void StopTime() { Start = false; }
        public void Stopwath()
        {
            date = DateTime.Now;
            Timer timer = new Timer();
            timer.Interval = 10;
            timer.Tick += new EventHandler(timer1_Tick);
            timer.Start();
        }
        private void timer1_Tick(object sender, EventArgs e)
        {
            long tick = DateTime.Now.Ticks - date.Ticks;
            DateTime stopWatch = new DateTime();

            stopWatch = stopWatch.AddTicks(tick);
            if (Start) { label1.Text = String.Format("{0:HH:mm:ss:ff}", stopWatch); }

        }

        private void button3_Click(object sender, EventArgs e)
        {
            Start = false;
            label1.Text = "00:00:00:00";
            textBox1.Text = "";
            textBox2.Text = "";
            textBox3.Text = "";
            flag = 0;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            StartTime();
        }

        private void button1_Click(object sender, EventArgs e)
        {

            Start = false;
        }

        private void button1_Click_1(object sender, EventArgs e)
        {
            if (flag == 0) { 
                Start = false;

                textBox1.Text = label1.Text;
                Start = true;
                flag++;
            }
            else if (flag == 1)
            {
                Start = false;

                textBox2.Text = label1.Text;
                Start = true;
                flag++;
            }
            else
            {
                Start = false;

                textBox3.Text = label1.Text;
                Start = true;
                flag++;
            }
        }
    }
}

﻿using System;
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

        private void textBox5_TextChanged(object sender, EventArgs e)
        {

        }

        private void button4_Click(object sender, EventArgs e)
        {
            double len = Convert.ToDouble(textBox4.Text);

            string time = textBox1.Text;
            double time2 = 3600 * 10 * (Convert.ToInt32(textBox1.Text[0])-48) + 3600 * (Convert.ToInt32(textBox1.Text[1])-48) +
                60 * 10 * (Convert.ToInt32(textBox1.Text[3]) - 48) + 60 * (Convert.ToInt32(textBox1.Text[4]) - 48) +
                10 * (Convert.ToInt32(textBox1.Text[6]) - 48) + (Convert.ToInt32(textBox1.Text[7])-48) +
                (10 / 60) * (Convert.ToInt32(textBox1.Text[9]) - 48) + (1 / 60) * (Convert.ToInt32(textBox1.Text[10]) - 48);
            textBox5.Text = Convert.ToString(3.6 * len / time2);

        }

        private void textBox4_TextChanged(object sender, EventArgs e)
        {

        }
    }
}

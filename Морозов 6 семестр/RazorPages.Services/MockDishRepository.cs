using RazorPages.Models;
using System;
using System.CodeDom;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.InteropServices.WindowsRuntime;
using System.Text;
using System.Threading.Tasks;

namespace RazorPages.Services
{
    public class MockDishRepository : IDishRepository
    {
        private List<Dish> _receipts;
        public MockDishRepository() {
            _receipts = new List<Dish>() {
                new Dish()
                {
                    Id = 1,
                    Name = "name"
                } 
            };
        }
        public IEnumerable<Dish> GetAllDish()
        {
            return _receipts;
        }

        public IEnumerable<Receipt> GetAllRece()
        {
            throw new NotImplementedException();
        }
    }
}

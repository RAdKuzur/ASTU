using Lab1.Data;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using static Lab1.Data.DataEntity;

namespace Lab1.Pages
{
    public class DeleteModel : PageModel
    {
     
        private readonly DataClassRepository _db;
        public DeleteModel(DataClassRepository db)
        {
            _db = db;
        }

        public void OnGet()
        {

        }
        public void OnPost(string name, string pieces, string type)
        {
            Dish dish = new Dish()
            {
                Name = name,
  

            };
            _db.Remove(dish);
        }
    }
}


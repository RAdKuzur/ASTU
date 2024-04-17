using Lab1.Data;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using static Lab1.Data.DataEntity;

namespace Lab1.Pages
{
    public class EditModel : PageModel
    {
        private readonly DataClassRepository _db;
        public EditModel(DataClassRepository db)
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
                Description = pieces,
                Type = type

            };
            _db.Update(dish);
        }
    }
}

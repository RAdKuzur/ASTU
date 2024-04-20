using Lab1.Data;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using NuGet.Protocol.Core.Types;
using static Lab1.Data.Dish;

namespace Lab1.Pages
{
    public class EditModel : PageModel
    {
        public Dish dish { get; set; }
        private readonly DishRepository _db;
        public EditModel(DishRepository db)
        {
            _db = db;
        }
        public void OnGet(Guid id)
        {
            dish = _db.Find(id);
        }
        public IActionResult OnPost(Guid id, string name, string pieces, string type)
        {
            Dish dish = new Dish()
            {
                Id = id,
                Name = name,
                Description = pieces,
                Type = type

            };
            _db.Update(dish);
            return RedirectToPage("./Watch");
        }
    }
    
}

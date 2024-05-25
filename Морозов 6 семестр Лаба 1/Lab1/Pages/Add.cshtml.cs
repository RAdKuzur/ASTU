using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using static Lab1.Data.Dish;
using static Lab1.Data.DishRepository;
using Lab1.Data;
namespace Lab1.Pages
{
    public class AddModel : PageModel
    {
        private readonly DishRepository _db;
        public AddModel(DishRepository db)
        {
                       _db = db;
        }
        public string text = "text";
        public string Message { get; private set; } = "";
        public void OnGet()
        {   
        }
        public IActionResult OnPost(string name, string pieces, string type)
        {
            if (ModelState.IsValid) { 
                Dish dish = new Dish()
                {
                    Name = name,
                    Description = pieces,
                    Type = type

                };
                _db.Add(dish);
                return RedirectToPage("./Watch");
            }
            else
            {
                return RedirectToPage("./Add");
            }
        }
    }
}

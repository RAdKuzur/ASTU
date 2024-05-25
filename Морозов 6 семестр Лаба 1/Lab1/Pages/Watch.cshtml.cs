using Lab1.Data;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using static Lab1.Data.Dish;

namespace Lab1.Pages
{
    public class WatchModel : PageModel
    {
        public Dish dish { get; set; }
        public IList<Dish> dishes = new List<Dish>();
        private readonly DishRepository _db;
        public WatchModel(DishRepository db)
        {
            _db = db;
        }
        public IEnumerable<Dish> Dishes { get; set; }
        public void OnGet()
        {
            dishes = _db.List();
        }
        public IActionResult OnPost(Guid id)
        {
            _db.Remove(id);
            return RedirectToPage("./Watch");
        }
    }
}

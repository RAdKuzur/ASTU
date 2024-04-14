using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using RazorPages.Models;
using RazorPages.Services;

namespace Lab1.Pages
{
    public class WatchModel : PageModel
    {
        private readonly IDishRepository _db;
        public WatchModel(IDishRepository db) {
            _db = db;
        }
        public IEnumerable<Dish> Dishes{ get; set; }
        public void OnGet()
        {
            Dishes = _db.GetAllDish();
        }
    }
}

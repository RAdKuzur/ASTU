using Lab1.Data;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using static Lab1.Data.DataEntity;

namespace Lab1.Pages
{
    public class WatchModel : PageModel
    {
        public List<Dish> dishes = new List<Dish>();
        private readonly DataClassRepository _db;
        public WatchModel(DataClassRepository db)
        {
            _db = db;
        }
        public IEnumerable<Dish> Dishes { get; set; }
        public void OnGet()
        {
            dishes = _db.List();
        }
    }
}

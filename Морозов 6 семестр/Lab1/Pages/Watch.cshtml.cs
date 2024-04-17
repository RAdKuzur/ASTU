using Lab1.Data;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using static Lab1.Data.DataEntity;

namespace Lab1.Pages
{
    public class WatchModel : PageModel
    {
        /*private readonly IDishRepository _db;
        public WatchModel(IDishRepository db) {
            _db = db;
        }
        public IEnumerable<Dish> Dishes{ get; set; }
        public void OnGet()
        {
            Dishes = _db.GetAllDish();
        }
        */
        private readonly DataClassRepository _db;
        public WatchModel(DataClassRepository db)
        {
            _db = db;
        }
        public IEnumerable<Dish> Dishes { get; set; }
        public void OnGet()
        {
            Dishes = _db.GetAllDish();
        }
    }
}

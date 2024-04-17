using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using static Lab1.Data.DataEntity;
using static Lab1.Data.DataClassRepository;
using Lab1.Data;
namespace Lab1.Pages
{
    public class AddModel : PageModel
    {
        private readonly DataClassRepository _db;
        public AddModel(DataClassRepository db)
        {
            _db = db;
        }
        public string text = "text";
        public string Message { get; private set; } = "";
        public void OnGet()
        {
            text = Message;
        }
        public void OnPost(string name, string pieces, string type)
        {
            Dish dish = new Dish()
            {
                Name = name,
                Description = pieces,
                Type = type

            };
            _db.Add(dish);
        }
    }
}

using Lab1.Data;
using Microsoft.AspNetCore.Mvc.RazorPages;

namespace Lab1.Pages;

public class IndexModel : PageModel
{

    private readonly DishRepository _db;
    public IndexModel(DishRepository db)
    {
        _db = db;
    }

    public void OnGet()
    {

    }
    public void OnPost()
    {
        _db.CopyData();
    }
}

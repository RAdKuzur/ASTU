using Lab1.Data;
using Microsoft.AspNetCore.Mvc.RazorPages;

namespace Lab1.Pages;

public class IndexModel : PageModel
{

    private readonly DataClassRepository _db;
    public IndexModel(DataClassRepository db)
    {
        _db = db;
    }

    public void OnGet()
    {

    }
    public void OnPost()
    {
        _db.CopyTest();
    }
}

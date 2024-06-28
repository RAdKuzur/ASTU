using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Lab2.Models;
namespace Lab2.Controllers
{
    public class ExhibitController : Controller
    {
        private readonly IRepository<Exhibit> _exhibitRepository;
        private readonly IRepository<Museum> _museumRepository;


        public ExhibitController(IRepository<Exhibit> exhibitRepository, IRepository<Museum> museumRepository)
        {
            _exhibitRepository = exhibitRepository;
            _museumRepository = museumRepository;
        }

        // GET
        public ActionResult Index()
        {
            var exhibits = _exhibitRepository.GetAll();
            return View(exhibits);
        }

        // GET
        public ActionResult Details(int id)
        {
            var exhibit = _exhibitRepository.Get(id);
            return View(exhibit);
        }

        // GET
        public ActionResult Create()
        {
            var museums = _museumRepository.GetAll();
            ViewBag.Museums = new SelectList(museums, "Id", "Name");

            return View();
        }
        // POST
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create(Exhibit exhibit)
        {
            try
            {
                _exhibitRepository.Add(exhibit);
                return RedirectToAction(nameof(Index));
            }
            catch
            {
                return View();
            }
        }

        // GET
        public ActionResult Edit(int id)
        {
            var exhibit = _exhibitRepository.Get(id);
            var museums = _museumRepository.GetAll();
            ViewBag.Museums = new SelectList(museums, "Id", "Name");
            return View();
        }
        // POST
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit(int id, Exhibit exhibit)
        {
             try
             {
                _exhibitRepository.Update(exhibit);
                return RedirectToAction(nameof(Index));
             }
             catch
             {
                return View();
             }
        }

        // GET
        public ActionResult Delete(int id)
        {
            var exhibit = _exhibitRepository.Get(id);
            return View(exhibit);
        }

        // POST
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Delete(int id, IFormCollection collection)
        {
            try
            {
                _exhibitRepository.Delete(id);
                return RedirectToAction(nameof(Index));
            }
            catch
            {
                return View();
            }
        }
    }
}

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

        // GET: ExhibitsController
        public ActionResult Index()
        {
            var exhibits = _exhibitRepository.GetAll();
            return View(exhibits);
        }

        // GET: ExhibitsController/Details/5
        public ActionResult Details(int id)
        {
            var exhibit = _exhibitRepository.Get(id);
            return View(exhibit);
        }

        // GET: ExhibitsController/Create
        public ActionResult Create()
        {
            var museums = _museumRepository.GetAll();
            ViewBag.Museums = new SelectList(museums, "Id", "Name");

            return View();
        }
        // POST: ExhibitsController/Create
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

        // GET: ExhibitsController/Edit/5
        public ActionResult Edit(int id)
        {
            var exhibit = _exhibitRepository.Get(id);
            return View(exhibit);
        }
        // POST: ExhibitsController/Edit/5
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

        // GET: ExhibitsController/Delete/5
        public ActionResult Delete(int id)
        {
            var exhibit = _exhibitRepository.Get(id);
            return View(exhibit);
        }

        // POST: ExhibitsController/Delete/5
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

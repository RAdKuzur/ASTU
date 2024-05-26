using Lab2.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace Lab2.Controllers
{
    public class MuseumController : Controller
    {
        private readonly IRepository<Museum> _museumRepository;

        public MuseumController(IRepository<Museum> museumRepository)
        {
            _museumRepository = museumRepository;
        }

        // GET
        public ActionResult Index()
        {
            var museums = _museumRepository.GetAll();
            return View(museums);
        }

        // GET
        public ActionResult Details(int id)
        {
            var museum = _museumRepository.Get(id);
            return View(museum);
        }

        // GET
        public ActionResult Create()
        {
            return View();
        }

        // POST
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create(Museum museum)
        {
            try
            {
                _museumRepository.Add(museum);
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
            var museum = _museumRepository.Get(id);
            return View(museum);
        }

        // POST
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit(int id, Museum museum)
        {
            try
            {
                _museumRepository.Update(museum);
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
            var museum = _museumRepository.Get(id);
            return View(museum);
        }

        // POST
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Delete(int id, IFormCollection collection)
        {
            try
            {
                _museumRepository.Delete(id);
                return RedirectToAction(nameof(Index));
            }
            catch
            {
                return View();
            }
        }
    }
}
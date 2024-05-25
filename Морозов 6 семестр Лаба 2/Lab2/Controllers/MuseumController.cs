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

        // GET: MuseumController
        public ActionResult Index()
        {
            var museums = _museumRepository.GetAll();
            return View(museums);
        }

        // GET: MuseumController/Details/5
        public ActionResult Details(int id)
        {
            var museum = _museumRepository.Get(id);
            return View(museum);
        }

        // GET: MuseumController/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: MuseumController/Create
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

        // GET: MuseumController/Edit/5
        public ActionResult Edit(int id)
        {
            var museum = _museumRepository.Get(id);
            return View(museum);
        }

        // POST: MuseumController/Edit/5
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

        // GET: MuseumController/Delete/5
        public ActionResult Delete(int id)
        {
            var museum = _museumRepository.Get(id);
            return View(museum);
        }

        // POST: MuseumController/Delete/5
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
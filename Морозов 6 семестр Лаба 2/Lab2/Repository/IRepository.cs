using Microsoft.EntityFrameworkCore;
using System.Collections.Generic;
using System.Linq;
using Lab2.Models;
using static Lab2.Models.Exhibit;
public interface IRepository<T> where T : class
{
    IEnumerable<T> GetAll();
    T Get(int id);
    void Add(T entity);
    void Update(T entity);
    void Delete(int id);
}
public class MuseumRepository : IRepository<Museum>
{
    private readonly ApplicationDbContext _context;

    public MuseumRepository(ApplicationDbContext context)
    {
        _context = context;
    }

    public IEnumerable<Museum> GetAll()
    {
        return _context.Museums.Include(h => h.Exhibits);
    }

    public Museum Get(int id)
    {
        return _context.Museums.Include(h => h.Exhibits).FirstOrDefault(h => h.Id == id);
    }

    public void Add(Museum museum)
    {
        _context.Museums.Add(museum);
        _context.SaveChanges();
    }

    public void Update(Museum museum)
    {
        _context.Museums.Update(museum);
        _context.SaveChanges();
    }

    public void Delete(int id)
    {
        var museum = Get(id);
        if (museum != null)
        {
            _context.Museums.Remove(museum);
            _context.SaveChanges();
        }
    }
}
public class ExhibitRepository : IRepository<Exhibit>
{
    private readonly ApplicationDbContext _context;

    public ExhibitRepository(ApplicationDbContext context)
    {
        _context = context;
    }
    public IEnumerable<Exhibit> GetAll()
    {
        return _context.Exhibits.Include(p => p.Museum);
    }

    public Exhibit Get(int id)
    {
        return _context.Exhibits.Include(p => p.Museum).FirstOrDefault(p => p.Id == id);
    }

    public void Add(Exhibit exhibit)
    {
        _context.Exhibits.Add(exhibit);
        _context.SaveChanges();
    }

    public void Update(Exhibit exhibit)
    {
        _context.Exhibits.Update(exhibit);
        _context.SaveChanges();
    }

    public void Delete(int id)
    {
        var exhibit = Get(id);
        if (exhibit != null)
        {
            _context.Exhibits.Remove(exhibit);
            _context.SaveChanges();
        }
    }
}
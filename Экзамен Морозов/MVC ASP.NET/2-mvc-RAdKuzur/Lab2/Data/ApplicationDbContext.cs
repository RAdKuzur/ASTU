using Microsoft.EntityFrameworkCore;
using Lab2.Models;
using static Lab2.Models.Exhibit;
using System.Collections.Generic;
public class ApplicationDbContext : DbContext
{
    public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options)
        : base(options)
    {
    }
    public DbSet<Museum> Museums { get; set; }
    public DbSet<Exhibit> Exhibits { get; set; }
}
using System.ComponentModel.DataAnnotations;
namespace Lab2.Models
{
    public class Museum
    {
        /// id
        public int Id { get; set; }
        /// название
        [Required(ErrorMessage = "Поле обязательно для заполнения.")]
        public string Name { get; set; }
        /// адрес 
        [Required(ErrorMessage = "Поле обязательно для заполнения.")]
        public string Address { get; set; }
        /// Куратор
        [Required(ErrorMessage = "Поле обязательно для заполнения.")]
        public string Person { get; set; }
        /// год основания
        [Required(ErrorMessage = "Поле обязательно для заполнения.")]
        public int Year { get; set; }
        /// связь один ко многим. коллекции
        public List<Exhibit> Exhibits { get; set; }
    }
}

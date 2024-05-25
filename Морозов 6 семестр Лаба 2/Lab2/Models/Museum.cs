using System.ComponentModel.DataAnnotations;
namespace Lab2.Models
{
    public class Museum
    {
        /// id
        public int Id { get; set; }
        /// название
        [Required(ErrorMessage = "Поле обязательно для заполнения.")]
        [StringLength(100, ErrorMessage = "Название не должно превышать 100 символов.")]
        public string Name { get; set; }
        /// адрес 
        [Required(ErrorMessage = "Поле обязательно для заполнения.")]
        [StringLength(200, ErrorMessage = "Адрес не должен превышать 200 символов.")]
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

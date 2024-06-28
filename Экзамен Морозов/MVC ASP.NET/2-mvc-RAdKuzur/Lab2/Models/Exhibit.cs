using System.ComponentModel.DataAnnotations;

namespace Lab2.Models
{
    public class Exhibit
    {
            /// id         
            public int Id { get; set; }
            /// название
            [Required(ErrorMessage = "Поле обязательно для заполнения.")]
            public string Name { get; set; }
            ///описание    
            [Required(ErrorMessage = "Поле обязательно для заполнения.")]
            public string Description { get; set; }
            /// эпоха
            [Required(ErrorMessage = "Поле обязательно для заполнения.")]
            public string Era { get; set; }
            /// цена
            [Required(ErrorMessage = "Поле обязательно для заполнения.")]
            public int Price { get; set; }
            public int MuseumId { get; set; }
            public Museum Museum { get; set; }
    }
}

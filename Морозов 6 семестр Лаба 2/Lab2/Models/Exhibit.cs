using System.ComponentModel.DataAnnotations;

namespace Lab2.Models
{
    public class Exhibit
    {
            /// id         
            public int Id { get; set; }
            /// название
            [Required(ErrorMessage = "Поле обязательно для заполнения.")]
            [StringLength(100, ErrorMessage = "Название не должно превышать 100 символов.")]
            public string Name { get; set; }
            ///описание    
            [Required(ErrorMessage = "Поле обязательно для заполнения.")]
            [StringLength(200, ErrorMessage = "Описание не должно превышать 200 символов.")]
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

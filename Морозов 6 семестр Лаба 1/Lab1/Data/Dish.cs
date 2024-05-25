namespace Lab1.Data;
using System.ComponentModel.DataAnnotations;
/// <summary>
/// Простой POCO класс представляющий строку данных
/// </summary>
// TODO: переименуйте этот файл и класс, добавьте атрибуты
public class Dish
{
    /// <summary>
    /// Идентификатор
    /// </summary>
  

    //Блюда
    public Guid Id { get; set; }
    [Required(ErrorMessage = "Поле 'Название' обязательно для заполнения.")]

    public string Name { get; set; }
    [Required(ErrorMessage = "Поле 'Описание' обязательно для заполнения.")]

    public string Description { get; set; }

    [Required(ErrorMessage = "Поле 'Тип' обязательно для заполнения.")]
    public string Type { get; set; }


}

    namespace Lab1.Data;

/// <summary>
/// Простой POCO класс представляющий строку данных
/// </summary>
// TODO: переименуйте этот файл и класс, добавьте атрибуты
public class DataEntity
{
    /// <summary>
    /// Идентификатор
    /// </summary>
  

    //Блюда
    public class Dish
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public string Description { get; set; }
        public string Type { get; set; }    
    }


    //Ингридиенты
    
    public Guid Id { get; set; }
}

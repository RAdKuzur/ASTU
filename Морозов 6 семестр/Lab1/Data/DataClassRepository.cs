namespace Lab1.Data;

/// <summary>
/// Класс репозиторий для сохранения данных о ...
/// </summary>
// TODO: не забудьте переименовать класс
// TODO: реализуйте здесь чтение и запись файла
public class DataClassRepository
{
    /// <summary>
    /// Возврщает все элементы списка
    /// </summary>
    /// <returns>Список ...</returns>
    public IList<DataEntity> List()
    {
        lock (this)
        {
            // Deserialize data from file instead
            return [];
        }
    }

    /// <summary>
    /// Добавляет новую запись
    /// </summary>
    /// <param name="data">Новая запись о ...</param>
    public void Add(DataEntity data)
    {
        lock (this)
        {
            data.Id = Guid.NewGuid();
            // Deserialize data from file
            // Add new data
            // Save updated list to file
        }
    }

    /// <summary>
    /// Обновляет запись о ...
    /// </summary>
    /// <param name="data">Запись о ...</param>
    public void Update(DataEntity data)
    {
        lock (this)
        {
            // Deserialize data from file
            // Find data with same id
            // Update it's attributes
            // Save updated list to file
        }
    }

    /// <summary>
    /// Удаляет запись о ... по идентификатору
    /// </summary>
    /// <param name="id">Идентификатор записи о ...</param>
    public void Remove(Guid id)
    {
        lock (this)
        {
            // Deserialize data from file
            // Find data with same id
            // Remove data row
            // Save updated list to file
        }
    }
}

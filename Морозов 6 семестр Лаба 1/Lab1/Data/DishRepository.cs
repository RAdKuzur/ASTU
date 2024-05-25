using System;
using System.IO;
using System.Text;
using System.Text.Json;

namespace Lab1.Data;

/// <summary>
/// Класс репозиторий для сохранения данных о языках программирования
/// </summary>
// TODO: не забудьте переименовать класс +
// TODO: реализуйте здесь чтение и запись файла +

public class DishRepository
{
    private readonly string _filePath = "database.json";

    private IList<Dish> _data;

    public DishRepository()
    {
        if (File.Exists(_filePath))
        {
            var strings = File.ReadAllLines(_filePath);
            _data = strings.Select(line =>
            {
                var array = line.Split('@');
                return new Dish
                {
                    Id = Guid.Parse(array[0]),
                    Name = array[1],
                    Type = array[2],
                    Description = array[3]
                };
            }).ToList();
        }
        else
        {
            _data = new List<Dish>();
        }
    }
    public void CopyData()
    {
        string sourceFilePath = @"test.json"; // Путь к файлу, из которого нужно скопировать данные
        string destinationFilePath = @"database.json"; // Путь к файлу, в который нужно скопировать данные
        if (!File.Exists(destinationFilePath))
        {
            using (File.Create(destinationFilePath)) { }
        }
        File.Copy(sourceFilePath, destinationFilePath, true);
    }
    public Dish Find(Guid id)
    {
        return _data.FirstOrDefault(d => d.Id == id);
    }

    /// <summary>
    /// Возврщает все элементы списка
    /// </summary>
    /// <returns>Список всех языков программироввания</returns>
    public IList<Dish> List()
    {
        lock (this)
        {
            if (File.Exists(_filePath))
            {
                var strings = File.ReadAllLines(_filePath);
                _data = strings.Select(line =>
                {
                    var array = line.Split('@');
                    return new Dish
                    {
                        Id = Guid.Parse(array[0]),
                        Name = array[1],
                        Description = array[2],
                        Type = array[3]
                    };
                }).ToList();
            }
            return _data;
        }
    }

    /// <summary>
    /// Добавляет новую запись
    /// </summary>
    /// <param name="data">Новая запись о нового языка программирования</param>
    public void Add(Dish data)
    {
        lock (this)
        {
            data.Id = Guid.NewGuid();
            _data.Add(data);
            Save();
        }
    }

    /// <summary>
    /// Обновляет запись о языках программирования
    /// </summary>
    /// <param name="data">Запись о языке программирования</param>
    public void Update(Dish data)
    {
        lock (this)
        {
            var index = _data.ToList().FindIndex(d => d.Id == data.Id);
            if (index != -1)
            {
                _data[index] = data;
                Save();
            }
        }
    }

    /// <summary>
    /// Удаляет запись о языках программирования по идентификатору
    /// </summary>
    /// <param name="id">Идентификатор записи о языках программирования</param> 
    public void Remove(Guid id)
    {
        lock (this)
        {
            var data = _data.FirstOrDefault(d => d.Id == id);
            if (data != null)
            {
                _data.Remove(data);
                Save();
            }
        }
    }

    /// <summary>
    /// сохранить двнные в файл
    /// </summary>
    /// <param name="id">Идентификатор записи о языках программирования</param>
    private void Save()
    {
        var strings = _data.Select(d => $"{d.Id}@{d.Name}@{d.Description}@{d.Type}");
        File.WriteAllLines(_filePath, strings);

    }
}
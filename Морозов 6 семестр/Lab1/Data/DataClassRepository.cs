using Microsoft.CodeAnalysis.CSharp.Syntax;
using static Lab1.Data.DataEntity;
using static System.Runtime.InteropServices.JavaScript.JSType;

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
    static string ReadFileLine(string filePath)
    {
        try
        {
            if (File.Exists(filePath))
            {
                using (StreamReader reader = new StreamReader(filePath))
                {
                    return reader.ReadLine();
                }
            }
            else
            {
                //Файл не найден
                return null;
            }
        }
        catch (Exception ex)
        {
            return null;
        }
    }
    static void RemoveLineFromFile(string lineToRemove)
    { 
            string tempFilePath = @"APPDATA\database2.txt";
            string filePath = @"APPDATA\database.txt";
            using (StreamReader reader = new StreamReader(filePath))
            using (StreamWriter writer = new StreamWriter(tempFilePath))
            {
                string line;
                while ((line = reader.ReadLine()) != null)
                {
                    if (line != lineToRemove)
                    {
                        writer.WriteLine(line);
                    }
                    else
                    {
                        //reader.ReadLine();
                        reader.ReadLine();
                        reader.ReadLine();
                    }
                }
            }
            File.Delete(filePath); // Удаляем оригинальный файл
            File.Move(tempFilePath, filePath); // Переименовываем временный файл в оригинальный
    }
    static void RemoveAndUpdateLineFromFile(string lineToRemove, string FirstlineToUpdate , string SecondlineToUpdate)
    {
        string tempFilePath = @"APPDATA\database2.txt";
        string filePath = @"APPDATA\database.txt";
        using (StreamReader reader = new StreamReader(filePath))
        using (StreamWriter writer = new StreamWriter(tempFilePath))
        {
            string line;
            while ((line = reader.ReadLine()) != null)
            {
                if (line != lineToRemove)
                {
                    writer.WriteLine(line);
                    line = reader.ReadLine();
                    writer.WriteLine(line);
                    line = reader.ReadLine();
                    writer.WriteLine(line);
                }
                else
                {
                    reader.ReadLine();
                    reader.ReadLine();
                    writer.WriteLine(line);
                    writer.WriteLine(FirstlineToUpdate);
                    writer.WriteLine(SecondlineToUpdate);
                }
            }
        }
        File.Delete(filePath); // Удаляем оригинальный файл
        File.Move(tempFilePath, filePath); // Переименовываем временный файл в оригинальный
    }
    public List<DataEntity.Dish> List()
    {
        lock (this)
        {
            string filePath = @"APPDATA\database.txt"; // Путь к файлу, из которого нужно прочитать одну строку
            string name = ""; //имя блюда
            string pieces = ""; //ингридиенты
            string type = ""; //способ готовки
            string line = ReadFileLine(filePath);
            List<Dish> dishes = new List<Dish>();
            try
            {
                if (File.Exists(filePath))
                {
                    using (StreamReader reader = new StreamReader(filePath))
                    {
                        while ((name = reader.ReadLine())!= null)
                        {
                            // name = reader.ReadLine();
                            pieces = reader.ReadLine();
                            type = reader.ReadLine(); 
                            Dish dish = new Dish()
                            {
                                Name = name,
                                Description = pieces,
                                Type = type
                            }; 
                            dishes.Add(dish);
                        }
                    }
                }
                else
                {
                    //Файл не найден
                    return null;
                }
            }
            catch (Exception ex)
            {
                return null;
            }
            
            return dishes;
        }
    }
    public void CopyTest()
    {
        string sourceFilePath = @"APPDATA\test.txt"; // Путь к файлу, из которого нужно скопировать данные
        string destinationFilePath =  @"APPDATA\database.txt"; // Путь к файлу, в который нужно скопировать данные
        if (!File.Exists(destinationFilePath))
        {
                using (File.Create(destinationFilePath)) { }
        }
        File.Copy(sourceFilePath, destinationFilePath, true);
    }
    /// <summary>
    /// Добавляет новую запись
    /// </summary>
    /// <param name="data">Новая запись о ...</param>
    public void Add(DataEntity.Dish data)
    {
        lock (this)
        {
            string name = data.Name;
            string pieces = data.Description;
            string type = data.Type;
            string directoryPath = @"APPDATA"; // Путь к директории, где хотите создать файл
            string fileName = "database.txt"; // Имя файла
            string filePath = Path.Combine(directoryPath, fileName);
            try
            {
                // Проверяем существует ли директория, если нет - создаем
                if (!Directory.Exists(directoryPath))
                {
                    Directory.CreateDirectory(directoryPath);
                }
                // Проверяем существует ли файл, если да - дописываем информацию
                if (File.Exists(filePath))
                {
                    //File.AppendAllText(filePath, "-" + '\n');
                    File.AppendAllText(filePath, name + '\n');
                    File.AppendAllText(filePath, pieces + '\n');
                    File.AppendAllText(filePath, type + '\n');
                }
                else
                {
                    //File.WriteAllText(filePath, "-" + '\n');
                    File.WriteAllText(filePath, name + '\n');
                    File.AppendAllText(filePath, pieces + '\n');
                    File.AppendAllText(filePath, type + '\n');
                }
            }
            catch (Exception ex)
            {

            }
        }
    }

    /// <summary>
    /// Обновляет запись о ...
    /// </summary>
    /// <param name="data">Запись о ...</param>
    public void Update(DataEntity.Dish data)
    {
        lock (this)
        {
            string filePath = @"APPDATA\database.txt";
            string name = data.Name; //имя блюда
            string pieces = data.Description; //ингридиенты
            string type = data.Type; //способ готовки      
            RemoveAndUpdateLineFromFile(name, pieces, type);

        }
    }

    /// <summary>
    /// Удаляет запись о ... по идентификатору
    /// </summary>
    /// <param name="id">Идентификатор записи о ...</param>
    public void Remove(DataEntity.Dish data)
    {
        lock (this)
        {
            //string filePath = @"C:\Temp\database.txt";
            string name = data.Name; //имя блюда
            string pieces = data.Description; //ингридиенты
            string type = data.Type; //способ готовки

            RemoveLineFromFile(name);
        }
    }
}

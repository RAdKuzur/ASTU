﻿--CREATE DATABASE "OPTOVIK";

CREATE TABLE "Agent" (
	"ID_Agent" serial PRIMARY KEY,
	"Name" varchar (40) NOT NULL,
	"City" varchar (30) NOT NULL,
	"Commission" real DEFAULT 0.0
);

CREATE TABLE "Customer" (
	"ID_Customer" serial PRIMARY KEY,
	"Name" varchar (50) NOT NULL,
	"City" varchar (30) NOT NULL,
	"Rating" integer,
	"ID_Agent" integer REFERENCES "Agent" 
);

CREATE TABLE "Order" (
	"ID_Order" serial PRIMARY KEY,
	"Sum" real NOT NULL,
	"Date" date DEFAULT CURRENT_DATE,
	"ID_Customer" integer REFERENCES "Customer",
	"ID_Agent" integer REFERENCES "Agent" 
);

INSERT INTO "Agent" ("Name", "City", "Commission") VALUES 
('Иванов И.И.',   'Астрахань',      10000.00),
('Петров П.П.',   'Астрахань',      22000.00),
('Сидоров С.С.',  'Волгоград',      15000.00),
('Горяев Р.А.',   'Элиста',          8000.00),
('Родионов Н.О.', 'Ростов-на-Дону', 30000.00),
('Медведев Л.Д.', 'Ростов-на-Дону', 18000.00),
('Арефьев В.А.',  'Ставрополь',     25000.00),
('Краснов С.В.',  'Краснодар',      32000.00),
('Мурзалиев М.М.','Махачкала',      12000.00),
('Дудкин В.И.',   'Владикавказ',    20000.00);

INSERT INTO "Customer" ("Name", "City", "Rating", "ID_Agent") VALUES 
('Три кота',                       'Астрахань',      65,  1),
('ЭЛКО',                           'Астрахань',      40,  2),
('ТЦ Восток',                      'Астрахань',      25,  1),
('ЦУМ',                            'Астрахань',      40,  2),
('Астрахань-Гарант-Сервис',        'Астрахань',      80,  1),
('Музей В.О.В.',                   'Волгоград',      55,  3),
('Речной порт',                    'Волгоград',      20,  3),
('Мясокомбинат',                   'Ставрополь',     60,  7),
('Молокозавод',                    'Ставрополь',     65,  7),
('Турфирма ОТДЫХ',                 'Краснодар',      40,  8),
('Гостиничный комплекс МОСКВА',    'Краснодар',      70,  5),
('Кондитерская фабрика',           'Краснодар',      65,  8),
('Издательство КАВКАЗ',            'Краснодар',      80,  8),
('Трикотажная фабрика',            'Элиста',         75,  4),
('ООО Бензин Калмыкии',            'Элиста',         20,  4),
('Консервный завод',               'Махачкала',      50,  9),
('ООО Северная Осетия',            'Владикавказ',    35, 10),
('ООО ПРЕДГОРЬЕ',                  'Грозный',        60, 10),
('Аэропорт РОСТОВ',                'Ростов-на-Дону', 75,  6),
('Конный завод им. С.М.Буденного', 'Ростов-на-Дону', 80,  5),
('Часовой завод ЛУЧ',              'Ростов-на-Дону', 40,  6),
('Морской порт',                   'Таганрог',	     60,  6);

INSERT INTO "Order" ("Sum", "Date", "ID_Customer", "ID_Agent") VALUES 
(100000.00, '01-09-2014',  3,  1),
( 75000.00, '05-09-2014',  7,  3),
(120000.00, '08-09-2014',  2,  2),
( 50000.00, '11-09-2014',  4,  2),
(230000.00, '15-09-2014',  1,  1),
(150000.00, '18-09-2014',  5,  1),
(300000.00, '20-09-2014',  8,  7),
(170000.00, '20-09-2014',  6,  3),
(340000.00, '23-09-2014',  9,  7),
(500000.00, '25-09-2014', 11,  5),
(450000.00, '29-09-2014', 10,  8),
(350000.00, '30-09-2014', 13,  8),
(180000.00, '02-10-2014', 12,  8),
(370000.00, '04-10-2014', 15,  4),
( 90000.00, '06-10-2014', 17, 10),
(460000.00, '09-10-2014', 14,  4),
(290000.00, '10-10-2014', 18, 10),
(420000.00, '10-10-2014', 16,  9),
(310000.00, '16-10-2014', 20,  5),
(130000.00, '21-10-2014', 19,  6),
(490000.00, '26-10-2014', 22,  6),
(200000.00, '31-10-2014', 21,  6),
(400000.00, '31-10-2014', 21,  6);


CREATE TABLE gallery (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	file_name TEXT NOT NULL,
	file_ext TEXT NOT NULL,
	animal TEXT,
	description TEXT NOT NULL,
	source TEXT,
	userupload TEXT);

CREATE TABLE tags(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	tag_name TEXT NOT NULL
);

CREATE TABLE imagetags(
	id	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	image_id	INTEGER,
	tag_id	INTEGER
);

CREATE TABLE users(
	id	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	username	TEXT UNIQUE NOT NULL,
	password	TEXT NOT NULL,
  session	TEXT UNIQUE
);

INSERT INTO tags (tag_name) VALUES ("Dog");
INSERT INTO tags (tag_name) VALUES ("Puppy");
INSERT INTO tags (tag_name) VALUES ("Cat");
INSERT INTO tags (tag_name) VALUES ("Kitten");
INSERT INTO tags (tag_name) VALUES ("Penguin");
INSERT INTO tags (tag_name) VALUES ("Bear");
INSERT INTO tags (tag_name) VALUES ("Dik-dik");
INSERT INTO tags (tag_name) VALUES ("Rabbit");
INSERT INTO tags (tag_name) VALUES ("Monkey");
INSERT INTO tags (tag_name) VALUES ("Kangaroo");
INSERT INTO tags (tag_name) VALUES ("Elephant");
INSERT INTO tags (tag_name) VALUES ("Cute");
INSERT INTO tags (tag_name) VALUES ("Fluffy");


INSERT INTO imagetags (image_id,tag_id) VALUES (1,1);
INSERT INTO imagetags (image_id,tag_id) VALUES (1,2);
INSERT INTO imagetags (image_id,tag_id) VALUES (1,12);
INSERT INTO imagetags (image_id,tag_id) VALUES (1,13);
INSERT INTO imagetags (image_id,tag_id) VALUES (2,3);
INSERT INTO imagetags (image_id,tag_id) VALUES (2,4);
INSERT INTO imagetags (image_id,tag_id) VALUES (2,12);
INSERT INTO imagetags (image_id,tag_id) VALUES (2,13);
INSERT INTO imagetags (image_id,tag_id) VALUES (3,5);
INSERT INTO imagetags (image_id,tag_id) VALUES (3,12);
INSERT INTO imagetags (image_id,tag_id) VALUES (4,6);
INSERT INTO imagetags (image_id,tag_id) VALUES (5,7);
INSERT INTO imagetags (image_id,tag_id) VALUES (6,3);
INSERT INTO imagetags (image_id,tag_id) VALUES (7,8);
INSERT INTO imagetags (image_id,tag_id) VALUES (8,9);
INSERT INTO imagetags (image_id,tag_id) VALUES (9,10);
INSERT INTO imagetags (image_id,tag_id) VALUES (10,11);


INSERT INTO users (username, password) VALUES ('spider', 'pig');
INSERT INTO users (username, password) VALUES ('duckduck', 'goose');

INSERT INTO gallery (file_name, file_ext, description, source, animal) VALUES ('1', 'jpg',
"The Maltese, Canis familiaris Maelitacus, is a small breed of dog in the Toy Group. It descends from dogs originating in the Central Mediterranean Area."
,"https://en.wikipedia.org/wiki/Maltese_dog#/media/File:Emily_Maltese.jpg",'Maltese Puppy');

INSERT INTO gallery (file_name, file_ext,description, source, animal) VALUES ('2', 'jpg',
	"The Persian cat is a long-haired breed of cat characterized by its round face and short muzzle. It is also known as the Persian Longhair in the English-speaking countries.",
	"http://cattime.com/cat-breeds/persian-cats", 'Persian Cat');

INSERT INTO gallery (file_name, file_ext,description, source,animal) VALUES ('3', 'jpg',
	"Penguins are a group of aquatic, flightless birds. They live almost exclusively in the Southern Hemisphere, with only one species, the Galapagos penguin, found north of the equator.",
	"https://www.pinterest.com/Labradors102938/cute-baby-penguin/", 'Penguin');

INSERT INTO gallery (file_name, file_ext,description, source,animal) VALUES ('4', 'jpg',
	"The giant panda, also known as panda bear or simply panda, is a bear native to south central China. It is easily recognized by the large, distinctive black patches around its eyes, over the ears, and across its round body.",
	"https://c2.staticflickr.com/4/3296/2679911705_33e5b2db7d_b.jpg", "Panda Bear");

INSERT INTO gallery (file_name, file_ext,description, source,animal) VALUES ('5', 'jpg',
	"A dik-dik is the name for any of four species of small antelope in the genus Madoqua that live in the bushlands of eastern and southern Africa. Dik-diks stand about 30–40 centimetres at the shoulder, are 50–70 cm long, weigh 3–6 kilograms and can live for up to 10 years. Dik-diks are named for the alarm calls of the females.",
	"http://elelur.com/data_images/mammals/dik-dik/dik-dik-04.jpg",'Dik-dik');

INSERT INTO gallery (file_name, file_ext,description, source,animal) VALUES ('6', 'jpg'
	,"The British Shorthair is the pedigreed version of the traditional British domestic cat, with a distinctively chunky body, dense coat and broad face.",
	"http://cdn2-www.cattime.com/assets/uploads/gallery/british-shorthair-cats-and-kittens/british-shorthair-cats-and-kittens-5.jpg", 'British Short Hair Cat');

INSERT INTO gallery (file_name, file_ext,description, source,animal) VALUES ('7', 'jpg',
	"Dwarf rabbits comprise the smallest domestic rabbit breeds, most frequently due to the effects of a single dwarfing gene. Netherland Dwarfs are usually the breed most people think of when the topic of dwarf rabbits arises. These rabbits have a compact body with a short neck and a rounded face."
	,"https://i.pinimg.com/736x/1b/c6/18/1bc6189c95d2833480fed189036d449f.jpg",'Dwarf Rabbit');

INSERT INTO gallery (file_name, file_ext,description, source,animal) VALUES ('8', 'jpg',
		"Monkeys are non-hominoid simians, generally possessing tails and consisting of about 260 known living species. Many monkey species are tree-dwelling, although there are species that live primarily on the ground, such as baboons."
		," http://trending.com/tweets/2017-10-08/cute-monkey",'Monkey');

INSERT INTO gallery (file_name, file_ext, description, source,animal) VALUES ('9', 'jpg',
		"The kangaroo is a marsupial from the family Macropodidae. In common use the term is used to describe the largest species from this family, especially those of the genus Macropus: the red kangaroo."
		,"https://imgur.com/gallery/SHjCB",'Kangaroo');

INSERT INTO gallery (file_name, file_ext, description, source,animal) VALUES ('10', 'jpg',
		"Elephants are large mammals of the family Elephantidae and the order Proboscidea. Three species are currently recognised: the African bush elephant, the African forest elephant, and the Asian elephant."
		,"https://www.pinterest.com/pin/331296116318091613/",'Elephant');


UPDATE gallery
SET userupload = "duckduck";

UPDATE gallery
SET userupload = "spider"
where id=2;

UPDATE gallery
SET userupload = "spider"
where id=4;

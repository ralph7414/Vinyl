CREATE DATABASE vinyl

CREATE DATABASE v_db

use vinyl

DROP TABLE vinyl

CREATE TABLE `vinyl` (
    `id` integer PRIMARY KEY AUTO_INCREMENT,
    `shs_id` VARCHAR(20) UNIQUE,
    `title` varchar(100) NOT NULL,
    `author_id` int,
    `price` int DEFAULT 1000,
    `genre_id` int,
    `gender_id` int,
    `company` varchar(50) DEFAULT null,
    `release_date` date,
    `format` varchar(10),
    `create_date` timestamp DEFAULT CURRENT_TIMESTAMP,
    `stock` int DEFAULT 1,
    `status_id` int DEFAULT 1,
    `desc_text` text,
    `playlist` text
);

SELECT * from vinyl

SELECT * from vinyl_genre

DROP TABLE vinyl_genre

DROP TABLE vinyl_gender

CREATE Table vinyl_genre (
    `id` integer PRIMARY KEY AUTO_INCREMENT,
    genre varchar(20)
)
-- INSERT INTO vinyl_genre(genre,gender) VALUES (,)

SELECT * FROM vinyl_gender

CREATE Table vinyl_gender (
    id INT AUTO_INCREMENT PRIMARY KEY,
    genre_id int,
    gender VARCHAR(10)
)

DROP TABLE vinyl_author

SELECT * FROM vinyl_author

CREATE Table vinyl_author (
    `id` integer PRIMARY KEY AUTO_INCREMENT,
    author varchar(100)
)

-- INSERT INTO vinyl_author(author) VALUES ()

DROP Table vinyl_status

CREATE Table vinyl_status (
    `id` integer PRIMARY KEY,
    status VARCHAR(10)
)

SELECT * FROM vinyl_status

INSERT INTO
    vinyl_status (id, status)
VALUES (0, "下架"),
    (1, "上架"),
    (2, "預購"),
    (3, "完售")

DROP TABLE vinyl_img

SELECT * FROM vinyl_img

CREATE TABLE vinyl_img (
    `id` integer PRIMARY KEY AUTO_INCREMENT,
    shs_id VARCHAR(20),
    img_name VARCHAR(50),
    img_url VARCHAR(100),
    img_path VARCHAR(50)
)

SELECT * FROM vinyl

SELECT
    vinyl.id,
    vinyl.shs_id,
    title,
    vinyl_author.author,
    vinyl_genre.genre,
    vinyl_gender.gender,
    company,
    price,
    release_date,
    stock,
    format,
    vinyl_status.status
FROM
    vinyl
    JOIN vinyl_author on vinyl_author.id = vinyl.author_id
    JOIN vinyl_status on vinyl_status.id = vinyl.status_id
    JOIN vinyl_genre on vinyl_genre.id = vinyl.genre_id
    JOIN vinyl_gender on vinyl_gender.id = vinyl.gender_id

SHOW WARNINGS

SELECT * FROM vinyl_genre

SELECT vinyl_gender.id, vinyl_genre.genre, vinyl_gender.gender
FROM vinyl_gender
    JOIN vinyl_genre ON vinyl_genre.id = vinyl_gender.genre_id;

update vinyl set shs_id = 5125254 where id = 215

update vinyl_img set shs_id = 5125254 where id = 214
USE vinyl

SHOW DATABASE vinyl

DROP TABLE vinyl

CREATE TABLE `vinyl` (
    `id` integer PRIMARY KEY AUTO_INCREMENT,
    `title` varchar(100) NOT NULL,
    `author_id` int,
    `country` varchar(20) DEFAULT null,
    `price` int DEFAULT 1000,
    `genre_id` int,
    `company` varchar(50) DEFAULT null,
    `release_date` date,
    `format` varchar(10),
    `create_date` timestamp DEFAULT CURRENT_TIMESTAMP,
    `stock` int DEFAULT 3,
    `status_id` int DEFAULT 1,
    `desc_text` text,
    `playlist` text
);
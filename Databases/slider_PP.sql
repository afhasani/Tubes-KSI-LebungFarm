CREATE DATABASE slider_PP;

USE slider_PP;

CREATE TABLE sliders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slider_group VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL
);

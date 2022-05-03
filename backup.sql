DROP TABLE album;

CREATE TABLE `album` (
  `al_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(50) NOT NULL,
  `album_img` varchar(50) NOT NULL,
  `album_artist` varchar(50) NOT NULL,
  PRIMARY KEY (`al_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO album VALUES("1","Hollywood\'s Bleeding","./album/hollywood bleeding.png","Post Malone");
INSERT INTO album VALUES("3","Blurryface","./album/blurry face.jpg","21 Pilots");



DROP TABLE artist;

CREATE TABLE `artist` (
  `ar_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_name` varchar(50) NOT NULL,
  `artist_img` varchar(50) NOT NULL,
  PRIMARY KEY (`ar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO artist VALUES("1","Post Malone","./artist/Post Malone.jpg");
INSERT INTO artist VALUES("3","KSI","./artist/KSI.jpg");
INSERT INTO artist VALUES("5","Linked Horizon","./artist/Linked Horizon.jpg");



DROP TABLE media_playlist;

CREATE TABLE `media_playlist` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

INSERT INTO media_playlist VALUES("55","Workout");
INSERT INTO media_playlist VALUES("60","travel");



DROP TABLE music;

CREATE TABLE `music` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `song_name` varchar(255) NOT NULL,
  `song_img` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `song_audio` varchar(255) NOT NULL,
  `artist_img` varchar(255) NOT NULL,
  `album_img` varchar(255) NOT NULL,
  `album` varchar(255) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO music VALUES("1","All My Friends","./$@&/amf.jpg","Madeon","./$@&/All My Friends-Madeon!amf.jpg.mp3","","","");
INSERT INTO music VALUES("2","Disarm","./$@&/ad.jpg","AllttA","./$@&/Disarm-AllttA!ad.jpg.mp3","","","");
INSERT INTO music VALUES("5","Circles","./$@&/pc.jpg","Post Malone","./$@&/Circles-Post Malone!pc.jpg.mp3","./artist/Post Malone.jpg","./album/hollywood bleeding.png","Hollywood\'s Bleeding");
INSERT INTO music VALUES("6","暁の鎮魂歌","./$@&/req.jpg","Linked Horizon","./$@&/暁の鎮魂歌-Linked Horizon!req.jpg.mp3","./artist/Linked Horizon.jpg","","");



DROP TABLE playlist_files;

CREATE TABLE `playlist_files` (
  `pf_id` int(11) NOT NULL AUTO_INCREMENT,
  `media` varchar(255) NOT NULL,
  `playlist` varchar(255) NOT NULL,
  PRIMARY KEY (`pf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO playlist_files VALUES("3","All My Friends","Workout");
INSERT INTO playlist_files VALUES("4","Disarm","travel");
INSERT INTO playlist_files VALUES("5","Circles","travel");
INSERT INTO playlist_files VALUES("10","All My Friends","Workout");
INSERT INTO playlist_files VALUES("11","Disarm","Workout");
INSERT INTO playlist_files VALUES("12","Disarm","Workout");
INSERT INTO playlist_files VALUES("15","暁の鎮魂歌","Workout");



DROP TABLE signup;

CREATE TABLE `signup` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passw` varchar(50) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO signup VALUES("1","Roshan Jadhav","Bruhx","potintramp@gmail.com","Roshan123");
INSERT INTO signup VALUES("2","admin","admin","roshan.lj@somaiya.edu","Admin123");
INSERT INTO signup VALUES("3","Anjali","Anj","anjali.jadhav122001@gmail.com","12345678");
INSERT INTO signup VALUES("4","","","","");
INSERT INTO signup VALUES("5","Roshan Jadhav","yo","asads@gmial.com","Roshan123");




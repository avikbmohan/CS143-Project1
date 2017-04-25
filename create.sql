CREATE TABLE Movie(
       id int, 
       title varchar(100), 
       year int, 
       rating varchar(10), 
       company varchar(50),
       PRIMARY KEY(id),
       CHECK(year > 1880)) ENGINE=INNODB;
CREATE TABLE Actor(
       id int, 
       last varchar(20), 
       first varchar(20), 
       sex varchar(6), 
       dob DATE, 
       dod DATE,
       PRIMARY KEY(id)) ENGINE=INNODB;
CREATE TABLE Sales(
       mid int, 
       ticketsSold int, 
       totalIncome int,
       FOREIGN KEY (mid) references Movie(id),
       CHECK(ticketsSold >=0),
       CHECK(totalIncome >=0)) ENGINE=INNODB;
CREATE TABLE Director(
       id int, 
       last varchar(20), 
       first varchar(20), 
       dob DATE NOT NULL, 
       dod DATE,
       PRIMARY KEY(id)) ENGINE=INNODB;
CREATE TABLE MovieGenre(
       mid int, 
       genre varchar(20),
       FOREIGN KEY (mid) references Movie(id)) ENGINE=INNODB;
CREATE TABLE MovieDirector(
       mid INT, 
       did INT,
       FOREIGN KEY (mid) references Movie(id),
       FOREIGN KEY (did) references Director(id)) ENGINE=INNODB;
CREATE TABLE MovieActor(
       mid int, 
       aid int, 
       role varchar(50),
       FOREIGN KEY (mid) references Movie(id),
       FOREIGN KEY (aid) references Actor(id)) ENGINE=INNODB;
CREATE TABLE MovieRating(
       mid int, 
       imdb int, 
       rot int,
       FOREIGN KEY (mid) references Movie(id),
       CHECK(imdb >=0 AND imdb <=100),
       CHECK(rot >=0 AND rot <=100)) ENGINE=INNODB;
CREATE TABLE Review(
       name varchar(20), 
       time TIMESTAMP, 
       mid int, 
       rating int, 
       comment varchar(500),
       FOREIGN KEY (mid) references Movie(id)) ENGINE=INNODB;
CREATE TABLE MaxPersonID(id int) ENGINE=INNODB;
CREATE TABLE MaxMovieID(id int) ENGINE=INNODB;



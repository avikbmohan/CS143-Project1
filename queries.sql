SELECT CONCAT(first, ' ', last)
FROM Actor INNER JOIN 
(    SELECT mid, aid
     FROM MovieActor INNER JOIN Movie ON MovieActor.mid=Movie.id
     Where Movie.title='Die Another Day') MovieActor2
ON Actor.id=MovieActor2.aid;


SELECT count(aid)
FROM (SELECT aid
      FROM MovieActor
      GROUP BY aid
      HAVING (COUNT(aid) > 1)) M;


SELECT title
FROM Movie INNER JOIN Sales ON Movie.id=Sales.mid
WHERE Sales.ticketsSold>1000000;


SELECT title
FROM Movie INNER JOIN MovieRating ON Movie.id=MovieRating.mid
WHERE MovieRating.imdb>90 AND MovieRating.rot>90;


Select CONCAT(first, ' ', last)
FROM Actor
WHERE dob > date '1999-01-01';


INSERT INTO Actor(id) Values(19);
--This violated the primary key constraint on actor id since 19 already exists

INSERT INTO Movie(id) Values(17);
--This violates the primary key constraint on movie id since 17 exists

INSERT INTO Director(id) Values(16);
--This violates the primary key constrainst on director id since 16 exists.

INSERT INTO MovieGenre(mid) Values(-1);
--The id -1 is not in the Movie table, so this violates the foreign key constraint

INSERT INTO MovieDirector(did) Values(-1);
--The id -1 is not in the Director table, so this violates foreign key

INSERT INTO MovieDirector(mid) Values(-1);
--The id -1 is not in the Movie table, so this violates the foreign key

INSERT INTO MovieActor(mid) Values(-1);
--The id -1 is not in the Movie table, so this violates the foreign key constraint

INSERT INTO MovieActor(aid) Values(-1);
--The id -1 is not in the Actor table, so this violates the foreign key constraint.

INSERT INTO MovieRating(mid, imdb) Values(17, -1);
--The rating of -1 violates the check for being between 0 and 100

INSERT INTO MovieRating(mid, rot) Values(17, 201);
--The rating of 201 violates the check for being between 0 and 100

INSERT INTO Sales(mid, ticketsSold, totalIncome) Values(17, -2, -3);
--This violates the checks on tickets sold and income that say they have to be positive

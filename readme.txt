Queries.sql:
Comments were causing errors, so the desriptions of the queries are given here.
The first three are the queries described in the project spec, in order.
The next one is the titles of movies with a ratiting higher than 90 on
both imdb and Rotten Tomatoes.
The last one is a list of actors names (in 'first last' format) who were
born after January 1, 1999.

Create.sql (constraints):
An explanation of the constrants chosen.
The id values for actor, movie, and director tables were made primary keys,
as they are essential and must be unique.
All references to movie, actor, or director ids in other tables were made
into foreign keys so that they depend on those main three tables.
The rating values were checked to be within 0 and 100 as defined in the spec.
The Sales numbers were checked to be nonnegative, since you can't sell
negative tickets.

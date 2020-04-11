-- tennis app
-- dummy data
-- allan neros

use tennis_app;

-- users 
-- TRUNCATE TABLE tennis_user;
INSERT INTO tennis_user (id,user_login,user_password,user_display_name,user_lat,user_long) VALUES (1,'neros','111','allan',0.0,0.0);
INSERT INTO tennis_user (id,user_login,user_password,user_display_name,user_lat,user_long) VALUES (2,'vinny','111','vinicius',0.0,0.0);
INSERT INTO tennis_user (id,user_login,user_password,user_display_name,user_lat,user_long) VALUES (3,'akira','111','evandro',0.0,0.0);
INSERT INTO tennis_user (id,user_login,user_password,user_display_name,user_lat,user_long) VALUES (4,'floro','111','roberto',0.0,0.0);
SELECT * FROM tennis_user;

-- friends
INSERT INTO tennis_user_relation (user_id_1,user_id_2,user_relation_type) VALUES (1,2,'F');
INSERT INTO tennis_user_relation (user_id_1,user_id_2,user_relation_type) VALUES (1,3,'F');
INSERT INTO tennis_user_relation (user_id_1,user_id_2,user_relation_type) VALUES (1,4,'F');
INSERT INTO tennis_user_relation (user_id_1,user_id_2,user_relation_type) VALUES (2,1,'F');
INSERT INTO tennis_user_relation (user_id_1,user_id_2,user_relation_type) VALUES (3,1,'F');
INSERT INTO tennis_user_relation (user_id_1,user_id_2,user_relation_type) VALUES (4,1,'F');

-- club
-- TRUNCATE TABLE tennis_club;
INSERT INTO tennis_club (club_name,club_address,club_lat,club_long) VALUES ('esperia','sao paulo',0.0,0.0);
INSERT INTO tennis_club (club_name,club_address,club_lat,club_long) VALUES ('ipiranga','sao paulo',0.0,0.0);
SELECT * FROM tennis_club;

-- court
-- TRUNCATE TABLE tennis_court;
INSERT INTO tennis_court (court_club_id,court_name,court_address,court_lat,court_long) VALUES (1,'quadra 1','nao sei',0.0,0.0);
INSERT INTO tennis_court (court_club_id,court_name,court_address,court_lat,court_long) VALUES (1,'quadra 2','nao sei',0.0,0.0);
SELECT * FROM tennis_court;

-- club members
INSERT INTO tennis_user_club (user_id,club_id) VALUES (1,1);
INSERT INTO tennis_user_club (user_id,club_id) VALUES (1,2);
INSERT INTO tennis_user_club (user_id,club_id) VALUES (2,1);

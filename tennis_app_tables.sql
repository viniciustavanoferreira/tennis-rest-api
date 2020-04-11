use tennis_app;

-- usuarios
CREATE TABLE tennis_user (
 id                int NOT NULL AUTO_INCREMENT ,
 user_login        varchar(45) NOT NULL ,
 user_password     varchar(255) NOT NULL ,
 user_display_name varchar(255) NOT NULL ,
 user_lat          double NOT NULL ,
 user_long         double NOT NULL ,

PRIMARY KEY (id)
) COMMENT='user table';

-- relações entre usuarios -> podem ser amigos ou nao 
CREATE TABLE tennis_user_relation (
	id					int 		NOT NULL AUTO_INCREMENT,
    user_id_1			int			NOT NULL,
    user_id_2			int			NOT NULL,
    user_relation_type 	CHAR(1)		NOT NULL DEFAULT 'F',	-- F-> amigo ; B->bloqueado 

PRIMARY KEY (id),
CONSTRAINT fk_relation_user_id_1 FOREIGN KEY idx_user_id_1 (user_id_1) REFERENCES tennis_user (id),
CONSTRAINT fk_relation_user_id_2 FOREIGN KEY idx_user_id_2 (user_id_2) REFERENCES tennis_user (id)
);

-- token para autenticação
CREATE TABLE tennis_token (
 user_id 			int 			NOT NULL AUTO_INCREMENT ,
 token 				varchar(255) 	NOT NULL ,
 token_ip_address	INT				NOT NULL ,
 token_date_created	datetime		NOT NULL ,
 token_date_expire	datetime 		NOT NULL ,

PRIMARY KEY (user_id,token),
CONSTRAINT fk_token_user_id FOREIGN KEY idx_user_id (user_id) REFERENCES tennis_user (id)
);

-- clubes e associações
CREATE TABLE tennis_club (
 id           int NOT NULL AUTO_INCREMENT ,
 club_name    varchar(255) NOT NULL ,
 club_address VARCHAR(2000) NOT NULL ,
 club_lat     double NOT NULL ,
 club_long    double NOT NULL ,

PRIMARY KEY (id)
) COMMENT='clube e associação';

-- quadras
CREATE TABLE tennis_court (
 id            int NOT NULL AUTO_INCREMENT ,
 court_club_id int NOT NULL ,
 court_name    varchar(255) NOT NULL ,
 court_address varchar(2000) NOT NULL ,
 court_lat     double NOT NULL ,
 court_long    double NOT NULL ,

PRIMARY KEY (id),
KEY fk_club_id (court_club_id),
CONSTRAINT fk_club_id FOREIGN KEY idx_club_id (court_club_id) REFERENCES tennis_club (id)
) COMMENT='quadra';

-- times 
CREATE TABLE tennis_match_team (
 team_type    char(1) NOT NULL COMMENT 'H - home / casa A - away / visitante' ,
 team_user_id int NOT NULL ,
 match_id     int NOT NULL 
);

-- partidas
CREATE TABLE tennis_match (
 id             int NOT NULL AUTO_INCREMENT ,
 match_datetime datetime NOT NULL ,
 match_status   char(1) NOT NULL ,
 match_court_id int NOT NULL ,

PRIMARY KEY (id)
);

-- clubes dos usuarios
CREATE TABLE tennis_user_club (
 user_id int NOT NULL ,
 club_id int NOT NULL ,

PRIMARY KEY (user_id, club_id),
CONSTRAINT fk_user_club_id FOREIGN KEY idx_club_id (club_id) REFERENCES tennis_club (id),
CONSTRAINT fk_user_id FOREIGN KEY idx_user_id (user_id) REFERENCES tennis_user (id)
);


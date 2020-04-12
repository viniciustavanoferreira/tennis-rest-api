/*	VIEWS
	Consultas de apoio para facilitar o carregamento das informações no app e na web
*/

use tennis_app;
-- lista de usuarios e seus respectivos amigos
CREATE VIEW uvw_user_friendship 
AS
	-- seleciona todos os amigos de id1 
	SELECT 	R.user_id_1 AS id, U.id AS user_id, U.user_display_name, U.user_lat, U.user_long 
    FROM 	tennis_user_relation R 
			INNER JOIN tennis_user U ON (R.user_id_2 = U.id) 
	WHERE 	R.user_relation_type='F'
    UNION 
	SELECT 	R.user_id_2 AS id, U.id AS user_id, U.user_display_name, U.user_lat, U.user_long 
    FROM 	tennis_user_relation R 
			INNER JOIN tennis_user U ON (R.user_id_1 = U.id) 
	WHERE 	R.user_relation_type='F'
;
-- lista consolidada de amigos - distinct
CREATE VIEW uvw_user_friends 
AS
	SELECT 	DISTINCT F.id, F.user_id, F.user_display_name, F.user_lat, F.user_long
	FROM	uvw_user_friendship F
;

-- lista de usuarios e os clubes que frequenta
CREATE VIEW uvw_user_clubs
AS
	-- lista todos os dados dos clubes vinculados ao usuario (serve para o usuario logado e para perfil)
    SELECT	UC.user_id AS id, UC.club_id, C.club_name, C.club_address, C.club_lat, C.club_long
    FROM	tennis_user_club UC
			INNER JOIN tennis_club C ON (UC.club_id = C.id);

-- lista de clubes e os usuarios vinculados
CREATE VIEW uvw_club_users
AS
	-- lista todos os dados dos clubes vinculados ao usuario (serve para o usuario logado e para perfil)
    SELECT	UC.club_id AS id, UC.user_id, U.user_display_name, U.user_lat, U.user_long
    FROM	tennis_user_club UC
			INNER JOIN tennis_user U ON (UC.user_id = U.id);



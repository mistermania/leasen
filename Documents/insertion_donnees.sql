--supression des objets en 1 er pour eviter les problemes de dépendance
DELETE FROM objet WHERE  1=1; 
--supression des types
DELETE FROM type WHERE 1=1 ;
--supression de l'utilisateur nul
DELETE FROM utilisateur WHERE id_utilisateur = 1;
-- insertion de l'utilisateur type
INSERT INTO utilisateur (id_utilisateur, nom ,prenom) VALUES (1,'Poutou','Philipe');

--insertion des types d'objet
INSERT INTO type (id_type,description_type) VALUES (1,'Vehicule');
INSERT INTO type (id_type,description_type) VALUES (2,'Informatique');
INSERT INTO type (id_type,description_type) VALUES (3,'Console & Jeux video');
INSERT INTO type (id_type,description_type) VALUES (4,'Electromenager');
INSERT INTO type (id_type,description_type) VALUES (5,'Bricolage');
INSERT INTO type (id_type,description_type) VALUES (6,'Ameublement');

--insertion de plusieurs objets pour les testes 
INSERT INTO objet (id_objet,nom_objet,description_objet,a_une_caution,prix_caution,est_payant,prix,o_est_affiche,id_utilisateur,id_type) 
VALUES (1,'Velo','velo tout terrain 3 plateaux 7 vitesses',TRUE, 50, TRUE, 20 , TRUE , 1 ,2);
INSERT INTO objet (id_objet,nom_objet,description_objet,a_une_caution,prix_caution,est_payant,prix,o_est_affiche,id_utilisateur,id_type) 
VALUES (2,'Playstation 4','PS4 + fifa2017',TRUE, 50, TRUE, 10 , TRUE , 1 ,4);
INSERT INTO objet (id_objet,nom_objet,description_objet,a_une_caution,prix_caution,est_payant,prix,o_est_affiche,id_utilisateur,id_type) 
VALUES (3,'Appareil a raclette','Pour 8 personnes ',TRUE, 20, TRUE, 15 , TRUE , 1 ,2);
INSERT INTO objet (id_objet,nom_objet,description_objet,a_une_caution,prix_caution,est_payant,prix,o_est_affiche,id_utilisateur,id_type) 
VALUES (4,'Perceuse','Perceuse filaire avec foret',TRUE, 40, TRUE, 10 , TRUE , 1 ,2);
INSERT INTO objet (id_objet,nom_objet,description_objet,a_une_caution,prix_caution,est_payant,prix,o_est_affiche,id_utilisateur,id_type) 
VALUES (5,'Appareil a pierrade','Pour 6 personnes ',TRUE, 40, TRUE, 5 , TRUE , 1 ,2);


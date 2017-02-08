--CREATE USER leasen NOSUPERUSER NOCREATEDB NOCREATEROLE LOGIN PASSWORD 'root'
-- CREATE DATABASE db_leasen OWNER leasen
------------------------------------------------------------
--        Script Postgre
------------------------------------------------------------



------------------------------------------------------------
-- Table: Utilisateur
------------------------------------------------------------
CREATE TABLE public.Utilisateur(
	id_utilisateur       INT  NOT NULL ,
	nom                  VARCHAR (25)  ,
	prenom               VARCHAR (25)  ,
	date_creation_compte DATE   ,
	e_mail               VARCHAR (100) UNIQUE,
	partager_telephone   BOOL   ,
	telephone            VARCHAR (13),
	hash_mot_de_passe    VARCHAR (256)  ,
	token_regeneration   VARCHAR (512)  UNIQUE,
	date_token           TIMESTAMP   ,
	statut               INT   ,
	raison_ban           VARCHAR (2000)   ,
	CONSTRAINT prk_constraint_Utilisateur PRIMARY KEY (id_utilisateur)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: objet
------------------------------------------------------------
CREATE TABLE public.objet(
	id_objet          INT  NOT NULL ,
	nom_objet         VARCHAR (50)  ,
	description_objet VARCHAR (2000)   ,
	a_une_caution     BOOL   ,
	prix_caution      INT   ,
	est_payant        BOOL   ,
	prix              FLOAT   ,
	o_est_affiche     BOOL   ,
	url_photo         VARCHAR (50)  ,
	id_utilisateur    INT   ,
	id_type           INT   ,
	CONSTRAINT prk_constraint_objet PRIMARY KEY (id_objet)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: location
------------------------------------------------------------
CREATE TABLE public.location(
	id_location    INT  NOT NULL ,
	date_debut     TIMESTAMP   ,
	date_fin       TIMESTAMP   ,
	statut_location INT   ,
	date_demande    DATE   ,
	id_utilisateur  INT   ,
	id_objet        INT   ,
	CONSTRAINT prk_constraint_location PRIMARY KEY (id_location)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: appreciation
------------------------------------------------------------
CREATE TABLE public.appreciation(
	id_appreciation     INT  NOT NULL ,
	notes               INTEGER   ,
	commentaire         VARCHAR (2000)   ,
	a_est_affiche       BOOL   ,
	statut_appreciation INT   ,
	id_location         INT   ,
	CONSTRAINT prk_constraint_appreciation PRIMARY KEY (id_appreciation),
	CONSTRAINT notes_positive CHECK (notes > -1)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: type
------------------------------------------------------------
CREATE TABLE public.type(
	id_type          INT  NOT NULL ,
	description_type VARCHAR (2000)   ,
	CONSTRAINT prk_constraint_type PRIMARY KEY (id_type)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: question
------------------------------------------------------------
CREATE TABLE public.question(
	id_question      INT  NOT NULL ,
	contenu_question VARCHAR (2000)   ,
	date_question    TIMESTAMP   ,
	id_utilisateur   INT   ,
	id_objet         INT   ,
	id_question_mere INT   ,
	CONSTRAINT prk_constraint_question PRIMARY KEY (id_question)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: signalement
------------------------------------------------------------
CREATE TABLE public.signalement(
	id_signalement             INT  NOT NULL ,
	motif_signalement          VARCHAR (2000)   ,
	est_signalement_objet        BOOL   ,
	est_signalement_appreciation BOOL   ,
	a_ete_traite                 BOOL   ,
	id_utilisateur               INT   ,
	date_traitement              TIMESTAMP   ,
	commentaire_traitement       VARCHAR (2000)   ,
	a_banni_utilisateur         BOOL   ,
	a_supprime_appreciation    BOOL   ,
	a_supprime_objet           BOOL   ,
	id_utilisateur_modo          INT   ,
	id_objet                     INT   ,
	id_appreciation              INT   ,
	id_question                INT   ,
	CONSTRAINT prk_constraint_signalement PRIMARY KEY (id_signalement)
)WITHOUT OIDS;



------------------------------------------------------------
-- Table: demande_objet
------------------------------------------------------------
CREATE TABLE public.demande_objet(
	id_demande_objet   INT  NOT NULL ,
	date_demande_objet DATE   ,
	descriptionDemande VARCHAR (25)  ,
	titre_demande      VARCHAR (25)  ,
	id_utilisateur     INT   ,
	id_type            INT   ,
	CONSTRAINT prk_constraint_demande_objet PRIMARY KEY (id_demande_objet)
)WITHOUT OIDS;



ALTER TABLE public.objet ADD CONSTRAINT FK_objet_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.objet ADD CONSTRAINT FK_objet_id_type FOREIGN KEY (id_type) REFERENCES public.type(id_type);
ALTER TABLE public.location ADD CONSTRAINT FK_location_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.location ADD CONSTRAINT FK_location_id_objet FOREIGN KEY (id_objet) REFERENCES public.objet(id_objet);
ALTER TABLE public.appreciation ADD CONSTRAINT FK_appreciation_id_location FOREIGN KEY (id_location) REFERENCES public.location(id_location);
ALTER TABLE public.question ADD CONSTRAINT FK_question_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.question ADD CONSTRAINT FK_question_id_objet FOREIGN KEY (id_objet) REFERENCES public.objet(id_objet);
ALTER TABLE public.question ADD CONSTRAINT FK_question_id_question_mere FOREIGN KEY (id_question_mere) REFERENCES public.question(id_question);
ALTER TABLE public.signalement ADD CONSTRAINT FK_signalement_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.signalement ADD CONSTRAINT FK_signalement_id_utilisateur_modo FOREIGN KEY (id_utilisateur_modo) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.signalement ADD CONSTRAINT FK_signalement_id_objet FOREIGN KEY (id_objet) REFERENCES public.objet(id_objet);
ALTER TABLE public.signalement ADD CONSTRAINT FK_signalement_id_appreciation FOREIGN KEY (id_appreciation) REFERENCES public.appreciation(id_appreciation);
ALTER TABLE public.signalement ADD CONSTRAINT FK_signalement_id_question FOREIGN KEY (id_question) REFERENCES public.question(id_question);
ALTER TABLE public.demande_objet ADD CONSTRAINT FK_demande_objet_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.demande_objet ADD CONSTRAINT FK_demande_objet_id_type FOREIGN KEY (id_type) REFERENCES public.type(id_type);

CREATE VIEW moderateur AS SELECT * FROM utilisateur WHERE (statut > 0);
CREATE INDEX index_statut ON utilisateur (statut);
	CREATE VIEW recherche AS  SELECT
description_type,objet.id_objet,objet.nom_objet,objet.description_objet,objet.prix,objet.prix_caution,objet.o_est_affiche,type.id_type  FROM Objet  RIGHT JOIN type ON type.id_type=objet.id_type;

CREATE VIEW appreciations_v as SELECT location.id_utilisateur as id_loueur,objet.id_utilisateur as id_preteur,appreciation.notes,appreciation.commentaire,appreciation.a_est_affiche,appreciation.statut_appreciation,objet.id_objet FROM appreciation LEFT JOIN location on appreciation.id_location=location.id_location  LEFT JOIN objet on location.id_objet=objet.id_objet;

INSERT INTO utilisateur (id_utilisateur, nom ,prenom) VALUES (1,'Poutou','Philipe');
INSERT INTO location (id_location) VALUES (1);
INSERT INTO objet (id_objet,nom_objet,description_objet,a_une_caution,prix_caution,est_payant,prix,o_est_affiche,id_utilisateur,id_type) 
VALUES (1,'Velo','velo tout terrain 3 plateaux 7 vitesses',TRUE, 50, TRUE, 20 , TRUE , 1 ,2);
INSERT INTO objet (id_objet,nom_objet,description_objet,a_une_caution,prix_caution,est_payant,prix,o_est_affiche,id_utilisateur,id_type) 
VALUES (2,'Playstation 4','PS4 + fifa2017',TRUE, 50, TRUE, 10 , TRUE , 1 ,4);
INSERT INTO objet (id_objet,nom_objet,description_objet,a_une_caution,prix_caution,est_payant,prix,o_est_affiche,id_utilisateur,id_type) 
VALUES (3,'Appareil a raclette','Pour 8 personnes ',TRUE, 20, TRUE, 15 , TRUE , 1 ,2);
INSERT INTO objet (id_objet,nom_objet,description_objet,a_une_caution,prix_caution,est_payant,prix,o_est_affiche,id_utilisateur,id_type) 
VALUES (4,'Perceuse','Perceuse filaire avec foret',TRUE, 40, TRUE, 10 , TRUE , 1 ,2);
INSERT INTO type (id_type,description_type) VALUES (1,'Vehicule');
INSERT INTO type (id_type,description_type) VALUES (2,'Informatique');
INSERT INTO type (id_type,description_type) VALUES (3,'Console & Jeux video');
INSERT INTO type (id_type,description_type) VALUES (4,'Electromenager');
INSERT INTO type (id_type,description_type) VALUES (5,'Bricolage');
INSERT INTO type (id_type,description_type) VALUES (6,'Ameublement');
INSERT INTO Question (id_question) VALUES (1);
INSERT INTO demande_objet (id_demande_objet) values (1);
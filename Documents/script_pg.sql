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

CREATE VIEW recherche_location 
AS SELECT location.id_objet, location.date_debut, location.date_fin, location.statut_location, location.id_utilisateur, objet.nom_objet
FROM location INNER JOIN objet ON location.id_objet=objet.id_objet;

CREATE VIEW recherche_message 
AS SELECT objet.id_objet, objet.id_utilisateur, objet.nom_objet, 
location.statut_location, location.date_debut, location.date_fin, location.id_utilisateur AS id_loueur,
utilisateur.nom
FROM objet INNER JOIN location ON objet.id_objet=location.id_objet
INNER JOIN utilisateur ON objet.id_utilisateur=utilisateur.id_utilisateur;

CREATE VIEW recherche_question
AS SELECT id_question,
	contenu_question ,
	date_question ,
	utilisateur.id_utilisateur ,
	id_objet ,
	utilisateur.nom, utilisateur.prenom
FROM question INNER JOIN utilisateur ON question.id_utilisateur= utilisateur.id_utilisateur;



INSERT INTO utilisateur (id_utilisateur) VALUES (1);
INSERT INTO location (id_location) VALUES (1);
INSERT INTO type(id_type) VALUES (1);
INSERT INTO Question (id_question) VALUES (1);
INSERT INTO demande_objet (id_demande_objet) values (1);

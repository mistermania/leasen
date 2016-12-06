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
	est_ban              BOOL   ,
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
	est_accepte    BOOL   ,
	id_utilisateur INT   ,
	id_objet       INT   ,
	CONSTRAINT prk_constraint_location PRIMARY KEY (id_location)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: appreciation
------------------------------------------------------------
CREATE TABLE public.appreciation(
	id_appreciation INT  NOT NULL ,
	notes           INTEGER   ,
	commentaire     VARCHAR (2000)   ,
	est_preteur     BOOL   ,
	est_loueur      BOOL   ,
	a_est_affiche   BOOL   ,
	id_location     INT   ,
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
-- Table: signal
------------------------------------------------------------
CREATE TABLE public.signal(
	id_signalement               INT  NOT NULL ,
	motif_signalement            VARCHAR (2000)   ,
	est_signalement_objet        BOOL   ,
	est_signalement_appreciation BOOL   ,
	a_ete_traite                 BOOL   ,
	id_utilisateur               INT   ,
	date_traitement              TIMESTAMP   ,
	commentaire_traitement       VARCHAR (2000)   ,
	a_banni_utilisateur          BOOL   ,
	a_supprime_appreciation      BOOL   ,
	a_supprime_objet             BOOL   ,
	id_utilisateur_modo          INT   ,
	id_objet                     INT   ,
	id_appreciation              INT   ,
	CONSTRAINT prk_constraint_signal PRIMARY KEY (id_signalement)
)WITHOUT OIDS;



ALTER TABLE public.objet ADD CONSTRAINT FK_objet_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.objet ADD CONSTRAINT FK_objet_id_type FOREIGN KEY (id_type) REFERENCES public.type(id_type);
ALTER TABLE public.location ADD CONSTRAINT FK_location_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.location ADD CONSTRAINT FK_location_id_objet FOREIGN KEY (id_objet) REFERENCES public.objet(id_objet);
ALTER TABLE public.appreciation ADD CONSTRAINT FK_appreciation_id_location FOREIGN KEY (id_location) REFERENCES public.location(id_location);
ALTER TABLE public.question ADD CONSTRAINT FK_question_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.question ADD CONSTRAINT FK_question_id_objet FOREIGN KEY (id_objet) REFERENCES public.objet(id_objet);
ALTER TABLE public.question ADD CONSTRAINT FK_question_id_question_mere FOREIGN KEY (id_question_mere) REFERENCES public.question(id_question);
ALTER TABLE public.signal ADD CONSTRAINT FK_signal_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.signal ADD CONSTRAINT FK_signal_id_utilisateur_modo FOREIGN KEY (id_utilisateur_modo) REFERENCES public.Utilisateur(id_utilisateur);
ALTER TABLE public.signal ADD CONSTRAINT FK_signal_id_objet FOREIGN KEY (id_objet) REFERENCES public.objet(id_objet);
ALTER TABLE public.signal ADD CONSTRAINT FK_signal_id_appreciation FOREIGN KEY (id_appreciation) REFERENCES public.appreciation(id_appreciation);
CREATE VIEW moderateur AS SELECT * FROM utilisateur WHERE (statut > 0);
CREATE INDEX index_statut ON utilisateur (statut);

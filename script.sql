CREATE TABLE Users(
   id_user INT AUTO_INCREMENT,
   Nom VARCHAR(50) NOT NULL,
   Prenom VARCHAR(50) NOT NULL,
   Groupe VARCHAR(50) NOT NULL,
   Formation VARCHAR(50),
   Sous_groupe VARCHAR(50),
   Est_admin BOOL NOT NULL,
   id_vehicule INT,
   username VARCHAR(50) NOT NULL,
   psswd VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_user),
   UNIQUE(id_vehicule),
   UNIQUE(username)
);

CREATE TABLE Vehicule(
   id_vehicule INT AUTO_INCREMENT,
   id_user INT NOT NULL,
   Type VARCHAR(50) NOT NULL,
   Nb_place INT NOT NULL,
   Imatriculation VARCHAR(50) NOT NULL,
   Controle_technique DATE NOT NULL,
   Assurance VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_vehicule),
   UNIQUE(id_user)
);

CREATE TABLE Info_univ(
   id_user INT,
   deb_lundi TIME,
   deb_mardi TIME,
   deb_mercredi TIME,
   deb_jeudi TIME,
   deb_vendredi TIME,
   deb_samedi TIME,
   fin_lundi TIME,
   fin_mardi TIME,
   fin_mercredi TIME,
   fin_jeudi TIME,
   fin_venndredi TIME,
   fin_samedi TIME,
   PRIMARY KEY(id_user)
);

CREATE TABLE Course(
   id_course INT AUTO_INCREMENT,
   id_conducteur INT NOT NULL,
   DH_départ DATETIME NOT NULL,
   DH_arrive DATETIME NOT NULL,
   Place_dispo INT,
   Nb_place_disponible INT NOT NULL,
   Prix INT,
   id_lieux_départ INT NOT NULL,
   id_lieux_arrivé INT NOT NULL,
   PRIMARY KEY(id_course),
   UNIQUE(id_conducteur)
);

CREATE TABLE Lieux(
   id_lieux INT AUTO_INCREMENT,
   Nom VARCHAR(50),
   Ville VARCHAR(50) NOT NULL,
   CP INT NOT NULL,
   Rue VARCHAR(50) NOT NULL,
   Numéro INT,
   Type VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_lieux)
);

CREATE TABLE Equipage(
   id_course INT,
   id_user INT,
   PRIMARY KEY(id_course, id_user)
);

CREATE TABLE Habitation(
   id_user INT,
   id_lieux INT,
   PRIMARY KEY(id_user, id_lieux)
);
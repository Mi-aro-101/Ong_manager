create table ONGMere(
    idONGMere INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    denomination VARCHAR(40),
    dateDeCreation DATE not null,
    nationaliteONG VARCHAR(50) not null,
    numeroEnregistrement VARCHAR(50) not null,
    objectifStatuaire VARCHAR(200) not null,
    domaineActivite VARCHAR(40) not null,
    effectifMembres INT not null,
    modeDonationFinanciere VARCHAR(50) not null,
    organigramme VARCHAR(70)
);

create table PaysInterventions(
    idPaysIntervention INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    idONGMere INT NOT NULL REFERENCES ONGMere(idONGMere),
    nom VARCHAR(50) not null
);

create table SituationMatrimoniale(
    idSituationMatrimoniale INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    designation VARCHAR(30) NOT NULL
);

create table Individu(
    idIndividu INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    idONGMere INT NOT NULL REFERENCES ONGMere(idONGMere),
    nom VARCHAR(50) not null,
    prenom VARCHAR(50) not null,
    dateDeNaissance DATE not null,
    lieuNaissance VARCHAR(50) not null,
    nationaliteIndividu VARCHAR(50) not null,
    idSituationMatrimoniale INTEGER not null REFERENCES SituationMatrimoniale (idSituationMatrimoniale),
    adressePersonelle VARCHAR(50) not null,
    emploi VARCHAR(50) default null,
    societeEmployeur VARCHAR(50) default null,
    adresseEmployeur VARCHAR(50) default null,
    experienceHumanitaire VARCHAR(200) default null,
    telephone VARCHAR(30) not null,
    mail VARCHAR(50) not null,
);

create table IndividuRole(
    idIndividuRole INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    idIndividu INT NOT NULL REFERENCES Individu(idIndividu),
    idONGMere INT NOT NULL REFERENCES ONGMere(idONGMere),
    fonction INT NOT NULL --0 President et 1 pour representant
);

create table Projet(
    idProjet INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    idONGMere INT NOT NULL REFERENCES ONGMere(idONGMere),
    titre VARCHAR(30) not null,
    objectifPrincipal VARCHAR(50) not null,
    objectifSpecifique VARCHAR(50) not null,
    activite VARCHAR(50) not null,
    resultatAttendu VARCHAR(50) not null,
    province VARCHAR(50) not null,
    region VARCHAR(50) not null,
    district VARCHAR(50) not null,
    commune VARCHAR(50) not null,
    fokotany VARCHAR(50) not null,
    populationBeneficiaire VARCHAR(50) not null,
    coutEstimatif NUMERIC not null,
    sourceDeFinancement VARCHAR(50) not null
);

create table moyenHumain(
    idMoyenHumain INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    idONGMere INT NOT NULL REFERENCES ONGMere(idONGMere),
    designationHumain VARCHAR(50) NOT NULL
);

create table moyenMateriel(
    idMoyenMateriel INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
    idONGMere INT NOT NULL REFERENCES ONGMere(idONGMere),
    designationMateriel VARCHAR(50) NOT NULL
);
create table Objectif
(
    idObjectif int auto_increment,
    titreDuProjet VARCHAR(10),objectifPrincipal VARCHAR(50),objectifSpecifique VARCHAR(250),
    activite VARCHAR(100),resultatsAttendues VARCHAR(400),region
    VARCHAR(35),district VARCHAR(35),fokotany VARCHAR(35),populationBeneficiaire VARCHAR(35),
    cout int,financement VARCHAR(100),
    moyensHumain VARCHAR(100), materiels VARCHAR(50),
    PRIMARY KEY(idObjectif)
);

INSERT INTO SituationMatrimoniale (designation) VALUES
    ('Celibataire'),
    ('Marie(e)'),
    ('Divorce(e)'),
    ('Veuf(Veuve)');

INSERT INTO ONGMere (denomination, dateDeCreation, nationalite, numeroEnregistrement, objectifStatuaire, domaineActivite, effectifMembres, modeDonationFinanciere, organigramme) values (
        'Hello',
        '2022-02-02',
        'Madagascar',
        '90OP09',
        'Manao orinasa',
        'Industriel',
        120,
        'Ariary',
        'LP'
    );

INSERT INTO Individu (idONGMere, nom, prenom, dateDeNaissance, lieuNaissance, nationalite, idSituationMatrimoniale, adressePersonelle, emploi, societeEmployeur, adresseEmployeur, experienceHumanitaire, telephone, mail)
values (
    28,
    'RAKOTO',
    'Nandra San',
    '1999-02-20',
    'Antsirabe',
    'Madagascat=r',
    1,
    'Lot IPP 560',
    'Developpeur',
    'SAYNA',
    'Lot IPU tanjombato',
    'Oeuvre de charite',
    '032 02 222 22',
    'givesome@live.com'
);
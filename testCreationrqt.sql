SELECT M.libelle
FROM matiere M
JOIN cours C ON M.id_matiere = C.id_matiere
JOIN filiere F ON F.id_filiere = C.id_filiere
WHERE F.id_filiere = 44;

// rqt 1 etudiant
SELECT M.libelle, C.date_debut
FROM matiere M
JOIN cours C ON M.id_matiere = C.id_matiere
JOIN absence A ON A.id_cours = C.id_cours
WHERE A.ine = "azertyuiop123";


SELECT A.ine, E.nom, E.prenom, M.libelle, C.date_debut, C.date_fin, A.justifier
FROM etudiant E
JOIN absence A ON A.ine = E.ine
JOIN cours C ON A.id_cours = C.id_cours
JOIN matiere M ON C.id_matiere = M.id_matiere
WHERE C.id_filiere = '14' AND C.libelle_groupe = 'TD01'

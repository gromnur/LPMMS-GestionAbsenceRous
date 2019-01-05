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

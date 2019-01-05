SELECT M.libelle
FROM matiere M
JOIN cours C ON M.id_matiere = C.id_matiere
JOIN filiere F ON F.id_filiere = C.id_filiere
WHERE F.id_filiere = 44;

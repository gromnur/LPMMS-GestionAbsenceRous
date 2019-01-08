/**
 * 
 *  
 *  TABLE
 *  
 *    
 */

//TRI TABLE 
/**
 * jQuery.fn.sortElements
 * --------------
 * @author James Padolsey (http://james.padolsey.com)
 * @version 0.11
 * @updated 18-MAR-2010
 * --------------
 * @param Function comparator:
 *   Exactly the same behaviour as [1,2,3].sort(comparator)
 *   
 * @param Function getSortable
 *   A function that should return the element that is
 *   to be sorted. The comparator will run on the
 *   current collection, but you may want the actual
 *   resulting sort to occur on a parent or another
 *   associated element.
 *   
 *   E.g. $('td').sortElements(comparator, function(){
 *      return this.parentNode; 
 *   })
 *   
 *   The <td>'s parent (<tr>) will be sorted instead
 *   of the <td> itself.
 */
jQuery.fn.sortElements = (function () {

    var sort = [].sort;

    return function (comparator, getSortable) {

        getSortable = getSortable || function () {
            return this;
        };

        var placements = this.map(function () {

            var sortElement = getSortable.call(this),
                    parentNode = sortElement.parentNode,
                    // Since the element itself will change position, we have
                    // to have some way of storing it's original position in
                    // the DOM. The easiest way is to have a 'flag' node:
                    nextSibling = parentNode.insertBefore(
                            document.createTextNode(''),
                            sortElement.nextSibling
                            );

            return function () {

                if (parentNode === this) {
                    throw new Error(
                            "You can't sort elements if any one is a descendant of another."
                            );
                }

                // Insert before flag:
                parentNode.insertBefore(this, nextSibling);
                // Remove flag:
                parentNode.removeChild(nextSibling);

            };

        });

        return sort.call(this, comparator).each(function (i) {
            placements[i].call(getSortable.call(this));
        });

    };

})();

var table = $('#latable');
$('#nom, #prenom, #matiere, #ine, #date')
        .wrapInner('<span title="sort this column"/>')
        .each(function () {

            var th = $(this),
                    thIndex = th.index(),
                    inverse = false;

            th.click(function () {

                table.find('td').filter(function () {

                    return $(this).index() === thIndex;

                }).sortElements(function (a, b) {

                    if ($.text([a]) == $.text([b]))
                        return 0;

                    return $.text([a]) > $.text([b]) ?
                            inverse ? -1 : 1
                            : inverse ? 1 : -1;

                }, function () {

                    // parentNode is the element we want to move
                    return this.parentNode;

                });

                inverse = !inverse;

            });

        });
//FIN TRI TABLE 

//etudiant en fonction de filiere et du groupe
// insertion dans la table des etudiants correspondants a une filière et un grp choisi lors du changement du groupe
$('#groupeCombox').change(function () {
    var filiere = $("#filiereCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    var groupe = $("#groupeCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (groupe != "null") {
        // ajax fait appel a la fonction selectAvecFiliereGroupeEtudiant de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectEtudByGrpFil', paramFiliere: filiere, paramGrp: groupe},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var tbody = '';
                for (var laDonnee in data) {
                    tbody = tbody + '<tr><td>' + data[laDonnee]['ine'] + '</td><td>' + data[laDonnee]['nom'] + '</td><td>' + data[laDonnee]['prenom'] + '</td></tr>';
                }
                $('#tbodyListeEtudiants').html(tbody);
            }
        });
    }
});
// ajout absences etudiant en fonction de la matiere et de la date
// insertion dans la table des etudiants correspondants a une filière et un grp choisi lors du changement du groupe
$('#dateComboxAbs').change(function () {
    var date = $("#dateComboxAbs").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (date != "null") {
        // ajax fait appel a la fonction selectAvecFiliereGroupeEtudiant de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectEtudByDate', param: date},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var tbody = '';
                for (var laDonnee in data) {
                    tbody = tbody + '<tr><td>' + data[laDonnee]['nom'] + '</td> <td>' + data[laDonnee]['prenom'] + '</td><td> <input name="absences[]" type="checkbox" value="' + data[laDonnee]['ine'] + '" />' +
                            '<input name="id_cours" value="' + date + '" type="hidden"/></td>' + '<td> <input name="justifie[]" type="checkbox" value="1" /></td></tr>';
                }
                $('#tbodyListeEtudiantsAbs').html(tbody);
            }
        });
    }
});
//TABLE MATIERE en fonction de filiere
// insertion dans combobox groupe des groupes correspondants a une filière choisie lors du changement de filiere
$('#filiereCombox').change(function () {
    var filiere = $("#filiereCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (filiere != "null") {
        // ajax fait appel a la fonction selectMatiereWithFiliere de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectMatiereByFiliere', param: filiere},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var tbody = '';
                for (var laDonnee in data) {
                    tbody = tbody + '<tr><td>' + data[laDonnee]['libelle'] + '</td></tr>';
                }
                $('#tbodyMatiere').html(tbody);
            }
        });
    }
});
//absences d'un etudiant en fonction de son ine + ajout dans combox des matiere et date
$('#etudiantCombox').change(function () {
    var etudiant = $("#etudiantCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    var filiere = $("#filiereCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (etudiant != "null") {
        // ajax fait appel a la fonction selectMatiereWithFiliere de la page ajax.php avec comme paramettre l'ine de l'etudiant
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectAbsByEtud', param: etudiant},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var tbody = '';
                var heure = '<option value="null">Choisir date</option>';
                for (var laDonnee in data) {
                    var justifier = "oui";
                    if (data[laDonnee]['justifier'] == 0) {
                        justifier = "non";
                    }
                    tbody = tbody + '<tr><td>' + data[laDonnee]['libelle'] + '</td><td>' + data[laDonnee]['date_debut'] + '</td> <td>' + data[laDonnee]['date_fin'] + '</td><td>' + justifier + '</td></tr></td></tr>';
                    heure = heure + '<option value=' + data[laDonnee]['date_debut'] + '>' + data[laDonnee]['date_debut'] + '</option>';
                }
                $('#tbodyAbsEtud').html(tbody);
                $('#dateCombox').html(heure);
            }
        });
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectMatiereByFiliere', param: filiere},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var matiere = '<option value="null">Choisir matière</option>';
                for (var laDonnee in data) {
                    matiere = matiere + '<option value=' + data[laDonnee]['id_matiere'] + '>' + data[laDonnee]['libelle'] + '</option>';
                }
                $('#matiereCombox').html(matiere);
            }
        });
    }
});


//filtre de la table au dessus, qui permet d'afficher les absences d'un etudiant,
//en fonction de la matiere
$('#matiereCombox').change(function () {
    var matiere = $("#matiereCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    var etudiant = $("#etudiantCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (matiere != "null") {
        // ajax fait appel a la fonction selectMatiereWithFiliere de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectAbsByEtudMatiere', paramMat: matiere, paramEtud: etudiant},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var tbody = '';
                for (var laDonnee in data) {
                    var justifier = "oui";
                    if (data[laDonnee]['justifier'] == 0) {
                        justifier = "non";
                    }
                    tbody = tbody + '<tr><td>' + data[laDonnee]['libelle'] + '</td><td>' + data[laDonnee]['date_debut'] + '</td> <td>' + data[laDonnee]['date_fin'] + '</td><td>' + justifier + '</td></tr></td></tr>';
                }
                $('#tbodyAbsEtud').html(tbody);
            }
        });
    }else{
         $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectAbsByEtud', param: etudiant},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var tbody = '';
                var heure = '';
                for (var laDonnee in data) {
                    var justifier = "oui";
                    if (data[laDonnee]['justifier'] == 0) {
                        justifier = "non";
                    }
                    tbody = tbody + '<tr><td>' + data[laDonnee]['libelle'] + '</td><td>' + data[laDonnee]['date_debut'] + '</td> <td>' + data[laDonnee]['date_fin'] + '</td><td>' + justifier + '</td></tr></td></tr>';
                }
                $('#tbodyAbsEtud').html(tbody);
            }
        });
    }
});

//liste des absences en fonction de filiere et du groupe
// insertion dans la table des absences correspondants a une filière et un grp choisi lors du changement du groupe
$('#groupeComboxListeAbs').change(function () {
    var filiere = $("#filiereComboxListeAbs").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    var groupe = $("#groupeComboxListeAbs").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (groupe != "null") {
        // ajax fait appel a la fonction selectMatiereWithFiliere de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectAbsByGrpFil', paramFil: filiere, paramGrp: groupe},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var tbody = '';
                for (var laDonnee in data) {
                    var justifier = "oui";
                    if (data[laDonnee]['justifier'] == 0) {
                        justifier = "non";
                    }
                    tbody = tbody + '<tr><td>' + data[laDonnee]['ine'] + '</td><td>' + data[laDonnee]['nom'] + '</td><td>' + data[laDonnee]['prenom'] + '</td><td>' + data[laDonnee]['libelle'] + '</td><td>' + data[laDonnee]['date_debut'] + '</td> <td>' + data[laDonnee]['date_fin'] + '</td><td>' + justifier + '</td></tr></td></tr>';
                }
                $('#tbodyListeAbsences').html(tbody);
            }
        });
    }
});


/**
 * 
 *  
 *  COMBO BOX
 *  
 *    
 */


////FILIERE
// insertion dans combobox filiere des filieres correspondantes a un departement choisi lors du changement de departement
$('#deptCombox').change(function () {
    var departement = $("#deptCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (departement != "null") {
        // ajax fait appel a la fonction selectFiliereByDept de la page ajax.php avec comme paramettre l'id du departement 
        // dans data, func sert a savoir quelle fonction de la page test.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectFiliereByDept', param: departement},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir filière</option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['id_filiere'] + '>' + data[laDonnee]['libelle'] + '</option>';
                }
                $('#filiereCombox').html(lesOptions);
            }
        });
    }
});
////FILIERE
// insertion dans combobox filiere des filieres correspondantes a un departement choisi lors du changement de departement
$('#deptCombox').change(function () {
    var departement = $("#deptCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (departement != "null") {
        // ajax fait appel a la fonction selectFiliereByDept de la page ajax.php avec comme paramettre l'id du departement 
        // dans data, func sert a savoir quelle fonction de la page test.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectFiliereByDept', param: departement},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir filière</option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['id_filiere'] + '>' + data[laDonnee]['libelle'] + '</option>';
                }
                $('#filiereComboxListeAbs').html(lesOptions);
            }
        });
    }
});
//GROUPE en fonction de filiere
// insertion dans combobox groupe des groupes correspondants a une filière choisie lors du changement de filiere
$('#filiereCombox').change(function () {
    var filiere = $("#filiereCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (filiere != "null") {
        // ajax fait appel a la fonction selectAvecFiliereGroupeEtudiant de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectGrpByFiliere', param: filiere},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir groupe</option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['libelle_groupe'] + '>' + data[laDonnee]['libelle_groupe'] + '</option>';
                }
                $('#groupeCombox').html(lesOptions);
            }
        });
    }
});
//GROUPE en fonction de filiere
// insertion dans combobox groupe des groupes correspondants a une filière choisie lors du changement de filiere
$('#filiereCombox').change(function () {
    var filiere = $("#filiereCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (filiere != "null") {
        // ajax fait appel a la fonction selectAvecFiliereGroupeEtudiant de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectGrpByFiliere', param: filiere},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir groupe</option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['libelle_groupe'] + '>' + data[laDonnee]['libelle_groupe'] + '</option>';
                }
                $('#groupeComboxAbs').html(lesOptions);
            }
        });
    }
});
//GROUPE en fonction de filiere
// insertion dans combobox groupe des groupes correspondants a une filière choisie lors du changement de filiere
$('#filiereComboxListeAbs').change(function () {
    var filiere = $("#filiereComboxListeAbs").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (filiere != "null") {
        // ajax fait appel a la fonction selectAvecFiliereGroupeEtudiant de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectGrpByFiliere', param: filiere},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir groupe</option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['libelle_groupe'] + '>' + data[laDonnee]['libelle_groupe'] + '</option>';
                }
                $('#groupeComboxListeAbs').html(lesOptions);
            }
        });
    }
});
//MATIERE en fonction de filiere
// insertion dans combobox groupe des groupes correspondants a une filière choisie lors du changement de filiere
$('#filiereCombox').change(function () {
    var filiere = $("#filiereCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (filiere != "null") {
        // ajax fait appel a la fonction selectMatiereWithFiliere de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectMatiereByFiliere', param: filiere},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir matière</option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['id_matiere'] + '>' + data[laDonnee]['libelle'] + '</option>';
                }
                $('#matiereComboxAbs').html(lesOptions);
            }
        });
    }
});


//etudiant en fonction de filiere et du groupe
// insertion dans combobox groupe des groupes correspondants a une filière choisie lors du changement de filiere
$('#groupeCombox').change(function () {
    var filiere = $("#filiereCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    var groupe = $("#groupeCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (groupe != "null") {
        // ajax fait appel a la fonction selectAvecFiliereGroupeEtudiant de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectEtudByGrpFil', paramFiliere: filiere, paramGrp: groupe},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir etudiant</option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['ine'] + '>' + data[laDonnee]['nom'] + " " + data[laDonnee]['prenom'] + '</option>';
                }
                $('#etudiantCombox').html(lesOptions);
            }
        });
    }
});

//DATE en fonction de matiere
// insertion dans combobox date des date correspondants a une matiere choisie lors du changement de matiere
$('#matiereComboxAbs').change(function () {
    var matiere = $("#matiereComboxAbs").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    var grp = $("#groupeComboxAbs").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    var filiere = $("#filiereCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (matiere != "null") {
        // ajax fait appel a la fonction selectMatiereWithFiliere de la page ajax.php avec comme paramettre l'id de la filiere 
        // dans data, func sert a savoir quelle fonction de la page ajax.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectDateByMatiereFilGrp', paramMatiere: matiere, paramFil: filiere, paramGrp: grp},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir heure</option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['id_cours'] + '>' + data[laDonnee]['date_debut'] + '</option>';
                }
                $('#dateComboxAbs').html(lesOptions);
            }
        });
    }
});







/**
 *  gestion formulaire de connexion
 */

//si la variable formCo n'est pas initialisé alors c'est qu'on est pas dans la page
//ou il y a le formulaire et si on ne renseigne pas tous les champs alors on annule l'envoi
//du formulaire et on affiche une alert
var formCo = document.getElementById('formCo');
if (formCo != null) {
    formCo.addEventListener('submit', function (e) {
        var id = document.getElementById('idCo');
        var mdp = document.getElementById('mdpCo');
        if (id.value.length == 0 || mdp.value.lenght == 0) {
            alert("Veuillez renseigner tout les champs");
            e.preventDefault();
        }
    });
}

/**
 *  gestion formulaire de création personnel
 */

$('#comboxDeptCreaPerso').hide();
$('#comboxFilCreaPerso').hide();


////FILIERE
// insertion dans combobox filiere des filieres correspondantes a un departement choisi lors du changement de departement
$('#comboxDeptCreaPerso').change(function () {
    var departement = $("#comboxDeptCreaPerso").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (departement != "null") {
        // ajax fait appel a la fonction selectFiliereByDept de la page ajax.php avec comme paramettre l'id du departement 
        // dans data, func sert a savoir quelle fonction de la page test.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "Ajax.php",
            data: {func: 'selectFiliereByDept', param: departement},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null"></option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['id_filiere'] + '>' + data[laDonnee]['libelle'] + '</option>';
                }
                $('#filiereComboxCreaPerso').html(lesOptions);
            }
        });
    }
});



//affichage des combobox de choix de departement et de filiere
//si la combobox de choix de personnel est sur administrateur
$('#selectCrea').change(function () {
    var type = $("#selectCrea").find("option:selected").val();
    if (type == 0) {
        $('#comboxDeptCreaPerso').show();
        $('#comboxFilCreaPerso').show();
    } else {
        $('#comboxDeptCreaPerso').hide();
        $('#comboxFilCreaPerso').hide();
    }
})

//si la variable formCo n'est pas initialisé alors c'est qu'on est pas dans la page
//ou il y a le formulaire et si on ne renseigne pas tous les champs alors on annule l'envoi
//du formulaire et on affiche une alert
var formCrea = document.getElementById('formCreaPerso');
if (formCrea != null) {
    formCrea.addEventListener('submit', function (e) {
        var id = document.getElementById('idCreaPerso');
        var mdp = document.getElementById('mdpCreaPerso');
        var nom = document.getElementById('nomCreaPerso');
        var prenom = document.getElementById('prenomCreaPerso');
        var type = $("#comboxDeptCreaPerso").find("option:selected").val();
        if (id.value == "" || mdp.value == "" || nom.value == "" || prenom.value == "" || type.value == "null") {
            alert("Veuillez renseigner tout les champs");
            e.preventDefault();
        }
    });
}

var formDelet = document.getElementById('formDeleteFil');
if (formDelet != null) {
    formDelet.addEventListener('submit', function (e) {
        var date = document.getElementById("date");
//        e.preventDefault();
    });
}


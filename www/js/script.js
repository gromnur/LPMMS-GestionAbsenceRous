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
$('#nom, #prenom, #matiere, #ine')
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
$('#dateCombox').change(function () {
    var date = $("#dateCombox").find("option:selected").val();  // retourne la value associée à l'option selectionnée
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
                    tbody = tbody + '<tr><td>' + data[laDonnee]['nom'] + '</td> <td>' + data[laDonnee]['prenom'] + '</td><td>'
                            + data[laDonnee]['groupe'] + '</td><td> <input name="absences[]" type="checkbox" value="' + data[laDonnee]['ine'] + '" /></td></tr>';
                }
                $('#tbodyListeEtudiants').html(tbody);
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
                    lesOptions = lesOptions + '<option value=' + data[laDonnee]['libelle'] + '>' + data[laDonnee]['libelle'] + '</option>';
                }
                $('#groupeCombox').html(lesOptions);
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
                $('#matiereCombox').html(lesOptions);
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







/**
 *  gestion formulaire de connexion
 */

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



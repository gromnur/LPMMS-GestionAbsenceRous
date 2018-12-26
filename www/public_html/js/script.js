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
$('#nom, #prenom')
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


/**
 * 
 *  
 *  COMBO BOX
 *  
 *    
 */


////FILIERE
// insertion dans combobox filiere des filieres correspondantes a un departement choisi lors du changement de departement
$('#dept').change(function () {
    var departement = $("#dept").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (departement != "null") {
        // ajax fait appel a la fonction selectFiliereByDept de la page test.php avec comme paramettre l'id du departement 
        // dans data, func sert a savoir quelle fonction de la page test.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "test.php",
            data: {func: 'selectFiliereByDept', param: departement},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir filière</option>';
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee][0] + '>' + data[laDonnee][1] + '</option>';
                }
                $('#filiere').html(lesOptions);
            }
        });
    }
});
//GROUPE
// insertion dans combobox groupe des groupe correspondants a une filière choisie lors du changement de filiere
$('#dept').change(function () {
    var departement = $("#dept").find("option:selected").val();  // retourne la value associée à l'option selectionnée
    if (departement != "null") {
        // ajax fait appel a la fonction selectFiliereByDept de la page test.php avec comme paramettre l'id du departement 
        // dans data, func sert a savoir quelle fonction de la page test.php doit etre appelé
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "test.php",
            data: {func: 'selectFiliereByDept', param: departement},
            success: function (data) {
//                creation d'une variable contenant les balises option du resultat de la requete obtenu et insertion dans le select voulu
                var lesOptions = '<option value="null">Choisir groupe</option>'
                for (var laDonnee in data) {
                    lesOptions = lesOptions + '<option value=' + data[laDonnee][0] + '>' + data[laDonnee][1] + '</option>';
                }
                $('#filiere').html(lesOptions);
            }
        });
    }
});



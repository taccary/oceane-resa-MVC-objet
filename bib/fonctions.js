/**
 * Chargement des contenus de modales de modification et de suppression d'un bateau  * @param {*} idBateau : id du bateau à charger
 * @param {*} action : contenu de la modale à charger
 * @param {*} div nom du div à remplir dans la page qui a appelé la fonction
 */
function chargeModaleInfosBateau(idBateau, action, div){
    //console.log(idBateau, action, div);

    var http = new XMLHttpRequest(); // création d'un objet requête HTTP
    url = "pages/chargeModales.php" ;
    postParams = "idBateau="+idBateau+"&action="+action ;

    http.open('POST', url, true); // true pour asynchrone
    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // envoi de paramètres en POST
    http.onreadystatechange = function() { // fonction de callback appelée au changement d'état
        if(http.readyState == 4 && http.status == 200) {
            console.log(http.responseText);
            $(div).html(http.responseText); // remplissage du div
        }
    }
    http.send(postParams); // envoi de la requête
}


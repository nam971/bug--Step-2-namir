//App.start();

//Test API Rest (1 à la  fois)

//Info pour la requete
//On va chercher "l'id" "1" de la table "product" ou "active = true" et on le veut 
//par "titre" "croissant" et on viendra afficher le résultat dans la balise "#main"
/*Rest.get({
    table: "product",
    id:6,
    where: "active = true",
    orderby: "title ASC"
}).done((resp) => {
    $('#main').hide().html("Select : " +resp).fadeIn();
})*/




//Je viens insérer un nouveau produit dont le nom sera "nom du produit" qui sera 
// "actif" et "pas en vente" j'obtiendrai "l'id" à l'issu de l'enregistrement
Rest.post({
    table: "product",
    fields: {
        title: "camion",
        active: true,
        //onsale: true
    }
}).done((resp) => {
    $('#main').hide().html("Insert : " + resp).fadeIn();
})


//Remplace moi dans la table produit, l'id numéro 4 par 
//ce nouveau article dont le nom est "nom du produit", qu'il soit "actif"
// et "en vente"
/*Rest.put({
    table: "product",
    id: 10,
    fields: {
        title: "voiture",
        active: true,
        onsale: false
    }
}).done((resp) => {
    $('#main').hide().html("Update : " + resp).fadeIn();
})*/



//Supprime moi de la table product l'id n°4
/*Rest.delete({
    table: "product",
    id: 9
}).done((resp) => {
    $('#main').hide().html("Delete : " + resp).fadeIn();
})*/
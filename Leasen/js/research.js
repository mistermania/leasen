function request(id_categorie, id_date,id_duree, id_recherche, id_result) {

    var categorie = document.getElementById(id_categorie).value;
    var date = document.getElementById(id_date).value;
    var recherche = document.getElementById(id_recherche).value;
    var duree = document.getElementById(id_duree).value;
    
    if (recherche.length > 2) { // si la chaine est superieur a 2
        var xhr = new getXMLHttpRequest();
        console.log('haha');
        xhr.onreadystatechange = function () {
            //console.log(xhr.readyState);
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                //document.getElementById("loader").style.display = "none";
                read_data(xhr.responseText, id_result);
            } else if (xhr.readyState < 4) {
                //document.getElementById("loader").style.display = "inline";
            }
        }
        xhr.open("POST", "../fonctions/research.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //console.log(recherche);
        xhr.send("categorie=" + categorie + "&recherche=" + recherche + "&date=" + date+ "&duree=" + duree);
    }else{
        //console.log('hoho');
    }
}
function read_data(sData, id_result) {
    var oSelect = document.getElementById(id_result);
    oSelect.innerHTML = sData;

}

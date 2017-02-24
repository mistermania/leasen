function request() {
    var categorie = document.getElementById('categorie').value;
    var date = document.getElementById('date').value;
    var recherche = document.getElementById('recherche').value;
    var duree = document.getElementById('duree').value;
    if (recherche.length > 2) { // si la chaine est superieur a 2
        var xhr = new getXMLHttpRequest();
        console.log('haha');
        xhr.onreadystatechange = function () {
            //console.log(xhr.readyState);
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                //document.getElementById("loader").style.display = "none";
                read_data(xhr.responseText);
            } else if (xhr.readyState < 4) {
                //document.getElementById("loader").style.display = "inline";
            }
        };
        xhr.open("POST", "../fonctions/research.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //console.log(recherche);
        xhr.send("categorie=" + categorie + "&recherche=" + recherche + "&date=" + date + "&duree=" + duree);
    } else {
        //console.log('hoho');
    }
}
function read_data(sData) {
    var oSelect = document.getElementById('result');
    oSelect.innerHTML = sData;

}
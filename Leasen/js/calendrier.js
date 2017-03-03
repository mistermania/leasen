/*
 * Copyright (c) 2017.
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * Created by billaud on 03/03/17.
 */


function calendrier(mois, annee) {
    var id = document.getElementById('id_objet').value;
    console.log(id);
    var xhr = new getXMLHttpRequest();
    console.log('haha');
    xhr.onreadystatechange = function () {
        //console.log(xhr.readyState);
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            //document.getElementById("loader").style.display = "none";
            read_dat(xhr.responseText);
        } else if (xhr.readyState < 4) {
            //document.getElementById("loader").style.display = "inline";
        }
    };
    xhr.open("POST", "../fonctions/ajaxCalendrier.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //console.log(recherche);
    if(mois<0 || annee<0)
    {
        xhr.send("id=" + id);
    }else
    {
        xhr.send("id=" + id + "&year=" + annee + "&month=" + mois);
    }
}

function read_dat(sData) {
    var oSelect = document.getElementById('calendar');
    oSelect.innerHTML = sData;

}
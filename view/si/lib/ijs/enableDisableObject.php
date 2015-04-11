
function enableDisableObject(idObjectMain, idObject){
    if (document.getElementById(idObjectMain).checked == true){
    document.getElementById(idObject).disabled = false;
    }
    if (document.getElementById(idObjectMain).checked == false){
    document.getElementById(idObject).disabled = true;
    }
}

document.getElementById("treatmentDocument").onchange = function () {
    splitPath = this.value.split("\\");
    document.getElementById("uploadFile").innerHTML = splitPath[splitPath.length - 1];
};
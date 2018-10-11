require("bootstrap");
let treatmentDocuments = document.getElementsByClassName("treatmentDocument");
for (let i = 0; i < treatmentDocuments.length; i++){
    treatmentDocuments[i].onchange = function () {
        let splitPath = this.value.split("\\");

        let fileName = "Geen bestand gekozen";

        if (stringContainsValue(splitPath[splitPath.length - 1]))
            fileName = splitPath[splitPath.length - 1];

        this.parentElement.parentElement.getElementsByClassName("uploadFile")[0].innerHTML = fileName;
    };
}

let uploadForms = document.querySelectorAll("[id^='upload']");

for (let i = 0; i < uploadForms.length; i++){
    validateForm(uploadForms[i].id);
}

function stringContainsValue(str) {
    return str !== null && str.trim() !== "";
}
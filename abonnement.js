function generateAgeEnfant() {
    var nbEnfants = document.getElementById("nbEnfants").value;
    var enfantsInputsDiv = document.getElementById("enfantsInputs");

    enfantsInputsDiv.innerHTML = "";

    for (var i = 1; i <= nbEnfants; i++) {
        var label = document.createElement("label");
        label.innerHTML = "Âge de l'enfant " + i + " : ";
        var input = document.createElement("input");
        input.type = "number";
        input.name = "ageEnfant" + i;
        input.min = "0";
        input.required = true;

        enfantsInputsDiv.appendChild(label);
        enfantsInputsDiv.appendChild(input);

        enfantsInputsDiv.appendChild(document.createElement("br"));
    }
}

function addButtonToRow(row) {
    var deleteButton = document.createElement("button");
    deleteButton.textContent = "-";

    deleteButton.style.backgroundColor = "red";
    deleteButton.style.color = "white";
    deleteButton.style.fontWeight = "bold";
    deleteButton.style.borderRadius = "5px";

    deleteButton.addEventListener("click", function () {
      row.remove();
    });
    row.appendChild(deleteButton);
}

function cloneRow(formfield, rowtoclone) {
    // get a reference to the table and the row you want to clone
    var form = document.querySelector("."+formfield);
    var rowToClone = document.querySelector("."+rowtoclone);
    var clonedRow = rowToClone.cloneNode(true);
    form.appendChild(clonedRow);
    addButtonToRow(clonedRow);
}
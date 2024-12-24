let rowIndex = {
    pendidikanTable: 1,
    pelatihanTable: 1,
    seminarTable: 1,
    penghargaanTable: 1,
    organisasiTable: 1,
    pekerjaanTable: 1,
};

function tambahBaris(tableId) {
    var table = document.getElementById(tableId);
    var tbody = table.getElementsByTagName("tbody")[0];
    var newRow = tbody.rows[0].cloneNode(true);
    var inputs = newRow.getElementsByTagName("input");
    var selects = newRow.getElementsByTagName("select");

    // Reset input values
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = "";
        var name = inputs[i].name;
        var newName = name.replace(/\[\d+\]/, "[" + rowIndex[tableId] + "]");
        inputs[i].name = newName;
    }

    // Reset select values
    for (var i = 0; i < selects.length; i++) {
        selects[i].selectedIndex = 0;
        var name = selects[i].name;
        var newName = name.replace(/\[\d+\]/, "[" + rowIndex[tableId] + "]");
        selects[i].name = newName;
    }

    tbody.appendChild(newRow);
    rowIndex[tableId]++;

    // Update the "No" column values
    updateNoColumn(tableId);
}

function updateNoColumn(tableId) {
    var table = document.getElementById(tableId);
    var tbody = table.getElementsByTagName("tbody")[0];
    var rows = tbody.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var noCell = rows[i].getElementsByClassName("no")[0];
        if (noCell) {
            // Cek apakah elemen dengan kelas 'no' ada
            noCell.innerText = i + 1;
        }
    }
}

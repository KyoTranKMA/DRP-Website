function sortSelectOptions(selectId) {
    var select = document.getElementById(selectId);
    var options = select.getElementsByTagName('option');
    var arrOptions = Array.prototype.slice.call(options);
    arrOptions.sort(function (a, b) {
        return a.text.localeCompare(b.text);
    });
    arrOptions.forEach(function (opt) {
        select.appendChild(opt);
    });
}


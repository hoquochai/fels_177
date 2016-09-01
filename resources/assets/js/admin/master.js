$(document).ready(function() {
    $('#listAllUser').DataTable({
        "bPaginate" : false,
        "bInfo": false,
        "bFilter" : false,
    });
});
function confirmDelete(message) {
    return confirm(message);
}

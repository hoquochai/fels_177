$(document).ready(function() {
    $('#listAllUser, #listAllCategory').DataTable({
        "bPaginate" : false,
        "bInfo": false,
        "bFilter" : false,
    });
});
function confirmDelete(message) {
    return confirm(message);
}

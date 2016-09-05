$(document).ready(function() {
    $('#listAllUser, #listAllCategory, #listAllWord').DataTable({
        "bPaginate" : false,
        "bInfo": false,
        "bFilter" : false,
    });
});
function confirmDelete(message) {
    return confirm(message);
}

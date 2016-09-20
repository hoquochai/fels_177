$(document).ready(function() {
    $('#listAllUser, #listAllCategory, #listAllWord, #listAllWordAnswer').DataTable({
        "bPaginate" : false,
        "bInfo": false,
        "bFilter" : false,
    });
});
function confirmDelete(message) {
    return confirm(message);
}

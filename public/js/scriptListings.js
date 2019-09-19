function showDetails(){
    $.get("./api/presence/students/", function (data, status) {
        $('.programme tr').remove();
        if(data.length == 0){
            $('.programme').append('<tr><td>Aucun programme</td></tr>');
        }else{
            $.each(data,function(){
                $('.programme').append(
                    '<tr class="'+this.id+'">' +
                        '<td><b>'+this.matricule+'</b></td>' +
                        '<td>'+(this.nom).toUpperCase()+'</td>' +
                        '<td>'+(this.prenom).toUpperCase()+'</td>' +
                        '<td>1/2</td>' +
                    '</tr>');
            });
        }
    });
}
//showDetails();
$(document).ready(function() {
$('#table_id').DataTable({
    "order": [[ 0, "asc" ]],
     "columnDefs": [{ targets: 'no-sort', orderable: false }],
     searching: false,
     language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }
});
});
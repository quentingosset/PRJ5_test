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

function changeTypePresence(event,matricule, idseance){
    let groupe = $('.listeGroupe').val();
    let course = $('.listeCourse').val();
    
    let presence = event.target.getAttribute('data-presence');
    presence = (presence+1)%3;
    switch(presence){
        case 0: 
            event.target.className = "sceance bg-danger";
            event.target.setAttribute('data-presence',presence);
            break;
        case 1 :
            event.target.className = "sceance bg-success";
            event.target.setAttribute('data-presence',presence);
            break;
        case 2 :
            event.target.className = "sceance bg-warning";
            event.target.setAttribute('data-presence',presence);
            break;
    }
    let token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: './api/presence',
         type: 'post',
         data: {
            "student" : matricule,
            "groupe" : groupe,
            "course" : course,
            "type" : presence,
            "seance" : idseance,
            "_token" : token,
         },
         success: function(result){
            console.log("SUCCESS",result);
         }
     });
}

function selectedListe(){
    let groupe = $('.listeGroupe').val();
    let course = $('.listeCourse').val();
    if(groupe != null && course != null){
        location.href = "presence?groupe="+groupe+"&course=" +course;
    }
}

function addPresence(){
    let presenceDate = $('#formPresence_date').val();
    let presenceCourse = $('#formPresence_course').val();
    let presenceGroupe = $('#formPresence_groupe').val();
    $('.buttonAddPresence').hide();
    $('.dismissAddPresence').hide();
    $('.buttonAddPresenceWait').show();
    let token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: './api/seance',
         type: 'post',
         data: {
            "date" : presenceDate,
            "course" : presenceCourse,
            "group" : presenceGroupe,
            "_token" : token,
         },
         success: function(result){
             if(result == true){
                location.reload();
             }else{
                 alert("Probleme");
                 $('.buttonAddPresence').show();
                 $('.dismissAddPresence').show();
                 $('.buttonAddPresenceWait').hide();
             }
            //console.log("SUCCESS",result);
         }
     });
}

function addStudent(){
    let etudiantName = $('#formEtudiantNom').val();
    let etudiantPrenom = $('#formEtudiantPrenom').val();
    let etudiantMatricule = $('#formEtudiantMatricule').val();
    let etudiantGroupe = $('#formEtudiantGroupe').val();
    console.log(etudiantName,etudiantPrenom,etudiantMatricule,etudiantGroupe);
    $('.buttonAddStudent').hide();
    $('.dismissAddStudent').hide();
    $('.buttonAddStudentWait').show();
    let token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: './api/students',
         type: 'post',
         data: {
            "matricule" : etudiantMatricule,
            "group" : etudiantGroupe,
            "nom" : etudiantName,
            "prenom" : etudiantPrenom,
            "_token" : token,
         },
         success: function(result){
             if(result == true){
                location.reload();
             }else{
                 alert("Probleme");
                 $('.buttonAddStudent').show();
                 $('.dismissAddStudent').show();
                 $('.buttonAddStudentWait').hide();
             }
            //console.log("SUCCESS",result);
         }
     });
}

//showDetails();
$(document).ready(function() {
$('#table_id').DataTable({
    "order": [[ 0, "asc" ]],
     "columnDefs": [
         { targets: 'no-sort', orderable: false },
         ],
     searching: false,
     responsive: true,
     scrollX: true,
     pageLength: 25,
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
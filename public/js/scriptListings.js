function showDetails(){
    $.get("./pae/students/", function (data, status) {
        $('.programme tr').remove();
        if(data.length == 0){
            $('.programme').append('<tr><td>Aucun programme</td></tr>');
        }else{
            $.each(data,function(){
                $('.programme').append('<tr class="'+this.id+'">' +
                    '<td>'+this.id+'</td>' +
                    '<td>'+this.title+'</td>' +
                    '<td>'+this.credits+'</td>' +
                    '<td>' +
                    '<button style="float:none;color:red" type="button" onclick="remove(\''+this.id+'\',22)" class="close" aria-label="close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</td>' +
                    '</tr>');
            });
        }
    });
}
showDetails();
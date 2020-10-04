AOS.init();

$(document).ready(event=>{
    $('footer').html('<hr><center>Marco Toledo, 2018</center><br>');
    $.getJSON( "http://200.145.153.175/marcotoledo/bixos/data.php?tipo=comentarios&bixo="+id, function(retorno) {
        if(retorno.data[0].comentario != null)
        {
            retorno.data.forEach(element => {
                $('#comentsBixo').append('<div class="coment" data-aos="zoom-in">'+element.comentario + '</div>');
            });
        }
        else
        {
            $('#comentsBixo').append('Esse bixo ainda não tem nenhum comentário! Deixe o primeiro abaixo!' + '<br><br>');
        }
    });
});
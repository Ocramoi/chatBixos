AOS.init();

$(document).ready(event =>{
    carrega('');
});

$('#inPesq').keypress(function(e)
{
    var code = e.keyCode || e.which;
    if(code == 13) 
    {
        carrega($('#inPesq').val());
    }
});

$('#botPesq').click(event =>
{
    $('#inPesq').val('');
    carrega('');
});

function carrega(nome)
{
    $('main').text('');
    $('main').empty();
    
    $('footer').html('<hr><center>Marco Toledo, 2018</center><br>');

    if(nome == '')
    {
        $.getJSON("http://200.145.153.175/marcotoledo/bixos/data.php?tipo=bixos", function(retorno) {
            retorno.data.forEach(element => {
                $('main').append('<div class="bixo" id="'+element.id+'" data-aos="zoom-in"><a class="nome" href="bixo/index.php?id='+element.id+'">'+element.nome+'</a></div>');
                addComents(element.id);
            });
        });
    }
    else
    {
        $.getJSON( "http://200.145.153.175/marcotoledo/bixos/data.php?tipo=bixos&nome="+nome, function(retorno) {
            if(retorno.data[0].nome != null)
            {
                retorno.data.forEach(element => {
                    $('main').append('<div class="bixo" id="'+element.id+'"><a class="nome" href="bixo/index.php?id='+element.id+'">'+element.nome+'</a></div>');
                    addComents(element.id);
                });
            }
            else
            {
                $('main').append('<div class="bixo">Nenhum bixo encontrado com esse nome!!!</div>');
            }
        });
    }
}

function addComents(id)
{
    $('#'+id).append('<hr>');
    
    $.getJSON( "http://200.145.153.175/marcotoledo/bixos/data.php?tipo=comentarios&bixo="+id+'&qtd=4', function(retorno) {
        if(retorno.data[0].comentario != null)
        {
            var cont = 0;
            retorno.data.forEach(element => {
                if(cont<3)
                {
                    if(element.comentario.length > 100)
                    {
                        $('#'+id).append('<div id="comentMain,'+element.id+'" class="comentMain">'+element.comentario.slice(0, 97) + '... <a id="coment,'+element.id+'" class="comentComp">(comentário completo)</a></div>');
                        addMais();
                    }
                    else
                    {
                        $('#'+id).append('<div class="comentMain">'+element.comentario + '</div>');
                    }
                }
                cont++;
            });
            if(cont>3)
            {
                $('#'+id).append('Mais ' + (retorno.data.length - 3) + ' comentários<br>');
            }
            $('#'+id).append('<a href="bixo/index.php?id='+id+'" id="mais">Clique aqui para visualizar mais comentários e postar o seu!</a>');
        }
        else
        {
            $('#'+id).css('background-color', 'rgb(255, 95, 116)');
            $('#'+id).append('Esse bixo ainda não tem nenhum comentário!' +
            ' <a href="bixo/index.php?id='+id+'" id="mais">Adicione o seu!</a>' + '<br>');
        }
    });
}

function addMais()
{
    $(".comentComp").on('click', mais);
}

function mais(e)
{
    var ar = e.currentTarget.id.split(',');
    var idC = ar[1];
    $.getJSON( "http://200.145.153.175/marcotoledo/bixos/data.php?tipo=comentarios&idComentario="+idC, function(retorno) {
        var alvo = 'comentMain,'+idC;
        console.log(alvo);
        console.log(retorno.data[0].comentario);
        $('div[id="'+alvo+'"]').text(retorno.data[0].comentario);
    });
};
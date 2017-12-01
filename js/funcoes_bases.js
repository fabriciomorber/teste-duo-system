$(function(){
    $('.status_Concluído .btn-edit').attr('disabled','disabled');
    $("#btnCadastro").click(function(){
        window.location.href = "inserir.php";
    });
    $("#btnCancel").click(function(){
        window.location.href = "index.php";
        return false;
    });

    $("#filterSituacao").change(function(){
        var url = window.location.search.replace("?","");
        var items = url.split("&");
        var array = {
            'fStatus' : items[0],
            'fSituacao' : items[1]
        }
        //alert(array.fStatus);

        if(array.fStatus != null){
            window.location.href = "index.php?"+array.fStatus+"&fSituacao="+$(this).val();
        }
        else{
            window.location.href = "index.php?fSituacao="+$(this).val();
        }
        if($(this).val() == '')
            window.location.href = "index.php";
    });

    $("#filterStatus").change(function(){
        var url = window.location.search.replace("?","");
        var items = url.split("&");
        var array = {
            'fStatus' : items[0],            
            'fSituacao' : items[1]
        }
        //alert(array.fStatus);

        if(array.fSituacao != null) {
            window.location.href = "index.php?fStatus="+$(this).val()+"&"+array.fSituacao;
        }
        else {
            window.location.href = "index.php?fStatus="+$(this).val();
        }
        if($(this).val() == '')
            window.location.href = "index.php";
    });
});

function ancora(acao, id) {
    window.location.href = acao+".php?id="+id;
}
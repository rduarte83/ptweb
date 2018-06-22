var id_utente_ver, user, userTo;
var files;


/** CHAT */
function intrevalLoadChat()
{
 // PRECISA SER IMPLEMENTADO...
}

function getChatDiv(){
    $.ajax({
        url:"modules/home/profissional/chat.php",
        type:"POST",
        success:function(resposta){
            $("#div-paciente-chat").html(resposta);
        },
        async:false
    });
}

function loadChat(){
    $.ajax({
        url:"includes/php/funcsWeb.php",
        type:"POST",
        data:{
            "cmd":"getMessages",
            "id_to":id_utente_ver,
        },
        success:function(resposta){
            console.log(resposta);
            var trabalhar = $.parseJSON(resposta);
            var chatFinal ="";

            trabalhar.forEach(function(elem){
                if ( elem.origem == user ){
                    chatFinal += "<li class='direita'>"+elem.conteudo+"</li><span class='clearfix'></span>";
                }else if( elem.origem == id_utente_ver ){
                    console.log(id_utente_ver)
                    chatFinal += "<li class='esquerda'>"+elem.conteudo+"</li><span class='clearfix'></span>";
                }
                
            })
            $(".chat").html(chatFinal);
        },
        async:false
    });
}

function getMyUser(){
    $.ajax({
        url:"includes/php/funcsWeb.php",
        type:"POST",
        data:{
            "cmd":"getMyUser",
        },
        success:function(resposta){
            console.log("AQUI->"+resposta);
            user=resposta;
            loadChat();
        },
        async:false
    });
}

function sendMessage(mensagem,id_to){
    $.ajax({
        url:"includes/php/funcsWeb.php",
        type:"POST",
        data:{
            "cmd":"sendTo",
            "mensagem":mensagem,
            "id_to":id_to,
        },
        success:function(resposta){
            loadChat();
            console.log(resposta);
        },
        async:false
    });
}

/** OTHERS */
function getUsersPacientes(){
    
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"getUsersPaciente"
        },
        success:function(response){
            console.log("AQUI");
            console.log(response);
            let resposta = $.parseJSON(response);
            console.log(resposta);
            let listPaciente = '<li class="list-group-item"> ID | Nome</li>';
            $.each(resposta, function (key, val) {
                listPaciente+='<li id="list_' + resposta[key].id +'" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#addUserModal"><span class="badge badge-primary" style="margin-right: 8px; padding: 10px; vertical-align: middle;">' + resposta[key].id + '</span>' + resposta[key].nome +'</li>';
            });
            
            $("div #list_pacientes").html(listPaciente);
        }
    });
}



function carregaData(texto) {
    $.ajax({
        type: "POST",
        url: 'includes/php/funcsWeb.php',
        data: {
            "cmd": "getSingleUser",
            "key": texto
        },
        dataType: "json", // serializes the form's elements.
        success: function (data) {
            $("#panel-body").html('<table id="user-paciente-table" class="table">\n' +
                '  <thead>\n' +
                '    <tr>\n' +
                '      <th scope="col">ID</th>\n' +
                '      <th scope="col">Nome</th>\n' +
                '      <th scope="col">Morada</th>\n' +
                '      <th scope="col">Nacionalidade</th>\n' +
                '      <th scope="col">Nif</th>\n' +
                '      <th scope="col">CC</th>\n' +
                '      <th scope="col">Genero</th>\n' +
                '      <th scope="col">Data Nascimento</th>\n' +
                '      <th scope="col">Contacto</th>\n' +
                '      <th scope="col">Mail</th>\n' +
                '    </tr>\n' +
                '  </thead>\n' +
                '  <tbody>\n' +
                '    <tr>\n' +
                '      <th scope="row">'+texto+'</th>\n' +
                '      <td>'+data[0].nome+'</td>\n' +
                '      <td>'+data[0].morada+'</td>\n' +
                '      <td>'+data[0].nacionalidade+'</td>\n' +
                '      <td>'+data[0].nif+'</td>\n' +
                '      <td>'+data[0].cc+'</td>\n' +
                '      <td>'+data[0].genero+'</td>\n' +
                '      <td>'+data[0].data_nascimento+'</td>\n' +
                '      <td>'+data[0].contacto+'</td>\n' +
                '      <td>'+data[0].mail+'</td>\n' +
                '    </tr>\n' +

                '  </tbody>\n' +
                '</table>');
        },
        error: function (response) {
            console.log("error " + response.getAllResponseHeaders);
        }
    });
}

function insertArtigo(dados)
{
    $.ajax({
        type: "POST",
        url: 'includes/php/funcsWeb.php',
        data: dados, // serializes the form's elements.
        success: function (data) {
            console.log(data);
            // Artigo foi adicionado
            if(data == 1){
                alerta("Artigo adicionado com sucesso!",false);
            }else{
                alerta("Erro ao adicionar artigo!",true);
            }

            $("#error").html(data);
            $('#articleModal').modal('toggle');
        },
        error: function(response){
            console.log("error->" + response.getAllResponseHeaders);
        }
    });
}

function insertPacient(dados)
{
    $.ajax({
        type: "POST",
        url: 'includes/php/funcsWeb.php',
        data: dados, // serializes the form's elements.
        success: function (data) {
            // Artigo foi adicionado
            if(data == 1){
                alerta("Paciente adicionado com sucesso!",false);
            }else{
                alerta("Erro ao adicionar paciente!",true);
            }

            $("#error").html(data);
            $('#addPacientModal').modal('toggle');
        },
        error: function(response){
            console.log("error->" + response.getAllResponseHeaders);
        }
    });
}


function insertConsulta(dados)
{
    $.ajax({
        type: "POST",
        url: 'includes/php/funcsWeb.php',
        data: dados, // serializes the form's elements.
        success: function (data) {
            console.log(data);
            // Artigo foi adicionado
            if(data == 1){
                alerta("Consulta adicionada com sucesso!",false);
                $("#addConsultaForm").trigger('reset');
            }else{
                alerta("Erro ao adicionar consulta!",true);
            }

            $("#error").html(data);
            $('#addConsultaModal').modal('toggle');
        },
        error: function(response){
            console.log("error->" + response.getAllResponseHeaders);
        }
    });
}

function insertTreino(form)
{
    console.log(form);
    var formData = new FormData(form[0]);
    formData.append("cmd","insertTreino");

    $.ajax({
        url: 'includes/php/funcsWeb.php',
        type: 'POST',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        success: function (data) {
            alert("Data Uploaded: "+data);
            $("#error").html(data);
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async:false,
    });
    return false;
}

var carregaConsulta = false;

function carregaDataSelectConsulta()
{
    carregaConsulta=false;
    $.ajax({
        type: "POST",
        url: 'includes/php/funcsWeb.php',
        data: {
            "cmd" : "getUsersPaciente"
        }, // serializes the form's elements.
        success: function (response) {
            let resposta = $.parseJSON(response);
            console.log(resposta);
            let listPaciente = '<option value="-1">Selecione o paciente...</option>';
            $.each(resposta, function (key, val) {
                listPaciente+='<option value="'+resposta[key].id+'">'+resposta[key].nome+'</option>';
            });
            $("#pacienteConsultaAddModal").html(listPaciente);
            carregaConsulta = true;
        },
        async: false
    })
    return carregaConsulta;
}

function carregaDataSelectTreino()
{
    $.ajax({
        type: "POST",
        url: 'includes/php/funcsWeb.php',
        data: {
            "cmd" : "getUsersPaciente"
        }, // serializes the form's elements.
        success: function (response) {
            let resposta = $.parseJSON(response);
            console.log(resposta);
            let listPaciente = '<option value="-1">Selecione o paciente...</option>';
            $.each(resposta, function (key, val) {
                listPaciente+='<option value="'+resposta[key].id+'">'+resposta[key].nome+'</option>';
            });

            $("#pacienteTreinoAdd").html(listPaciente);
            if(id_utente_ver!=0){
                $('#addTreinoForm select[name="utente"] option[value="'+id_utente_ver+'"]').prop('selected', true);
            }
            
        },
        async: false
    })
}

function carregaTreinos()
{
    $.ajax({
        type: "POST",
        url: 'modules/home/profissional/treinos.php',
        success: function (response) {
            addToMain(response);             
        },
        async: false
    });
    
}


var previousMain = [];
var level = 0;

function goBack(){
    level--;
    $("#main_div").html(previousMain[level]);
    if(level == 0) id_utente_ver=0;
}

function addToMain(conteudo){
    $("#main_div").html('    <div class="row-fluid">\n' +
        '        <button type="button" class="btn btn-info" id="btn-back" onclick="goBack();">Back</button>\n<br><br>' +
        '    </div>' + conteudo);
}

function addTrat(id){}

// Grab the files and set them to our variable
function prepareUpload(event)
{
    files = event.target.files;
}


$(document).ready(function () {
    getMyUser();
    $("#success-alert").hide();
    $("#danger-alert").hide();

    /*  MAIN DIV BLOCKS */

    $("#main_div").on("click",'#show_list_pac', function (){

        previousMain[level] = $("#main_div").html();
        level++;

        addToMain('<div id="lista_pacientes" class="col-md"> <h1>Pacientes</h1> <div id="list_pacientes"' +
            ' class="lista"> <li class="list-group-item"> ID | Nome</li> </div> </div>');
        getUsersPacientes();
    });

    $("#main_div").on("click",'#add_pac', function (){
        $('#addPacientModal').modal('toggle');
    });

    $("#main_div").on("click",'#add_article', function (){
        $('#articleModal').modal('toggle');
    });
    $("#main_div").on("click",'#edit_article', function (){
        alert("lol");
    });
    $("#main_div").on("click",'#add_consulta', function (){
        carregaDataSelectConsulta();
        $('#addConsultaModal').modal('toggle');
    });
    $("#main_div").on("click",'#add_treino', function (){
        previousMain[level] = $("#main_div").html();
        level++;

        carregaTreinos();    
          
    });

    $(document).on("click",'#btn-add-consulta', function (){
        if(carregaDataSelectConsulta()){
            //$('select[name="pacienteConsulta"]').find('option[value="4"]').attr("selected",true);
            $('select[name="utente"] option[value="'+id_utente_ver+'"]').prop('selected', true);
            $('#addConsultaModal').modal('toggle');
        }
    })

    $(document).on("click",'#btn-add-treino', function (){
        previousMain[level] = $("#main_div").html();
        level++;
        carregaTreinos();    
    });
    
    /* Sidebar */

    $(document).on("click",'#show_list_pac_sidebar', function (){
        previousMain[level] = $("#main_div").html();
        level++;

        addToMain('<div id="lista_pacientes" class="col-md"> <h1>Pacientes</h1> <div id="list_pacientes"' +
            ' class="lista"> <li class="list-group-item"> ID | Nome</li> </div> </div>');
        getUsersPacientes();
    });

    $(document).on("click",'#add_pac_sidebar', function (){
        $('#addPacientModal').modal('toggle');
    });

    $(document).on("click",'#add_article_sidebar', function (){
        $('#articleModal').modal('toggle');
    });

    $(document).on("click",'#edit_article_sidebar', function (){
        alert("lol");
    });

    $(document).on("click",'#add_video_sidebar', function (){
        alert("lol");
    });

    $(document).on("click",'#edit_video_sidebar', function (){
        alert("lol");
    });
    
    /* FORMS  */
    $("#addPacientForm").on("submit", function (e) {
        e.preventDefault();
        var arrDados = $(this).serializeArray();
        arrDados.push({"name":"cmd","value":"insertPacient"});
        insertPacient(arrDados);
    });

    $("#addConsultaForm").on("submit", function (e) {
        e.preventDefault();
        var arrDados = $(this).serializeArray();
        arrDados.push({"name":"cmd","value":"insertConsulta"});
        insertConsulta(arrDados);

    });

    $("#addArticle").on("submit", function (e) {
        e.preventDefault();
        var arrDados = $(this).serializeArray();
        arrDados.push({"name":"cmd","value":"insertArtigo"});
        insertArtigo(arrDados);
    });



    $(document).on("submit", "#addTreinoForm", function (e) {
        e.preventDefault();
        var arrDados = $(this).serializeArray();
       // Create a formdata object and add the files
        //var data = new FormData();
       /* $.each(files, function(key, value)
        {
            arrDados.push({"name":"files[]","value":value});
        });*/

        //arrDados.push({"name":"cmd","value":"insertTreino"});
        console.log(arrDados);
        insertTreino($(this));
    });

    

    $(document).on("click", ".list-group-item-action", function () {

        previousMain[level] = $("#main_div").html();
        level++;

        let id = $(this).find("span").text();

        id_utente_ver = id;
        addToMain(
            '<div class="row-fluid">\n' +
            '   <button type="button" class="btn btn-primary" id="btn-add-consulta" onclick="">+ Criar consulta</button>\n<br><br>' +
            '   <button type="button" class="btn btn-primary" id="btn-add-treino" onclick="">+ Criar Treino</button>\n<br><br>' +
            '</div>' +
            '<div class="card">' +
            '   <nav>\n' +
            '       <div class="nav nav-tabs" id="nav-tab" role="tablist">\n' +
            '           <a class="nav-item nav-link active dark-text" id="nav-paciente-dados" data-toggle="tab" href="#div-paciente-dados" role="tab" aria-controls="div-paciente-dados" aria-selected="false">Dados</a>\n' +
            '           <a class="nav-item nav-link dark-text" id="nav-paciente-treinos" data-toggle="tab" href="#div-paciente-treinos" role="tab" aria-controls="div-paciente-treinos" aria-selected="false">Treinos</a>\n' +
            '           <a class="nav-item nav-link dark-text" id="nav-paciente-epDor" data-toggle="tab" href="#div-paciente-epDor" role="tab" aria-controls="div-paciente-epDor" aria-selected="false">Episodios de Dor</a>\n' +
            '           <a class="nav-item nav-link dark-text" id="nav-paciente-consultas" data-toggle="tab" href="#div-paciente-consultas" role="tab" aria-controls="div-paciente-consultas" aria-selected="false">Consultas</a>\n' +
            '           <a class="nav-item nav-link dark-text" id="nav-paciente-chat" data-toggle="tab" href="#div-paciente-chat" role="tab" aria-controls="div-paciente-chat" aria-selected="false">Chat</a>\n' +
            '       </div>\n' +
            '   </nav>' +
            '   <div class="tab-content" id="nav-tabContent">\n' +
            '       <div class="tab-pane fade show active" id="div-paciente-dados" role="tabpanel" aria-labelledby="nav-profile-tab">\n' +
            '           <div id="panel-body"></div>\n' +
            '       </div>' +
            '       <div class="tab-pane fade" id="div-paciente-treinos" role="tabpanel" aria-labelledby="nav-contact-tab"><button type="button" class="btn btn-info margin8" id="btn-back" onclick="addTrat(id);">+ Recomendar artigo</button></div>\n' +
            '       <div class="tab-pane fade" id="div-paciente-epDor"></div>' +
            '       <div class="tab-pane fade" id="div-paciente-epDor"></div>' +
            '       <div class="tab-pane fade" id="div-paciente-chat"></div>' +
            '   </div>' +
            '</div> '
        );

        carregaData(id);
        getChatDiv();
        loadChat();
    });

    previousMain[level] = $("#main_div").html();

    /*  */
    // Add events
    $(document).on("change", 'input[type=file]', prepareUpload);

    $(document).on("submit", "#formChat", function(e){
        e.preventDefault();
        var mensagem = $("#mensagem").val();
        $("#mensagem").val("");
        sendMessage(mensagem, id_utente_ver);
    });

    
});


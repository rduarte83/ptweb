function getUsersPacientes(){
    
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"getUsers"
        },
        success:function(response){
            console.log(response);
            let resposta = $.parseJSON(response);
            console.log(resposta);
            let listPaciente = '<li class="list-group-item"> ID | Nome</li>';
            $.each(resposta, function (key, val) {
                if (resposta[key].role === 4) {
                    listPaciente+='<li id="list_' + resposta[key].id +'" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#addUserModal"><span class="badge badge-primary" style="margin-right: 8px; padding: 10px; vertical-align: middle;">' + resposta[key].id + '</span>' + resposta[key].nome +'</li>';
                }
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
            $("#panel-body").html('<table class="table">\n' +
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
                alert("E o alert?");
                $("#sucessoMensagem").html("Artigo adicionado com sucesso!");
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){

                    $("#success-alert").slideUp(500);
                });
            }else{
                $("#errorMensagem").html("Erro ao adicionar artigo!");
                $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){

                    $("#danger-alert").slideUp(500);
                });
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

                $("#sucessoMensagem").html("Paciente adicionado com sucesso!");
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
            }else{
                $("#errorMensagem").html("Erro ao adicionar paciente!");
                $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
                    $("#danger-alert").slideUp(500);
                });
            }

            $("#error").html(data);
            $('#addPacientModal').modal('toggle');
        },
        error: function(response){
            console.log("error->" + response.getAllResponseHeaders);
        }
    });
}


var previousMain = [];
var level = 0;

function goBack(){
    level--;
    $("#main_div").html(previousMain[level]);
}

function addToMain(conteudo){
    $("#main_div").html('    <div class="row-fluid">\n' +
        '        <button type="button" class="btn btn-info" id="btn-back" onclick="goBack();">Back</button>\n<br><br>' +
        '    </div>' + conteudo);
}

function addTrat(id){}


$(document).ready(function () {
    $("#success-alert").hide();
    $("#danger-alert").hide();

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
    $("#main_div").on("click",'#add_video', function (){
        alert("lol");
    });
    $("#main_div").on("click",'#edit_video', function (){
        alert("lol");
    });

    $("#addPacientForm").on("submit", function (e) {
        e.preventDefault();
        var arrDados = $(this).serializeArray();
        arrDados.push({"name":"cmd","value":"insertPacient"});
        insertPacient(arrDados);
    });

    $("#addArticle").on("submit", function (e) {
        e.preventDefault();
        var arrDados = $(this).serializeArray();
        arrDados.push({"name":"cmd","value":"insertArtigo"});
        insertArtigo(arrDados);
    });

    $(document).on("click", ".list-group-item", function () {

        previousMain[level] = $("#main_div").html();
        level++;

        let id = $(this).find("span").text();
        addToMain(
            '    <div class="row-fluid">\n' +
            '        <button type="button" class="btn btn-primary" id="btn-add-consulta" onclick="">+ Criar consulta</button>\n<br><br>' +
            '    </div>' +
            '<div class="card">' +
            '<nav>\n' +
            '  <div class="nav nav-tabs" id="nav-tab" role="tablist">\n' +
            '    <a class="nav-item nav-link active dark-text" id="nav-paciente-dados" data-toggle="tab" href="#div-paciente-dados" role="tab" aria-controls="div-paciente-dados" aria-selected="false">Dados</a>\n' +
            '    <a class="nav-item nav-link dark-text" id="nav-paciente-tratamentos" data-toggle="tab" href="#div-paciente-tratamentos" role="tab" aria-controls="div-paciente-tratamentos" aria-selected="false">Tratamentos</a>\n' +
            '  </div>\n' +
            '</nav>' +
            '<div class="tab-content" id="nav-tabContent">\n' +
            '<div class="tab-pane fade show active" id="div-paciente-dados" role="tabpanel" aria-labelledby="nav-profile-tab">\n' +
            '  <div id="panel-body"></div>\n' +
            '</div>' +
            '  <div class="tab-pane fade" id="div-paciente-tratamentos" role="tabpanel" aria-labelledby="nav-contact-tab"><button type="button" class="btn btn-info margin8" id="btn-back" onclick="addTrat(id);">+ Recomendar artigo</button></div>\n' +
            '</div>' +
            '</div> '
        );

        carregaData(id);
    });

    previousMain[level] = $("#main_div").html();
});

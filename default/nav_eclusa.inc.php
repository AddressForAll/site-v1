<style>
    .parametros{
        background-color: #e9e9e9;
        border-radius: 10px;
        margin: 1em;
        padding: 1em;
    }
</style>

<section class="main-api" id="api">
    <h1>API - ECLUSA DE DADOS</h1>
    <p>
    <img style="float: right;" src="/resources/img/nav-eclusa.png"" alt="Eclusa de Dados" width="180" height="200">
    A entrega de dados brutos pode ser realizada arquivo por arquivo na API ou "em lote", ambas pelo técnico responsável devidamente autenticado. A "entrega em lote" é realizada por protocolo SFTP, no ambiente apelidado de Eclusa, garantindo-se o seguinte workflow:
    </p>
    <p>
    <ol>
        <li>O técnico responsável recebe os dados originais, os revisa e os organiza.</li>
        <li>O técnico responsável efetua na sua home SFTP <code>/home/{user}</code> dos arquivos desejados nas pastas padronizadas.</li>
        <li>O software da Eclusa cria hashes e leva os metadados para a base de dados, depois de oferecer recursos de confirmação na API. Os dados ficam preservados em área de quarentena (períorodo de embargo e testes) e depois em repositório definitivo.</li>
    </ol> 
    <br>
    <h3>&#x2198; Especificações de Entrada</h3>
    <div class="parametros">
        <span>
            <strong>Filtrar por: </strong>
        </span>
        <input type="radio" id="step_0" name="tipo_do_filtro" value="step0">
            <label for="step_0">Step 1</label>
        <input type="radio" id="step_1" name="tipo_do_filtro" value="step1" checked>
            <label for="step_1">Step 2</label>
        <input type="radio" id="step_2" name="tipo_do_filtro" value="step2">
            <label for="step_2">Step 3</label>
        <br>
        <label for="usuario"><strong>Usuário: </strong></label>
        <input type="text" id="usuario" name="usuario" placeholder="Insira um usuário..." autofocus>
        <strong>Tipo: </strong>
        <input type="radio" id="r_todos" name="tipo_de_usuario" value="" checked>
        <label for="r_todos">Todos</label>
        <input type="radio" id="r_invalidos" name="tipo_de_usuario" value="0">
        <label for="r_invalidos">Inválidos</label>
        <input type="radio" id="r_validos" name="tipo_de_usuario" value="1">
        <label for="r_validos">Válidos</label>
        <br>
        <button onclick="getdata();"><strong>Consultar</strong></button>
        <br>
    </div>
    <div id="definepaginacao" style="display: none;">
        <h3>&#x2197; Especificações de Saída</h3>
        <div class="parametros">
            <strong>Paginar Resultado: </strong><input type="checkbox" id="paginar" checked>
            <strong>Configurar resultados por página</strong>
            <select id="paginacao">
                <option value="10" selected>10</option>
                <option value="100">100</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
                <option value="-1">Mostrar tudo</option>
            </select>
        </div>
    </div>

    <br>
    <table id="tabela" class="display" style="display: none;">
        <thead>
            <tr>
                <th>ISO Label Extended</th>
                <th>File Id</th>
                <th>File Name</th>
                <th>Is Valid</th>
            </tr>
        </thead>
    </table>
    <table id="tabela_step_0" class="display" style="display: none;">
        <thead>
            <tr>
                <th>Username</th>
                <th>Jurisdiction_label</th>
                <th>Jurisdiction_osmid</th>
                <th>Pack_path</th>
                <th>User_resp</th>
                <th>Accepted_date</th>
            </tr>
        </thead>
    </table>
    <br><br>
    <div class="desenvolvedor">
        <table>
            <tr>
                <th colspan="2">Annotations for Developers</th>
            </tr>
            <tr>
                <td>data</td><td>: eclusa</td>
            </tr>
            <tr>
                <td>GET</td><td>: <a id="get_url" style="text-decoration: none" href="http://api.addressforall.org/v1/eclusa/checkUserFiles-step{step}/{user}">http://api.addressforall.org/v1/eclusa/checkUserFiles-step{step}/{user}</a></td>
            </tr>
            <tr>
                <td>doc</td>
                <td>: <a target="_blank" rel="external" href="https://github.com/AddressForAll/WS" style="text-decoration: none">https://github.com/AddressForAll/WS</a></td>
            </tr>
        </table>
    </div>
</section>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/sp-1.1.1/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>
<script src="/resources/js/api-eclusa.js"></script>

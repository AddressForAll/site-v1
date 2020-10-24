<link rel="stylesheet" href="/resources/css/api.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/sp-1.1.1/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>

<section class="main-api" id="api">
    <h1>Resultado da solicitação de API</h1>
    <table id="api_default_preview" class="display compact" style="width:100%"></table>
<script>
    function createTableHeader(tableNode, headItems, arrInput){
        var tbody = document.createElement('tbody');
        var thead = document.createElement('thead');
        var tr, td;
        tr = document.createElement('tr');
        for (var item of headItems){
            var td = tr.insertCell(); // must TH but...
            td.appendChild(document.createTextNode(item["data"]));
            td.style.fontWeight = 'bold';
        }
        thead.appendChild(tr);
        for (var line of arrInput) {
            tr = document.createElement('tr');
            for ( var  item  of  Object.values(line) ){
                var td = tr.insertCell();
                if (item && typeof item == 'object') {
                    td.setAttribute('title',JSON.stringify(item));
                    item = '(...)';
                }
                td.appendChild(document.createTextNode(item));
            }
            tbody.appendChild(tr);
        }
        tableNode.appendChild(thead);
        tableNode.appendChild(tbody);
    }

    $.getJSON(data_url, function(data) { // this variable `data_url` is defined during index.php call
        var columns_list = Object.keys(data[0]);
        var columns = [];
        for (var i in columns_list) columns.push({data: columns_list[i]}); 

        createTableHeader(document.getElementById('api_default_preview'), columns, data);
        $('#api_default_preview').DataTable({
                    "bDestroy": true,
                    "dom": 'Bfrtip',
                    "buttons": ['copy', 'csv', 'excel'],
                    "columns" : columns,
                    "paging": $('#paginar').prop('checked'),
                    "responsive": true,
                    "pageLength" : 10
                });
        
    }); // END getJSON
</script>

<!-- ADDING ANNOTATION FOR DEVS --> 
<?= include_once("default/api_default_devFoot.inc.php") ?>

</section>

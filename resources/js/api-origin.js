
    function getdata(param = null){
        var valor, atributo, url;
        if (param != null){
            valor = param;
            atributo = "donor_id";
        }
        else if ($('input[type=radio][name=tipo_do_filtro]:checked').val() == "estado") {
            valor = $("#estados").children("option:selected").val();
            atributo = "city_state";
        }
        else {
            valor = $("#donors").children("option:selected").val();
            atributo = "donor_vat_id";
        }

        url = "http://addressforall.org/_sql/origin";
        url += valor != "all" ? "?" + atributo + "=eq." + valor : "";

        $.getJSON(url, function(data) {
            $('#tabela').show();
            $('#definepaginacao').show();
            $('#tabela').DataTable({
                "bDestroy": true,
                "dom": 'Bfrtip',
                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
                "data" : data,
                "columns" : [
                    {"data" : "id"},
                    {"data" : "city_id"},
                    {"data" : "cityname"},
                    {
                        "data" : null, 
                        "render" : function(data, type, row) {
                                        return '<div align="center">' + data["ctype"] + '&nbsp;' + '<a class="btn" style="text-decoration: none" href="http://preserv.addressforall.org/download/' + data["fhash"] + "." + data["fmeta"].ext + '" target_blank>' + data["fhash"].substring(0, 7) + ' ↓ </a>' + '&nbsp;v' + data["fversion"] + '</div>'
                                    }
                        
                    },
                    {
                        "data" : null, 
                        "render" : function(data, type, row) {
                                        return parseFloat((data["fmeta"].size / (1024 ** 2))).toFixed(2) + "MB"
                                    }
                    },
                    {
                        "data" : null,
                        "render" : function(data, type, row) {
                                        return '<div align="center" ><a class="btn" style="text-decoration: none" href="http://addressforall.org/api-donor?id='+data["donor_id"]+'" target_blank>' + data["donor_id"] + " - " + data["donor_shortname"] + '</a></div>' 
                                    }
                    
                    },
                    {
                        "data" : null,
                        "render" : function(data, type, row) {
                                        return '<a href="'+data["donor_url"]+'" target_blank>'+data["donor_legalname"]+'</a>' 
                                    }
                    
                    },
                    {"data" : "pack_accepted_date"}
                ],
                "paging": $('#paginar').prop('checked'),
                "responsive": true,
                "pageLength" : 10
            });

        });

    }

    $(document).ready(function(){

        /* Pega parametro da url ?donor_id=43242 quando o usuário está navegando de api-donor */
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('donor_id')){
            getdata(searchParams.get('donor_id'));
        } 

        /* Controla o radio que escolhe o tipo da filtragem */
        $('input[type=radio][name=tipo_do_filtro]').change(function() {
            if (this.value == 'estado') {
                $('#div_estados').show();
                $('#div_donors').hide();
            }
            else if (this.value == 'donor') {
                $('#div_donors').show();
                $('#div_estados').hide();
            }
        });


        /* Carregar option dos doadores */ 
        $.getJSON('http://api.addressforall.org/_sql/vw02donors_origin', function(data){
            var options = "<option selected value='all'>Trazer Tudo</option>";
            for (var x = 0; x < data.length; x++) {
                options += '<option value="' + data[x]['donor_vat_id'] + '">' + data[x]['donor_legalname'] + " -     (" + data[x]['n_files'] + ')</option>';
            }
            $('#donors').html(options);
        });


        /* Carregar option dos estados */ 
        $.getJSON('http://api.addressforall.org/_sql/vw01states_origin', function(data){
            var options = "<option selected value='all'>Trazer Tudo</option>";
            for (var x = 0; x < data.length; x++) {
                options += '<option value="' + data[x]['city_state'] + '">' + data[x]['city_state'] + " -     (" + data[x]['count'] + ')</option>';
            }
            $('#estados').html(options);
        });

        
        /* Páginação controlda */
        $('#definepaginacao').on('change', function (){
            var qtd = $("#paginacao").children("option:selected").val();
            $('#tabela').DataTable().page.len(qtd).draw();
        });    


        /* Considera ordenação correta em PT, A, À, Á, B, C ... Z */
        $.fn.dataTable.ext.order.intl = function ( locales, options ) {
        if ( window.Intl ) {
            var collator = new window.Intl.Collator( locales, options );
            var types = $.fn.dataTable.ext.type;
    
            delete types.order['string-pre'];
            types.order['string-asc'] = collator.compare;
            types.order['string-desc'] = function ( a, b ) {
                return collator.compare( a, b ) * -1;
                };
            }
        };
        $.fn.dataTable.ext.order.intl( 'pt' ); 
    });
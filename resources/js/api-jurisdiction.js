
    function getdata(param = null){
        /*
        var valor, atributo, url;
        if (param != null){
            valor = param;
            atributo = "donor_id";
        }
        else if ($('input[type=radio][name=tipo_do_filtro]:checked').val() == "estado") {
            valor = $("#estados").children("option:selected").val();
            atributo = "jurisd_state";
        }
        else {
            valor = $("#donors").children("option:selected").val();
            atributo = "donor_id";
        }
        */

        url = "http://api-test.addressforall.org/v1/vw_core/jurisdiction?limit=1000";
        //url += valor != "all" ? atributo + ".eq." + valor : "";

        $.getJSON(url, function(data) {
            $('#tabela').show();
            $('#definepaginacao').show();
            $('#tabela').DataTable({
                "bDestroy": true,
                "dom": 'Bfrtip',
                "buttons": ['copy', 'csv', 'excel', 'print'],
                "data" : data,
                "columns" : [
                    {
                        "data" : null,
                        "render" : data=> `<a title="Mapa" rel="external noopener" target="_blank" href="http://osm.org/relation/${data.osm_id}" target_blank>${data.osm_id}</a>`
                    },
                    {"data": "jurisd_base_id"},
                    {"data": "jurisd_local_id"},
                    {"data": "name"},
                    {"data": "parent_abbrev"},
                    {"data": "abbrev"},
                    {
                        "data" : null,
                        "render": function(data, type, row) {
                            return (data["wikidata_id"]) ? '<a target="_blank" rel="external noopener" href="http://wikidata.org/entity/Q'+data["wikidata_id"]+'" target_blank>' + data["wikidata_id"] + '</a>' : ''
                        
                        }
                    },
                    {"data": "lexlabel"},
                    {"data": "isolabel_ext"},
                    {"data": "ddd"},
                    {"data": "info"},
                    {"data": "admin_level"},
                    {"data": "parent_id"}
                ],
                "paging": $('#paginar').prop('checked'),
                "responsive": true,
                "pageLength" : 10
            });

            /* Changes automatically the GET LINK at Annotation for Developers Section */
            $('#get_url').text(url);
            $('#get_url').attr("href", url);

        }); // \getJSON

    } // \getdata

    $(document).ready(function(){

        // Páginação controlda
        $('#definepaginacao').on('change', function () {
        var qtd = $("#paginacao").children("option:selected").val();
        $('#tabela').DataTable().page.len(qtd).draw();
        });

        // Considera ordenação correta em PT, A, À, Á, B, C ... Z
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

        $('#paginar').on('change', ()=> {
            if (!$('#paginar').prop('checked'))
                $('#tabela').DataTable().page.len(-1).draw()
            else if (qtd)
                $('#tabela').DataTable().page.len(qtd).draw()
            else
                $('#tabela').DataTable().page.len(10).draw()
        });
    });

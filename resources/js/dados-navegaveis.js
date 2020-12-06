$("path, circle").hover(function(e) {
    $('#info-box').css('display','block');
    $('#info-box').html($(this).data('info'));
  });
  
  $("path, circle").mouseleave(function(e) {
    $('#info-box').css('display','none');
  });
  
  $(document).mousemove(function(e) {
    $('#info-box').css('top',e.pageY-$('#info-box').height()-30);
    $('#info-box').css('left',e.pageX-($('#info-box').width())/2);
  }).mouseover();
  
  var ios = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
  if(ios) {
    $('a').on('click touchend', function() {
      var link = $(this).attr('href');
      window.open(link,'_blank');
      return false;
    });
  }


/**
 * JURISDICTION, reactive form interface, multiple APIs.
 * 
 */
function replaceAll(str, find, replace) {
  return str.replace(new RegExp(find, 'g'), replace);
}

/* Formatting function for row details - modify as you need */
function format ( d ) {
  // `d` is the original data object for the row
  if (d.info == null) return '<table><td>Indisponível.</td></table>'

  var request = new XMLHttpRequest();
  var api_wikidata = `https://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&property=P242&entity=Q${d.wikidata_id}&origin=*`;
  request.open('GET', api_wikidata, false);  // `false` makes the request synchronous
  request.send(null);

  
  data = (request.status === 200) ? JSON.parse(request.responseText) : '';    
  file_name = replaceAll(data.claims.P242[0]["mainsnak"]["datavalue"].value,' ', '_');
  file_path = `http://commons.wikimedia.org/wiki/Special:FilePath/${file_name}?width=300px`;
      

  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
  '<tr>'+
      '<td>notes:</td>'+
      '<td>'+d.info.notes+'</td>'+
  '</tr>'+
  '<tr>'+
      '<td>creation:</td>'+
      '<td>'+d.info.creation+'</td>'+
  '</tr>'+
  '<tr>'+
      '<td>extinction:</td>'+
      '<td>'+d.info.extinction+'</td>'+
  '</tr>'+
  '<tr>'+
      '<td>postalCode_ranges:</td>'+
      '<td>'+d.info.postalCode_ranges+'</td>'+
  '</tr>'+
  '</table>' + 
  '</br><table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
  '<tr><td><strong>Mapa</strong></td></tr>' +
  '<tr><td><a href="http://wikidata.org/entity/Q'+d.wikidata_id+'">' +
  '<img src="'+file_path+'"></a></td></tr></table>';
}

  
function getdata(param = null){

  // Filtro
  if (param == null && abbrev == 'deny')  
      return alert('Você deve escolher uma opção para consultar.');

  url = "http://api-test.addressforall.org/v1/vw_core/jurisdiction/"; 
  url += (param) ? param : "?limit=10";

  $.getJSON(url, function(data) {
      $('#tabela').show();
      $('#definepaginacao').show();

      // Changes automatically html pagination options from select based on data length
      $('#paginacao option').show();
      $('#paginacao option').filter(function(){ return parseInt(this.value) > data.length}).hide();

      var table = $('#tabela').DataTable({
          "bDestroy": true,
          "dom": 'Bfrtip',
          "buttons": [],
          "data" : data,
          "columns" : [
              {
                  "data" : null,
                  "render" : data=> (data["osm_id"] > 0) ? `<a title="Mapa" rel="external noopener" target="_blank" href="http://osm.org/relation/${data.osm_id}" target_blank>${data.name}</a>` : data["name"]
              },
              {"data": "abbrev"},
              {
                  "data" : null,
                  "render": data=> (data["wikidata_id"]) ? `<a target="_blank" rel="external noopener" href="http://wikidata.org/entity/Q${data.wikidata_id}" target_blank>${data.wikidata_id}</a>` : ''
              },
              {"data": "ddd"},
              {
                  "className": 'details-control',
                  "orderable": false,
                  "data": null,
                  "defaultContent": ''
              }
          ],
          "paging": $('#paginar').prop('checked'),
          "responsive": true,
          "pageLength" : 15
      });
      
      // Add title at info column (+)(-)
      $(".details-control").attr("title","Pack Info");
      $('#tabela tbody').on('click', 'td.details-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);
          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          }
          else {
              // Open this row
              row.child( format(row.data()) ).show();
              tr.addClass('shown');
          }
      });

      /* Changes automatically the GET LINK at Annotation for Developers Section */
      $('#get_url').text(url);
      $('#get_url').attr("href", url);

  }); // \getJSON

} // \getdata


$(document).ready(function(){



  // getdata(param = 'parent_abbrev.eq.SP?limit=10');

  // seach for abbrev as a get parameter 
  let searchParams = new URLSearchParams(window.location.search);
  if (searchParams.has('abbrev')){
      getdata('parent_abbrev.eq.' + searchParams.get('abbrev'));
      $('#'+searchParams.get('abbrev')).css({fill: '#2255c1'});
  }

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

});

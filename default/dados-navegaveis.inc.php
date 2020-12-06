<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333333;
}
li {
  float: left;
}
.active {
	background-color: #2255c1 !important;
}
li a {
  display: block;
  color: white;
  text-align: center;
  padding: 10px;
  text-decoration: none  !important;
}
li a:hover {
  background-color: #111111;
}
.menu-uf a {
	color: white;
	font-weight: bold;
}
.menu-uf {
	border-radius: 10px;
}
.grid-container {
    display: grid;
    /*grid-template-columns: 1fr 600px;*/
    grid-gap: 10px;
    grid-template-columns: repeat(auto-fill, minmax(450px, 1fr)); /* see notes below */

}
td.details-control {
        background: url('/resources/img/details_open.png') no-repeat center center;
        cursor: pointer;
}
tr.shown td.details-control {
        background: url('/resources/img/details_close.png') no-repeat center center;
}
ul.menu-uf a { cursor: pointer; }
.active { color:#f00;font-weight:bolder; }
</style>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script>
	function create_select(){
		let states = ['BR','AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG','MS','MT','PA','PB','PE','PI','PR','RJ','RN','RO','RR','RS','SC','SE','SP','TO'];
		let li_tag = '';
		let searchParams = new URLSearchParams(window.location.search);
		abbrev = searchParams.get('abbrev');
		for(var n in states){
			let c = (abbrev == states[n]) ? " class = 'active' " : '';
			li_tag += `\n<li><a${c} href="/dados-navegaveis?abbrev=${states[n]}">${states[n]}</a></li>`;
		}
		return li_tag;
	}
</script>
<link rel="stylesheet" href="./resources/css/dados-navegaveis.css">
<section class="main-api" style="">
	<h1>Mapa de Dados</h1>
	<p>Em desenvolvimento...</p>
	<div>
		<ul class="menu-uf">
			<script>document.write(create_select());</script>
		</ul>
	</div>
	</br>
	<div class="grid-container">
		<div class="grid-child"><h2>&#x1F5FA; Gráfico</h2>
			<?php include 'default/mapa-do-brasil.inc.php';?>
		</div>

		<div class="grid-child"><h2>&#x1F5D2; Matriz</h2>
			<table id="tabela" class="display responsive nowrap" style="display: none;">
				<thead>
					<tr>
						<th>Name</th>
						<th>Abbrev</th>
						<th>Wikidata</th>
						<th>DDD</th>
						<th>Info</th>    
					</tr> 
				</thead>
			</table>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="./resources/js/dados-navegaveis.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/sp-1.1.1/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>

</section>
<!-- END MAIN CONTAINER  -->

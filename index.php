<?php
// CONTROLLER:
$nomeDaPagina = isset($_GET['uri']) ? trim($_GET['uri'], '/') : '';
$urnRegexes = [
   'br;sp;sao.paulo:associacao;dns-addressforall.org:estatuto:2020-04-03'   => '_private/A4A-Estatuto2020-04-03.htm'
  ,':estatuto:2020-04-03' => '_private/A4A-Estatuto2020-04-03.htm'
  ,':estatuto:2020'       => '_private/A4A-Estatuto2020-04-03.htm'
  ,':estatuto'            => '_private/A4A-Estatuto2020-04-03.htm'
  ,':estatuto~html'       => '_private/A4A-Estatuto2020-04-03.htm'
  ,'br;sp;sao.paulo:associacao;dns-addressforall.org:colecao:2020-04-03;v7' => '_private/A4A-colecao2020-04-v7.htm'
  ,':colecao:2020-04-03;v7' => '_private/A4A-colecao2020-04-v7.htm'
  ,':colecao:2020-04-03;v7.reg~pdf.assign' => '_private/A4A-colecao2020-04-v7_reg~assign.pdf'
  ,'br;sp;sao.paulo:associacao;dns-addressforall.org:estatuto:2020-04-03~pdf.assign' => '_private/A4A-Estatuto2020-04-03.assign.pdf'
  ,':estatuto:2020-04-03~pdf.assign' => '_private/A4A-Estatuto2020-04-03.assign.pdf'
];

if (!$nomeDaPagina)  $nomeDaPagina = 'home';
elseif ( preg_match('/urn:lex:(.+)$/', $nomeDaPagina, $m) && isset($urnRegexes[$m[1]]) ) {
   // $urnLex = $m[1];   print "ok URN LEX = $urnLex";
   $f = $urnRegexes[$m[1]];
   if (substr($f,-3)=='pdf') {
     header('Content-Type: application/pdf');
     //header('Content-Disposition: attachment; filename="downloaded.pdf"');
     readfile($f); // binary
   } else
     include ( $f );
   exit(0);
}
// if ($nomeDaPagina ~ redir) {header('Location: $base/$nomeDaPagina '); exit;}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Address For All | O site dos endereços brasileiros</title>
  <link rel="shortcut icon" type="image/png" href="resources/img/address_for_all-01-colorful.ico.png" />
  <link rel="stylesheet" href="resources/css/navbar.css" />
  <link rel="stylesheet" href="resources/css/style.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" integrity="sha256-IFHWFEbU2/+wNycDECKgjIRSirRNIDp2acEB5fvdVRU=" crossorigin="anonymous"></script>
</head>

<body>
  <!-- START NAVBAR -->
  <header class="header">
    <section class="navigation">
      <div class="nav-container">
        <div class="brand">
          <a href="home" class="logo"><img src="resources/img/address_for_all-01-colorful.png" /></a>
        </div>
        <nav>
          <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
          <ul class="nav-list">
            <li>
              <a href="#!">Address For All</a>
              <ul class="nav-dropdown">
                <li>
                  <a href="quemsomos">Quem Somos</a>
                </li>
                <li>
                  <a href="projetos">Projetos</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#!">Dados & API</a>
              <ul class="nav-dropdown">
                <li>
                  <a href="dados">Dados</a>
                </li>
                <li>
                  <a href="servicos">Serviços</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="ferramentas">Ferramentas</a>
            </li>
            <li>
              <a href="faq">FAQ</a>
            </li>
            <li>
              <a href="contribua">Contribua</a>
            </li>
            <li>
              <a href="parceiros">Parceiros</a>
            </li>
            <li>
              <a href="https://medium.com/@thierryjean/my-diary-supporting-openstreetmap-and-mapillary-in-brazil-a6eb913eb695" target='_blank'>Blog</a>
            </li>
          </ul>
        </nav>
      </div>
    </section>
  </header>
  <!-- END NAVBAR -->

  <?php include_once("default/$nomeDaPagina.inc.php"); ?>

  <!-- START NEWSLETTER -->
  <section class="newsletter">
    <div class="newsletter-container">
      <span>Para ser informado das novidades, assine nossa newsletter:</span>
      <div class="newsletter-form-container">
        <form class="newsletter-form">
          <input type="email" placeholder="email@email.com.br" />
          <button id="newsletter-button" type="submit" value="enviar">
            <!-- <i class="fas fa-angle-right"></i> -->
            <span class="newsletter-span"></span>
          </button>
        </form>
      </div>
    </div>
  </section>
  <!-- END NEWSLETTER -->

  <!-- START LICENSE -->
  <section class="licenca">
    <span>Base de endereços do Brasil com
      <a href="http://opendefinition.org/od/2.1/pt-br/" target="_blank">
        <b>Licença Aberta</b>
        &nbsp;<img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Open_Definition_logo.png" title="Licença Aberta" alt="Logo Licença Aberta" class="logo-licenca" /></a>
    </span>
  </section>
  <!-- END LICENSE -->

  <!-- START JS -->
  <script type="text/javascript" src="resources/js/navbar.js"></script>
</body>

</html>

<?php
// CONTROLLER:
$nomeDaPagina = isset($_GET['uri']) ? trim($_GET['uri'], '/') : '';
if (!$nomeDaPagina)  $nomeDaPagina = 'home';
// if ($nomeDaPagina ~ redir) {header('Location: $base/$nomeDaPagina '); exit;}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Address For All | O site dos endereços brasileiros</title>
  <link rel="shortcut icon" type="image/png" href="resources/img/favicon.png" />
  <link rel="stylesheet" href="resources/css/navbar.css" />
  <link rel="stylesheet" href="resources/css/style.css" />
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<body>
  <!-- START NAVBAR -->
  <header class="header">
    <section class="navigation">
      <div class="nav-container">
        <div class="brand">
          <a href="home" class="logo"><img src="resources/img/address_for_all-01.png" /></a>
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

  <?php include_once("$nomeDaPagina.inc.php"); ?>

  <!-- START NEWSLETTER -->
  <section class="newsletter">
    <div class="newsletter-container">
      <span>Para ser informado das novidades, assine nossa newsletter:</span>
      <div class="newsletter-form-container">
        <form class="newsletter-form">
          <input type="email" placeholder="email@email.com.br" />
          <button type="submit" value="enviar">
            <i class="fas fa-angle-right"></i>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" integrity="sha256-IFHWFEbU2/+wNycDECKgjIRSirRNIDp2acEB5fvdVRU=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="resources/js/navbar.js"></script>
</body>

</html>
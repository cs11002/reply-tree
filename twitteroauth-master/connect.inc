<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reply-tree</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Loading Bootstrap -->
    <link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css">
    <!-- Loading Flat UI -->
    <link rel="stylesheet" type="text/css" href="css/flat-ui.css">
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="./js/modal.js"></script>
    <script type="text/javascript" src="./js/readmore.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico">
  </head>
  <body id="connect-top">
    <div id="container">
      <!-- navbar -->
      <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <a class="navbar-brand" href="./index.php">Reply-tree</a>
        </div>
      </nav><!-- /navbar -->
      <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
        <?php } ?>
      <?php if (isset($status_text)) { ?>
        <?php echo '<h3>'.$status_text.'</h3>'; ?>
      <?php } ?>
       <section>
        <center>
          <h1 id="top">会話を、見よう。</h1>
          <div id="sighin">
            Reply-treeはtwitterのリプライをツリー表示します。<br/>
            
              <?php print_r($content); ?>
          </div><!-- sighin -->
        </center>  
      </section>
    </div>
  </body>
  <footer>
    <div id="footer">Reply-treeは現在開発中です</div>
  </footer>
</html>

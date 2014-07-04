<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reply-tree</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Loading Bootstrap -->
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">
    <!-- custom css -->
    <link href="./css/style.css" rel="stylesheet">
    <script src="./js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="./js/modal.js" type="text/javascript"></script>
    <script type="text/javascript" src="./js/readmore.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico">
  </head>
  <body>
    <!-- modal -->
    <div id="modal">
      <div class="background"></div>
      <div class="container"></div>
    </div>
    <!-- navbar -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header">
        <a class="navbar-brand" href="./index.php">Reply-tree</a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav">           
          <li><a href="./index.php">Home</a></li>
          <li><a href="#fakelink">Meition</a></li>          
          <li><a href="#fakelink" id="nav-user">User</a></li>
        </ul>              
        <div class="navbar-form navbar-right" action="#">
          <span class="fui-new"></span>
        </div>
      </div><!-- /.navbar-collapse -->
    </nav><!-- /navbar -->

      <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
      <?php } ?>
    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>

    <section>
      <article id="post">
        <form action="post.php" method="post">
          <input type="text" name="tweet" placeholder="Tweet..." class="form-control" onkeyup="ShowLength(value);" /><br/>
          <p id="inputlength">0文字/140文字</p>
          <input type="submit" class="btn btn-info" value="Tweet" /><br/>
        </form>
        <hr>
      </article>
      <?php print_r($content); ?>
      <form id="read-more">
        <center>
          <input class="btn btn-default" id="read-more" type="button" value="readmore" onclick="readmore()">
        </center>
      </form>
    </section>
  </body>
  <footer>
    <div id="footer">Reply-treeは現在開発中です</div>
  </footer>
  <script type="text/javascript">
  <!--
    function ShowLength( str ) {
      document.getElementById("inputlength").innerHTML = str.length + "文字/140文字";
   }
  --></script>

</html>

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


    <nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
      <span class="sr-only">Toggle navigation</span>
    </button>
    <a class="navbar-brand" href="#">Reply-tree</a>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse-01">
    <ul class="nav navbar-nav">           
      <li><a href="#fakelink">Home</a></li>
      <li><a href="#fakelink">Meition</a></li>
    </ul> 

    <ul class="nav navbar-right">           
      <li><a href="#fakelink">User</a></li>
    </ul>              
  </div><!-- /.navbar-collapse -->

</nav><!-- /navbar -->
    <!-- modal -->
    <div id="modal">
      <div class="background"></div>
      <div class="container"></div>
    </div>

    <a href="./index.php">
      <!-- <img src="images/logo.png" id="title"/> -->
    </a>

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
      <!--
        <a rel="leanModal" href="#div787">Edit</a>
      -->
        
      </article>
      <?php print_r($content); ?>
      <form>
        <input type="button" value="readmore" onclick="readmore()">
      </form>
    </section>
  </body>
  <footer>
    <div id="footer">Reply-treeは現在開発中です</div>
  </footer>
  <script type="text/javascript"><!--
    function ShowLength( str ) {
      document.getElementById("inputlength").innerHTML = str.length + "文字/140文字";
   }
// --></script>

</html>

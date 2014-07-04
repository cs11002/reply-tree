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

    <link rel="shortcut icon" href="images/favicon.ico">
  </head>
  <body>
    
    <!-- modal -->
    <div id="modal">
      <div class="background"></div>
      <div class="container"></div>
    </div>

    <a href="./index.php">
      <img src="images/logo.png" id="title"/>
    </a>

      <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
      <?php } ?>
    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>

    <section>
      <article>
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
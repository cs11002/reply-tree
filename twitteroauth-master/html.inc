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
  <script type="text/javascript">
  <!--
  function ShowLength( str ) {
    document.getElementById("inputlength").innerHTML = str.length + "文字/140文字";
  }
  $(function(){
    // 「id="post"」を非表示
    $("#post").css("display", "none");

    // 「class=".fui-new」がクリックされた場合
    $(".fui-new").click(function(){
        // 「id="post"」の表示、非表示を切り替える
      $("#post").toggle();
    });
  });
  -->
  </script>
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
          <li><a href="./index2.php">Mention</a></li>          
          <li><a href="./index3.php">User</a></li>
          <li><span class="fui-new"></span></li>
          <li><a href="./clearsessions.php">Logout</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav><!-- /navbar -->
    <?php if (isset($menu)) { ?>
      <?php echo $menu; ?>
      <?php } ?>
    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>
    <section>
       <div class="arrow_box"><!-- tweet box -->
        <article id="post">
          <form action="post.php" method="post">
            <input type="text" name="tweet" placeholder="Tweet..." class="form-control" onkeyup="ShowLength(value);" /><br/>
            <p id="inputlength">0文字/140文字</p>
            <input type="submit" class="btn btn-info" value="Tweet" /><br/>
          </form>
        </article>
      </div>
      <?php print_r($content); ?><!-- recent tweet -->
      <!--
      <form id="read-more">
        <center>
          <input class="btn btn-default" id="read-more" type="button" value="readmore" onclick="readmore()">
        </center>
      </form>
      -->
    </section>
  </body>
  <footer>
    <div id="footer">Reply-treeは現在開発中です</div>
  </footer>
</html>

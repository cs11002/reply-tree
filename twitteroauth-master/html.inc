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
    <link href="./css/style.css" rel="stylesheet">
    <script src="./js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="./js/jquery.leanModal.min.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico">
  </head>
  <body>
    <img src="images/logo.png"/>
      <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
      <?php } ?>
    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>
    <section>
      <article>
        <input type="text" placeholder="Tweet..." class="form-control" onkeyup="ShowLength(value);" /><br/>
        <p id="inputlength">0文字/124文字</p>
        <button class="btn btn-info">Tweet</button><br/>
        <hr>
<!--        
        <a rel="leanModal" href="#div787">Edit</a>
        -->
        <?php require('modal.php'); ?>






      </article>
      <?php print_r($content); ?>
    </section>
  </body>
  <footer>
    Reply-treeは現在開発中です
  </footer>
  <script type="text/javascript"><!--
   function ShowLength( str ) {
      document.getElementById("inputlength").innerHTML = str.length + "文字/124文字";
   }
// --></script>
  <script type="text/javascript">
    $(function() {
      $('a[rel*=leanModal]').leanModal({
        top: 40,
        overlay : 0.5, 
        closeButton: ".modal_close",
      });
    }); 
  </script>

</html>

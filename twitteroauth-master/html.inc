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

    <link rel="shortcut icon" href="images/favicon.ico">

  </head>
  <body>
    <div>
      <img src="images/logo.png"/>
      <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
      <?php } ?>
    </div>
    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>
    <p>
      <pre>
        <input type="text" placeholder="Tweet..." class="form-control" />
        <button class="btn btn-info">Tweet</button>
        <hr>
        <?php print_r($content); ?>
      </pre>
    </p>
  </body>
  <footer>
    Reply-treeは現在開発中です
  </footer>
</html>

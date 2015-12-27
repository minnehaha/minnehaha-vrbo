<!DOCTYPE html>
<html lang="<?php print $language->language; ?>">
<head>
  <?php print $head; ?>
    <?php print '<meta name="description" content="'.$seo_description.'">';?>
    <?php print '<meta name="keywords" content="'.$seo_keywords.'">';?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo '<meta name="geo.region" content="US-'.$state.'" />'."\n";?>
    <?php echo '<meta name="geo.placename" content="'.$city.'" />'."\n";?>
    <?php echo '<meta name="geo.position" content="'.$latitude.';'.$longitude.'" />'."\n"; ?>
    <?php echo '<meta name="ICBM" content="'.$latitude.', '.$longitude.'" /> '."\n";?>
  <title><?php
      print $seo_title;
     ?></title>
   <?php print '<script>';
   print 'var MIN_CONFIG = (function () {';
      print 'var viewDriverHost = "'.$interfaceConfig['driver_url'].'";';
      print 'var viewDriverPort = "'.$interfaceConfig['driver_port'].'";';
//implement the public part
      print 'return {';
          print 'getDriverUrl: function () {';
             print "return 'http://' + viewDriverHost + ':' + viewDriverPort;";
          print '}';
      print '};';
    print '}());';
   print '</script>';?>
  <?php print '<script src="http://'.$interfaceConfig['driver_url'].':'.$interfaceConfig['driver_port'].'/socket.io/socket.io.js"></script>';?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>

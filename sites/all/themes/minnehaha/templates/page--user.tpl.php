<div class="ganti-warna">
    <?php include './'. path_to_theme() .'/templates/section--sticky-property-menu.php';?>
</div>
<div class="isi">
    <div class="container">
        <div class="row">
            <?php include './'. path_to_theme() .'/templates/section--header.php';?>
        </div>
        <div class="row">
            <div class="span12 batas"></div>
            <div class="clearfix"></div>
            <div class="span12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/">Home</a> <span class="divider">/</span>
                    </li>
                    <li class="active">Guest Account</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class='span3'>
                <div class="pagge">
                    <?php print render($title_prefix); ?>
                    <?php if ($title): ?>
                        <h2>Guest Account</h2>
                    <?php endif; ?>
                    <?php print render($title_suffix); ?>
                    <h3>...guest login and profile information</h3>
                </div>
            </div>
            <div class='span9'>
                <div class="bga" style="background:url('<?php if(!empty($image_url)){print $image_url;} ?>') no-repeat;">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="span12 batasdot"></div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="span3">
                <!--                --><?php //print render($page['property_menu']); ?>
                <ul class="nav nav-list">
                    <?php include './'. path_to_theme() .'/templates/section--location-menu.php';?>
                </ul>
                <?php include './'. path_to_theme() .'/templates/section--other-menu.php';?>
            </div>
            <div class="span9">
                    <?php if (!empty($page['highlighted'])): ?>
                        <div class="highlighted hero-unit"><?php print render($page['highlighted']); ?></div>
                    <?php endif; ?>
                    <a id="main-content"></a>
                    <?php print $messages; ?>
                    <?php if (!empty($tabs)): ?>
                        <?php print render($tabs); ?>
                    <?php endif; ?>
                    <?php if (!empty($page['help'])): ?>
                        <div class="well"><?php print render($page['help']); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($action_links)): ?>
                        <ul class="action-links"><?php print render($action_links); ?></ul>
                    <?php endif; ?>
                    <?php print render($page['content']); ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div><!-- end container -->
    <div class="footers">
        <?php include './'. path_to_theme() .'/templates/section--footer.php';?>
    </div>
</div><!-- end isi -->

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
                    <li class="active"><?php print $title; ?></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class='span3'>
                <div class="pagge">
                    <?php print render($title_prefix); ?>
                    <?php if ($title): ?>
                        <h2>Blog</h2>
                    <?php endif; ?>
                    <?php print render($title_suffix); ?>
                    <h3>...sharing information about Minnesota</h3>
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
                    <li class="nav-header">Articles</li>
                    <?php print render($page['article_menu']); ?>
                    <li class="divider"></li>
                    <?php include './'. path_to_theme() .'/templates/section--location-menu.php';?>
                </ul>
                <?php include './'. path_to_theme() .'/templates/section--other-menu.php';?>
            </div>
            <div class="span9">
                <?php if ($tabs): ?><?php print render($tabs); ?><?php endif; ?>
                <?php if ($action_links): ?>
                    <ul class="action-links"><?php print render($action_links); ?></ul>
                <?php endif; ?>
                <?php print $feed_icons; ?>
                <?php
                hide($content['field_title_description']);
                print render($page['content']);
                ?>
                <?php print $feed_icons; ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div><!-- end container -->
    <div class="footers">
        <?php include './'. path_to_theme() .'/templates/section--footer.php';?>
    </div>
</div><!-- end isi -->

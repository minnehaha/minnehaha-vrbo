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
                        <a href="${createLink(action: 'home')}">Home</a> <span class="divider">/</span>
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
                        <h2><?php print $title; ?></h2>
                    <?php endif; ?>
                    <?php print render($title_suffix); ?>
                    <h3><?php if(!empty($page_slogan)){print $page_slogan;} ?></h3>
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
            <div class="span4">
                    <ul class="nav nav-list">
                        <li class="nav-header">Where You Can Find us</li>
                        <li><i class="icon-home"></i><?php if(!empty($city) && !empty($state)){print $city.', '.$state;} ?></li>
                        <li><i class="icon-road"></i><?php if(!empty($street_address)){print $street_address;} ?></li>
                        <li><?php if(!empty($zip_code)){print $zip_code;} ?></li>
                        <li><iframe width="280" height="280" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;q=3324+23rd+Ave+South+Minneapolis,+mn+55407&amp;ie=UTF8&amp;hq=&amp;hnear=3324+23rd+Ave+S,+Minneapolis,+Minnesota+55407&amp;gl=us&amp;t=m&amp;ll=44.941959,-93.239422&amp;spn=0.021264,0.030041&amp;z=14&amp;output=embed"></iframe></li>
                        <li class="nav-header"></li>
                        <li><?php if(!empty($phone_number)){print $phone_number;} ?></li>
                    </ul>
            </div>
            <div class="span8">
                <?php if ($tabs): ?><?php print render($tabs); ?><?php endif; ?>
                <?php if ($action_links): ?>
                    <ul class="action-links"><?php print render($action_links); ?></ul>
                <?php endif; ?>
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


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
            <div class="span3">
<!--                --><?php //print render($page['property_menu']); ?>
                <ul class="nav nav-list">
                    <?php include './'. path_to_theme() .'/templates/section--location-menu.php';?>
                </ul>
                <?php include './'. path_to_theme() .'/templates/section--other-menu.php';?>
            </div>
            <div class="span9">
                <?php if ($tabs): ?><?php print render($tabs); ?><?php endif; ?>
                <?php if ($action_links): ?>
                    <ul class="action-links"><?php print render($action_links); ?></ul>
                <?php endif; ?>
                <p><?php print $paragraphBeforeFAQs ?></p>
                <?php
                foreach($listOfFAQ as $key => $question_answer){
                    print '<ul class="nav nav-list">';
                    print '<li class="nav-header"> <i class="icon-wrench"></i>'.$question_answer['question'].'</li>';
                    print '</ul>';
                    print '<p>'.$question_answer['answer'].'</p>';
                }
                ?>
                <p><?php print $paragraphAfterFAQs ?></p>

                <?php print $feed_icons; ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div><!-- end container -->
    <div class="footers">
        <?php include './'. path_to_theme() .'/templates/section--footer.php';?>
    </div>
</div><!-- end isi -->
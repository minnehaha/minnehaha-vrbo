<div class="ganti-warna">
    <?php include './'. path_to_theme() .'/templates/section--sticky-property-menu.php';?>
</div>
<script>
    <?php include './'. path_to_theme() .'/templates/section--temp-processing.php';?>
</script>
<?php print '<script src="'.base_path() . path_to_theme() .'/js/featured-review-list.js?v=22"></script>';?>
<div class="isi">
    <div class="container">
      <div class="row">
          <?php include './'. path_to_theme() .'/templates/section--header.php';?>
      </div>
      <div class="row">
        <div class="span12 batas"></div>
        <div class="clearfix"></div>
        <div class="span12">
            <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner">
                    <div class="item  active">
                        <?php print '<img src="'.$slidePhotos[0]['url'].'"
                                          alt="'.$slidePhotos[0]['alt'].'">'; ?>
                    <div class="carousel-caption">
                        <h2>Elegance in Design</h2>
                        <p>Elegantly furnished to ensure a comfortable and quality furnished home experience </p>
                    </div>
                </div>
                <div class="item">
                    <?php print '<img src="'.$slidePhotos[1]['url'].'"
                                      alt="'.$slidePhotos[1]['alt'].'">'; ?>
                    <div class="carousel-caption">
                        <h2>Charm</h2>
                        <p>Restoring its original beauty while attaching today's craftsman touch brings a charm to our places that will please you at every moment</p>
                    </div>
                </div>
                <div class="item">
                    <?php print '<img src="'.$slidePhotos[2]['url'].'"
                                      alt="'.$slidePhotos[2]['alt'].'">'; ?>
                    <div class="carousel-caption">
                        <h2>Feel of Home</h2>
                        <p>Furnished with everything one may wish, with your own back yard while located in lovely south minneapolis neighborhood adds a feel of home while away</p>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
        </div>
      </div>

    </div>


<div class="row">
    <div class="span12 batasdot"></div>
    <div class="clearfix"></div>
</div>

<div class="row">
    <div class="span12">
        <div class="well-small">
            <div class="well-header"><h2><?php print $welcome_note; ?></h2></div>

            <div class="row-fluid">
                <div class="span12"><?php print $welcome_intro; ?>
                </div>
                <div class="clearfix batas"></div>
            </div>
            <div class="row-fluid">
                <?php
                foreach($propertyMap as $key => $rental_unit){
                    print '<div class="span3 sticker">';
                    print '<h4>'.$rental_unit['title'].'</h4>';
                    print '<div class="clearfix batas"></div>';
                    print '<a class="thumbnail">';
                    print '<img src="'.$rental_unit['featuredPhotoUrl'].'" alt="'.$rental_unit['featuredPhotoAlt'].'">';
                    print '</a>';
                    print '<div class="clearfix batas"></div>';
                    print '<p>'.substr($rental_unit['summary'],0,120).'...</p>';
                    print '<div class="clearfix batas"></div>';
                    print '<a class="btn btn-small" href="'.$rental_unit['url'].'"><i class="icon-info-sign"></i> More Info</a>';
                    print '</div>';
                }
                ?>
                <div class="span3 sticker">
                    <?php
                    print '<h4>Meet Your Hosts</h4>';
                    print '<div class="clearfix batas"></div>';
                    print '<a class="thumbnail">';
                        print '<img src="'.$aboutHost['imgUrl'].'" alt="'.$aboutHost['imgAlt'].'">';
                    print '</a>';
                    print '<div class="clearfix batas"></div>';
                    print '<p>'.substr($aboutHost['summary'],0,120).'...</p>';
                    print '<div class="clearfix batas"></div>';
                    print '<a class="btn btn-small" href="'.$aboutHost['url'].'"><i class="icon-info-sign"></i> More Info</a>';
                    ?>
                </div>
                <div class="span6 sticker">
                    <h1 class="subjudul">Minnehaha Lofts Blog</h1>

                    <?php print render($page['diary_list_front']);?>
                    <p>
                        <a class="btn btn-small" href="/furnished-extended-stay-mn-blog"><i class="icon-asterisk"></i> Read All</a>
                    </p>
                </div>
                <div class="span5 sticker">
                    <h5><i class=" icon-comment jarak-kecil"></i> Testimonial</h5>
                    <br />
                    <div id="testimonial-list" class="featured-testimonials">
                        <!-- testimonials are appended here -->
                    </div>
                    <p>
                        <?php print '<a class="btn btn-small" href="'.$testimonialUrl.'"><i class="icon-comment"></i> More</a>';?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row rich-snippets">
        <div class="span12">
            <div itemscope itemtype="http://schema.org/Organization">
                <span itemprop="name">Minnehaha Lofts</span> <?php print $rich_snippet ?>
                <div class="span2">
                    <?php print '<a href="'.$GLOBALS['base_url'].base_path().$rental_unit['url'].'"><img class="img-circle" itemprop="logo" src="'.$rental_unit['featuredTestimonialPhotoUrl'].'" /></a>'?>
                </div>
                <?php foreach($propertyMap as $key => $rental_unit){ ?>
                <div itemscope itemtype="http://schema.org/PostalAddress">
                     <blockquote >
                        <span itemprop="name"><?php print $rental_unit['title']; ?></span>
                        <br>
                        <span itemprop="streetAddress"><?php print $rental_unit['fieldPropertyAddress']['street'] ?></span>
                        <span itemprop="addressLocality"><?php print $rental_unit['fieldPropertyAddress']['city'] ?></span>,
                        <span itemprop="addressRegion"><?php print $rental_unit['fieldPropertyAddress']['state'] ?></span>
                        <span itemprop="postalCode"><?php print $rental_unit['fieldPropertyAddress']['zip'] ?></span>
                        <span itemprop="addressCountry">United States</span>
                    </blockquote>
                </div>
                <?php } ?>
                <?php print '<a href="'.$GLOBALS['base_url'].'/" itemprop="url">'.$GLOBALS['base_url'].'</a>';?>
        </div>
    </div>
</div>
<!--<div class="main-container container">-->
<!--    <div class="clearfix bataspanjang"></div>-->
    </div><!-- end container -->
    <div class="footers">
        <?php include './'. path_to_theme() .'/templates/section--footer.php';?>
    </div>
</div><!-- end isi -->
    <script type="application/javascript">
        jQuery('.carousel').carousel();
    </script>

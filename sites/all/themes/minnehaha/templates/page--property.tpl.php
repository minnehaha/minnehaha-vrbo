<div class="ganti-warna">
    <?php include './'. path_to_theme() .'/templates/section--sticky-property-menu.php';?>
</div>
<input type="hidden" id="rentalUnitId" value="<?php print $rentalUnitId; ?>">
<script>
    <?php include './'. path_to_theme() .'/templates/section--temp-processing.php';?>
</script>
<?php print '<script src="'.base_path() . path_to_theme() .'/js/review-list.js?v=50"></script>';?>
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
                    <li class="active">
                        <?php if($title){print $title.' '.$propertyBreadcrumb;} ?>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class='span3'>
                <div class="pagge">
                    <h2><?php print $property_character ?></h2>
                    <h3><?php print $property_slogan; ?></h3>
                </div>
            </div>
            <div class='span9'>
                <ul class="thumbnails">
                    <li class="span3">
                        <a href="#" class="thumbnail">
                            <img src="<?php print $propertyPhotos[0]['url'];?>"
                                 alt="<?php print $propertyPhotos[0]['alt'];?>">
                        </a>
                    </li>
                    <li class="span3">
                        <a href="#" class="thumbnail">
                            <img src="<?php print $propertyPhotos[1]['url'];?>"
                                 alt="<?php print $propertyPhotos[1]['alt'];?>">
                        </a>
                    </li>
                    <li class="span3">
                        <a href="#" class="thumbnail">
                            <img src="<?php print $propertyPhotos[2]['url'];?>"
                                 alt="<?php print $propertyPhotos[2]['alt'];?>">
                        </a>
                    </li>
                    <li class="span3">
                        <a href="#" class="thumbnail">
                            <img src="<?php print $propertyPhotos[3]['url'];?>"
                                 alt="<?php print $propertyPhotos[3]['alt'];?>">
                        </a>
                    </li>
                    <li class="span3">
                        <a href="#" class="thumbnail">
                            <img src="<?php print $propertyPhotos[4]['url'];?>"
                                 alt="<?php print $propertyPhotos[4]['alt'];?>">
                        </a>
                    </li>
                    <li class="span3">
                        <a href="#" class="thumbnail">
                            <img src="<?php print $propertyPhotos[5]['url'];?>"
                                 alt="<?php print $propertyPhotos[5]['alt'];?>">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="span12 batasdot"></div>
            <div class="clearfix"></div>
        </div>


        <div class="row">
            <div class="span3">
                <ul class="nav nav-list">
                    <li class="nav-header"><?php print $propMenuTitle.' '.$fieldPropertyType;?></li>
                    <li class="active"><a href="#about" data-toggle="tab"><i class="icon-info-sign"></i> About</a></li>
                    <li><a href="#map" data-toggle="tab"><i class="icon-map-marker"></i> Map</a></li>
                    <li><a href="#price" data-toggle="tab"><i class="icon-briefcase"></i> Price</a></li>
                    <li><a href="#availability" data-toggle="tab"><i class="icon-zoom-in"></i> Availability</a></li>
                    <li><a href="#unit-inquiry" data-toggle="tab"><i class="icon-question-sign"></i> Inquire</a></li>
                    <li><a href="#unit-testimonial" data-toggle="tab"><i class="icon-comment"></i> Testimonials</a></li>
                    <li><a href="#leave-testimonial" data-toggle="tab"><i class="icon-pencil"></i>Leave Testimonial</a></li>
                    <li class="divider"></li>
                </ul>
                <ul class="nav nav-list">
                    <li class="nav-header"><?php print $otherPropertyListing ?></li>
                    <?php
                    foreach($propertyMapWithoutOne as $key => $rental_unit){
                        print '<li><a href="'.base_path().$rental_unit['url'].'"><i class="icon-home"></i>'.$rental_unit['title'].'</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="about">
                    <div class="span9">
                        <?php if ($tabs): ?><?php print render($tabs); ?><?php endif; ?>
                        <?php if ($action_links): ?>
                            <ul class="action-links"><?php print render($action_links); ?></ul>
                        <?php endif; ?>
                        <?php
                        hide($content['field_title_description']);
                        print render($page['content']);
                        ?>
                        <?php print $feed_icons; ?>
                        <p>
                            <?php print $propertyParagraphs[0];?>
                        </p>
                        <div class="row">
                            <div class="span3">
                                <?php print $propertyParagraphs[1];?>
                            </div>
                            <div class="span3">
                                <div class="thumbnail">
                                    <img src="<?php print $contentPhotoImageUrl1; ?>"
                                         alt="<?php print $contentPhotoImageAlt1; ?>">
                                    <div class="caption">
                                        <h5><?php print $contentPhotoTitle1; ?> </h5>
                                        <p><?php print $contentPhotoDescription1 ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="span3">
                                <div class="thumbnail">
                                    <img src="<?php print $contentPhotoImageUrl2?>"
                                         alt="<?php print $contentPhotoImageAlt2; ?>">
                                    <div class="caption">
                                        <h5><?php print $contentPhotoTitle2; ?></h5>
                                        <p><?php print $contentPhotoDescription2; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php
                        $sizeOfPars = count($propertyParagraphs);
                        for ($i=2; $sizeOfPars>=$i; $i++)
                        {
                            if(!empty($propertyParagraphs[$i])){print '<p>'.$propertyParagraphs[$i].'</p>';}
                        }
                        ?>
                        <hr>
                        <p>
                            Features and amenities
                        </p>
                        <ul style="list-style:none;">
                            <?php
                            $sizeOfAmenities = count($propertyFeatures);
                            for ($i = 0; $sizeOfAmenities > $i; $i++)
                            {
                                print '<li><i class="icon-play-circle"></i>'.$propertyFeatures[$i].'</li>';
                            }
                            ?>

                        </ul>

                       <?php print $fieldPropertyOtherInfo;?>
                    </div>
                </div>
                <div class="tab-pane" id="map">
                    <div class="span9">
                        <div class=span9 style="padding:0;margin: 0" >
                            <div id="ds-map"></div>
                        </div>

                        <div class="row">
                            <div class="span12 batasdot"></div>
                            <div class="clearfix"></div>
                        </div>
                        <dl class="dl-horizontal">
                            <dt>Located: </dt>
                            <dd>
                                <address>
                                    <div itemscope itemtype="http://schema.org/PostalAddress">
                                        <span itemprop="name"><?php if($title){print $title.' (furnished '.$fieldPropertyType.' Minneapolis MN)';} ?></span>
                                        <br>
                                        <span itemprop="streetAddress"><?php print $fieldPropertyAddress['street'] ?></span>
                                        <span itemprop="addressLocality"><?php print $fieldPropertyAddress['city'] ?></span>,
                                        <span itemprop="addressRegion"><?php print $fieldPropertyAddress['state'] ?></span>
                                        <span itemprop="postalCode"><?php print $fieldPropertyAddress['zip'] ?></span>
                                        <span itemprop="addressCountry">United States</span>
                                    </div>
                                </address>
                                <div itemprop="location">
                                    <span itemscope itemtype="http://schema.org/Place">
                                        <div itemprop="geo">
                                            <span itemscope itemtype="http://schema.org/GeoCoordinates">
                                                <?php print '<meta itemprop="latitude" content="'.$fieldPropertyAddress['latitude'].'" />';?>
                                                <?php print '<meta itemprop="longitude" content="'.$fieldPropertyAddress['longitude'].'" />';?>
                                            </span>
                                        </div>
                                    </span>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="tab-pane" id="price">
                    <div class="span9">
                        <table class="table">
                            <?php print "<tr><td>High Season</td><td>".$fieldHighSeasonDates."</td><td>".$fieldHighSeasonDailyRate."</td><td>".$fieldHighSeasonWeeklyRate."</td><td>".$fieldHighSeasonMonthlyRate."</td></tr>";
                                  print "<tr><td>Low Season</td><td>".$fieldLowSeasonDates."</td><td>".$fieldLowSeasonDailyRate."</td><td>".$fieldLowSeasonWeeklyRate."</td><td>".$fieldLowSeasonMonthlyRate."</td></tr>";
                                  print "<tr><td>Cleaning Fee</td><td colspan=\"4\">".$fieldCleaningFee."</td></tr>";?>
                            <tr><td>Min Stay</td><td colspan="4">2 nights</td></tr>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="availability">
                    <div class="span9">
                        ..online calendar is coming soon. Please call 612-234-STAY (7829) or <button class="btn">Submit Inquiry</button>
                    </div>
                </div>
                <div class="tab-pane" id="unit-inquiry">
                    <div class="span9">
                        <div id="inquiry-form">
                            <div class="message-section">
                                <div class="alert alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                </div>
                            </div>
                            <input type="hidden" class="rentalUnit" value="<?php print $rentalUnitId; ?>">
                            <?php print render($page['unit_inquiry']); ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="unit-testimonial">
                    <div class="span9">
                        <div id="testimonial-list">
                            <!-- testimonials are appended here -->
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-pane" id="leave-testimonial">
                    <div class="span9">
                        <div id="testimonial-form">
                            <div class="message-section">
                                <div class="alert alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                </div>
                            </div>
                            <input type="hidden" class="rentalUnit" value="<?php print $rentalUnitId; ?>">
                            <?php print render($page['leave_testimonial']); ?>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div><!-- end container -->
    <div class="footers">
        <?php include './'. path_to_theme() .'/templates/section--footer.php';?>
    </div>
</div><!-- end isi -->



    <li class="nav-header"><?php print $otherMenuTitle ?></li>
    <?php
    foreach($propertyMap as $key => $rental_unit){
        print '<li ><a href="/'.$rental_unit['url'].'"><i class="icon-home"></i> '.$rental_unit['title'].'</a></li>';
    }
    ?>
    <li class="divider"></li>
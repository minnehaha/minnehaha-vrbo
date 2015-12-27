<div class="pilihan-warna">
    <ul>
        <?php
        foreach($propertyMap as $key => $rental_unit){
            $indexOfHyphen = strrpos($rental_unit['title'],'-') + 1;
            print '<li><a href="'.base_path().$rental_unit['url'].'">'.substr($rental_unit['title'],0,$indexOfHyphen).'<span style="display:block;margin-left: 25px;margin-top: -5px">'.substr($rental_unit['title'],$indexOfHyphen).'</span></a></li>';
        }
        ?>
    </ul>
</div>
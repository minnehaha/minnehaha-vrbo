    <div class="span6 logo">
        <h1><a href="/">Minnehaha<i>Lofts</i></a> </h1>
        <h2><?php print $siteSlogan; ?></h2>
    </div>
    <div class="span6 pull-right">
            <ul class="nav nav-pills">
                <?php
                foreach($mainMenu as $key=>$menuItem){
                    print '<li';
                    if($menuItem['active']){ print  ' class="active" ';}
                    print '><a href="/'.$menuItem['url'].'">'.$menuItem['title'].'</a></li>';
                }
                ?>
            </ul>
    </div>
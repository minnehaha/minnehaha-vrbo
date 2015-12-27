<?php
function minnehaha_preprocess_html(&$vars, $hook) {
    global $conf;

    // Return nid of nodes of type "interface_configuraitons".
    $nid_config = db_select('node', 'n')
        ->fields('n', array('nid'))
        ->fields('n', array('type'))
        ->condition('n.type', 'interface_configurations')
        ->execute()
        ->fetchCol();
    //load the configurations
    $configurationNode = node_load($nid_config);
    $interfaceConfig = array();

    if(!empty($configurationNode->field_driver_url['und'][0]['value'])){
        //if set by user
        $interfaceConfig['driver_url'] = $configurationNode->field_driver_url['und'][0]['value'];
    }else{
        //hard coded in default/settings.php
        $interfaceConfig['driver_url'] = $conf['global_driver_url'];
    }
    if(!empty($configurationNode->field_driver_port['und'][0]['value'])){
        //if set by user
        $interfaceConfig['driver_port'] = $configurationNode->field_driver_port['und'][0]['value'];
    }else{
        //hard coded in default/settings.php
        $interfaceConfig['driver_port'] = $conf['global_driver_port'];
    }
    $vars['interfaceConfig'] = $interfaceConfig;

    //retrieving general seo content
    $genSeo = node_load($configurationNode->field_seo_general_description['und'][0]['target_id']);
    $seoGenDescription = $genSeo->field_seo_description['und'][0]['value'];
    $seoGenTitle = $genSeo->field_seo_title['und'][0]['value'];
    $seoGenKeywords= $genSeo->field_seo_keywords['und'][0]['value'];;

    //retrieving current page seo content
    $nodeId=max(array_keys($vars["page"]["content"]["system_main"]["nodes"]));
    $currentType = $vars["page"]["content"]["system_main"]["nodes"][$nodeId]["#node"];
    $fieldName = "field_seo_".$currentType->type;
    $seoTextIns = $currentType->$fieldName;
    $seoText = node_load($seoTextIns['und'][0]['target_id']);
    $seoTitle = $seoText->field_seo_title['und'][0]['value'];
    $seoDescription = $seoText->field_seo_description['und'][0]['value'];
    $seoKeywords = $seoText->field_seo_keywords['und'][0]['value'];

    if(!empty($seoTitle)){
        $vars['seo_title'] = $seoTitle;
    }else{
        $vars['seo_title'] = $seoGenTitle;
    }

    if(!empty($seoDescription)){
        $vars['seo_description'] = $seoDescription;
    }else{
        $vars['seo_description'] = $seoGenDescription;
    }

    if(!empty($seoKeywords)){
        $vars['seo_keywords'] = $seoKeywords;
    }else{
        $vars['seo_keywords'] = $seoGenKeywords;
    }

    $genAddress = node_load($configurationNode->field_general_address['und'][0]['target_id']);
    $genLatitude = $genAddress->field_latitude['und'][0]['value'];
    $genLongitude = $genAddress->field_longitude['und'][0]['value'];
    $genCity = $genAddress->field_city['und'][0]['value'];
    $genState = $genAddress->field_state['und'][0]['value'];

    $vars['latitude'] = $genLatitude;
    $vars['longitude'] = $genLongitude;
    $vars['city'] = $genCity;
    $vars['state'] = $genState;

}

function minnehaha_preprocess_page(&$vars, $hook) {
    // Return all nids of nodes of type "property".
    $nids = db_select('node', 'n')
        ->fields('n', array('nid'))
        ->fields('n', array('type'))
        ->condition('n.type', 'property')
        ->execute()
        ->fetchCol(); // returns an indexed array

    //return the property node objects.
    $properties = node_load_multiple($nids);
    $propertyMap = array();
    $i = 0;
    foreach ($properties as $key => $value)
    {
        if($value->status){
            $propertyMap[ $i ]['title'] = $value->title;
            $propertyMap[ $i ]['url'] = drupal_get_path_alias("node/$key");
            $featuredPhoto = $value->field_featured_photo;
            $propertyMap[ $i ]['featuredPhotoUrl'] = url('sites/default/files/'.file_uri_target($featuredPhoto['und'][0]['uri']), array('absolute'=>true));
            $propertyMap[ $i ]['featuredPhotoAlt'] = $value->field_featured_photo['und'][0]['alt'];
            $featuredTestimonialPhoto = $value->field_featured_review_photo;
            $propertyMap[ $i ]['featuredTestimonialPhotoUrl'] = url('sites/default/files/'.file_uri_target($featuredTestimonialPhoto['und'][0]['uri']), array('absolute'=>true));
            $propertyMap[ $i ]['featuredTestimonialPhotoAlt'] = $value->field_featured_review_photo['und'][0]['alt'];
            $fieldParagraphAboutProperty = $value->field_paragraph_about_property;
            $propertyMap[ $i ]['summary'] = $fieldParagraphAboutProperty['und'][0]['value'];
            $propertyMap[ $i ]['universalId'] = $value->field_rental_unit_id['und'][0]['value'];
            $propertyMap[ $i ]['type'] = $value->field_property_type['und'][0]['value'];

            $propertyAddress = field_get_items('node', $value, 'field_property_address');
            $propAddressEntity = node_load($propertyAddress[0]['target_id']);
            $propertyAddressCollection = array();
            $propertyAddressCollection['latitude'] = $propAddressEntity->field_latitude['und'][0]['value'];
            $propertyAddressCollection['longitude'] = $propAddressEntity->field_longitude['und'][0]['value'];
            $propertyAddressCollection['street'] = $propAddressEntity->field_street_address['und'][0]['value'];
            $propertyAddressCollection['state'] = $propAddressEntity->field_state['und'][0]['value'];
            $propertyAddressCollection['city'] = $propAddressEntity->field_city['und'][0]['value'];
            $propertyAddressCollection['zip'] = $propAddressEntity->field_zip_code['und'][0]['value'];
            $propertyMap[ $i ]['fieldPropertyAddress'] = $propertyAddressCollection;
            $i++;
        }

    }

    $vars['propertyMap'] = $propertyMap;

    //about hosts for front page
    $aboutHosts = node_load(17);//@ToDo find way to dynamically get id for basic page - About Host
    $hostsCollection = array();
    $hostsCollection['summary'] = $aboutHosts->field_paragraph_of_content['und'][0]['value'];
    $hostsCollection['url'] = drupal_get_path_alias("node/17");
    $hostsCollection['imgUrl'] = url('sites/default/files/'.file_uri_target($aboutHosts->field_basic_page_featured_photo['und'][0]['uri']), array('absolute'=>true));
    $hostsCollection['imgAlt'] = $aboutHosts->field_basic_page_featured_photo['und'][0]['alt'];
    $vars['aboutHost'] = $hostsCollection;

    //Testimonial page
    $testimonialId = db_select('node', 'n')
        ->fields('n', array('nid'))
        ->fields('n', array('type'))
        ->condition('n.type', 'testimonials')
        ->execute()
        ->fetchCol();
    $testimonialUrl = drupal_get_path_alias("node/$testimonialId[0]");
    $vars['testimonialUrl'] = $testimonialUrl;

    //default header background image
    $basicPageId = db_select('node', 'n')
        ->fields('n', array('nid'))
        ->fields('n', array('type'))
        ->condition('n.type', 'page')
        ->execute()
        ->fetchCol();
    $basicPageNode = node_load($basicPageId);
    $fieldHeaderBkIma = field_get_items('node', $basicPageNode, 'field_header_background_image');
    if ($fieldHeaderBkIma){
        $vars['image_url'] = url('sites/default/files/'.file_uri_target($fieldHeaderBkIma[0]['uri']), array('absolute'=>true));
    }

    //retrieve seo reference list
    // Return nid of nodes of type "interface_configuraitons".
    $nid_config = db_select('node', 'n')
        ->fields('n', array('nid'))
        ->fields('n', array('type'))
        ->condition('n.type', 'interface_configurations')
        ->execute()
        ->fetchCol();
    //load the configurations
    $configurationNode = node_load($nid_config);
    $seoRef = $configurationNode->field_seo_reference['und'];
    $seoRefList = array();
    $j=0;
    foreach($seoRef as $key => $seoRefInst){
        $seoRefObj = node_load($seoRefInst['target_id']);
        $seoRefList[$j]['url'] =  $seoRefObj->field_ref_url['und'][0]['value'];
        $seoRefList[$j]['keyword'] =  $seoRefObj->field_ref_keyword['und'][0]['value'];
        $j++;
    }
    $vars['seoref'] = $seoRefList;

    $propMenuTitle = $configurationNode->field_property_menu_title['und'][0]['value'];
    $otherMenuTitle = $configurationNode->field_other_menu_title['und'][0]['value'];
    $otherPropertyListing = $configurationNode->field_other_property_listing['und'][0]['value'];
    $vars['propMenuTitle'] = $propMenuTitle;
    $vars['otherMenuTitle'] = $otherMenuTitle;
    $vars['otherPropertyListing'] = $otherPropertyListing;

    $siteSlogan = $configurationNode->field_website_slogan['und'][0]['value'];
    $vars['siteSlogan'] = $siteSlogan;

    //generate main menu
    $mainMenuArray = menu_load_links('main-menu');
    $finalMainMenu = array();
    foreach($mainMenuArray as $key=>$menuItem){
        $finalMainMenu[$key]['active'] = false;
        $linkPath = $menuItem['link_path'];
        $linkPathAlias = drupal_get_path_alias($linkPath);
        $currentId = $vars['node']->nid;
        if(drupal_get_path_alias("node/$currentId") == $linkPathAlias || $_GET['q'] == $linkPath)$finalMainMenu[$key]['active'] = true;
        $finalMainMenu[$key]['url'] = $linkPathAlias;
        $finalMainMenu[$key]['title'] = $menuItem['link_title'];
    }
    $vars['mainMenu'] = $finalMainMenu;

    if (isset($vars['node'])) {
        $vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;
        switch($vars['node']->type){
            case "property":
                minnehaha_preprocess_property($vars, $hook, $propertyMap);
                break;
            case "faq_page":
                minnehaha_preprocess_faq_page($vars, $hook);
                break;
            case "testimonials":
                minnehaha_preprocess_testimonials($vars, $hook);
                break;
            case "article":
                minnehaha_preprocess_article($vars, $hook);
                break;
            case "user":
                minnehaha_preprocess_user($vars, $hook);
                break;
            case "contact_us":
                minnehaha_preprocess_contactus($vars, $hook);
                break;
            case "home":
                minnehaha_preprocess_home($vars, $hook);
                break;
            default:
                minnehaha_preprocess_basic_page($vars, $hook);
                break;
        }
    }
}

function minnehaha_preprocess_basic_page(&$vars, $hooks){
    $node = $vars['node'];
    $fieldHeaderBkIma = field_get_items('node', $node, 'field_header_background_image');
    if ($fieldHeaderBkIma){
        $vars['image_url'] = url('sites/default/files/'.file_uri_target($fieldHeaderBkIma[0]['uri']), array('absolute'=>true));
    }

    $fieldPageSlogan = field_get_items('node', $node, 'field_page_slogan');
    if ($fieldPageSlogan){
        $vars['page_slogan'] = $fieldPageSlogan[0]['value'];
    }

    $fieldParagraphOfContent = field_get_items('node', $node, 'field_paragraph_of_content');
    $sizeOfParagraphs = count($fieldParagraphOfContent);
    $basicParagraphs = array();
    for ($i = 0; $sizeOfParagraphs > $i; $i++)
    {
         $basicParagraphs[$i] = $fieldParagraphOfContent[$i]['value'];
    }
    $vars['basicPagePars'] = $basicParagraphs;

    $fieldContentPhotos = field_get_items('node', $node, 'field_content_photos');
    $basicPagePhotos = array();
    for($i = 0; $i < count($fieldContentPhotos); $i++){
        $contentPhoto = node_load($fieldContentPhotos[$i]['target_id']);
        $basicPagePhotos[$i]['contentPhotoTitle'] = $contentPhoto->field_photo_title['und'][0]['value'];
        $basicPagePhotos[$i]['contentPhotoDescription'] = $contentPhoto->field_photo_description['und'][0]['value'];
        $contentPhotoImage = $contentPhoto->field_image_file;
        $basicPagePhotos[$i]['contentPhotoImgUrl'] = url('sites/default/files/'.file_uri_target($contentPhotoImage['und'][0]['uri']), array('absolute'=>true));
        $basicPagePhotos[$i]['contentPhotoImgAlt'] = $contentPhotoImage['und'][0]['alt'];
    }
    if(!empty($basicPagePhotos)){$vars['basicPagePhotos'] = $basicPagePhotos;}else{$vars['basicPagePhotos'] = 'empty';}

    $fieldListOfContentText = field_get_items('node', $node, 'field_list_of_content_text');
    $listOfText = array();
    $entityOfList = node_load($fieldListOfContentText[0]['target_id']);
    $listOfText['description'] = $entityOfList->field_description_of_list['und'][0]['value'];
    $listOfText['item'] = array();
    $numOfItems = count($entityOfList->field_list_item['und']);
    for($i = 0 ; $i < $numOfItems; $i++){
        $listOfText['item'][$i] = $entityOfList->field_list_item['und'][$i]['value'];
    }
    $vars['listOfText'] = $listOfText;
}

function minnehaha_preprocess_faq_page(&$vars, $hook){
    $node = $vars['node'];

    $fieldFAQSlogan = $node->field_faq_page_slogan;
    if ($fieldFAQSlogan){
        $vars['page_slogan'] = $fieldFAQSlogan['und'][0]['value'];
    }
    $fieldFAQHeaderBkIma = field_get_items('node', $vars['node'], 'field_faq_header_background_img');
    if ($fieldFAQHeaderBkIma){
        $vars['image_url'] = url('sites/default/files/'.file_uri_target($fieldFAQHeaderBkIma[0]['uri']), array('absolute'=>true));
    }

    $fieldFAQs =  $node->field_faq_questions_answers;
    $fieldFAQList = array();
    for ($i = 0; count($fieldFAQs['und']) > $i; $i++)
    {
        $qa = node_load($fieldFAQs['und'][$i]['target_id']);
        $fieldFAQList[$i]['question'] = $qa->field_faq_question['und'][0]['value'];
        $fieldFAQList[$i]['answer'] = $qa->field_faq_answer['und'][0]['value'];
    }
    $vars['listOfFAQ'] = $fieldFAQList;

    $fieldParagraphBeforeFAQs = $node->field_paragraph_before_faq;
    if ($fieldParagraphBeforeFAQs){
        $vars['paragraphBeforeFAQs'] = $fieldParagraphBeforeFAQs['und'][0]['value'];
    }
    $fieldParagraphAfterFAQs = $node->field_paragraph_after_faq;
    if ($fieldParagraphAfterFAQs){
        $vars['paragraphAfterFAQs'] = $fieldParagraphAfterFAQs['und'][0]['value'];
    }

}

function minnehaha_preprocess_property(&$vars, $hook, $propertyMap) {
    //@ToDo: this is not called by Drupal,but, perhaps, it should. Temp solution manually calling from 'minnehaha_preprocess_page'
    $node = $vars['node'];

    $propertyUniversalId =  $node->field_rental_unit_id;
    if ($propertyUniversalId){
        $vars['rentalUnitId'] = $propertyUniversalId['und'][0]['value'];
    }

    $fieldPropertyCharacter =  $node->field_property_character;
    if ($fieldPropertyCharacter){
        $vars['property_character'] = $fieldPropertyCharacter['und'][0]['value'];
    }

    $fieldPropertySlogan = $node->field_property_slogan;
    if ($fieldPropertySlogan){
        $vars['property_slogan'] = $fieldPropertySlogan['und'][0]['value'];
    }

    $vars['fieldPropertyType'] = field_get_items('node', $node, 'field_property_type')[0]['value'];
    $vars['fieldPropertyOtherInfo'] = field_get_items('node', $node, 'field_property_other_info')[0]['value'];


    $property_breadcrumb = $node->field_property_breadcrumb['und'][0]['value'];
    $vars['propertyBreadcrumb'] = $property_breadcrumb;

    $propertyAddress = field_get_items('node', $node, 'field_property_address');
    $propAddressEntity = node_load($propertyAddress[0]['target_id']);
    $propertyAddressCollection = array();
    $propertyAddressCollection['latitude'] = $propAddressEntity->field_latitude['und'][0]['value'];
    $propertyAddressCollection['longitude'] = $propAddressEntity->field_longitude['und'][0]['value'];
    $propertyAddressCollection['street'] = $propAddressEntity->field_street_address['und'][0]['value'];
    $propertyAddressCollection['state'] = $propAddressEntity->field_state['und'][0]['value'];
    $propertyAddressCollection['city'] = $propAddressEntity->field_city['und'][0]['value'];
    $propertyAddressCollection['zip'] = $propAddressEntity->field_zip_code['und'][0]['value'];
    $vars['fieldPropertyAddress'] = $propertyAddressCollection;

    //importing map
    module_load_include('module', 'designssquare_com_widget_map');
    import_map();
    ds_init_map(map_options(
        'ds-map',
        'makapacs.j86ik0o4',
        500,
        $propertyAddressCollection['latitude'],
        $propertyAddressCollection['longitude'],
        '14',
        array(
            1 => array(
            'lat' => $propertyAddressCollection['latitude'],
            'lng' => $propertyAddressCollection['longitude'],
            'minWidth' => '100',
            'content' => '<b>'.$node->title.'</b><br><address>'.$propertyAddressCollection['street'].'<br>'.$propertyAddressCollection['city'].',<br> '.$propertyAddressCollection['state'].' '.$propertyAddressCollection['zip'].'</address>'
            ),
        )
    ));

    $fieldParagraphAboutProperty = field_get_items('node', $node, 'field_paragraph_about_property');
    $sizeOfParagraphs = count($fieldParagraphAboutProperty);
    $propertyParagraphs = array();
    for ($i = 0; $sizeOfParagraphs > $i; $i++)
    {
        $propertyParagraphs[$i] = $fieldParagraphAboutProperty[$i]['value'];
    }
    $vars['propertyParagraphs'] = $propertyParagraphs;

    $fieldFeaturesAndAmenities = field_get_items('node', $node, 'field_features_and_amenities');
    $sizeOfAmenities = count($fieldFeaturesAndAmenities);
    $propertyFeatures = array();
    for ($i = 0; $sizeOfAmenities > $i; $i++)
    {
        $propertyFeatures[$i] = $fieldFeaturesAndAmenities[$i]['value'];
    }
    $vars['propertyFeatures'] = $propertyFeatures;

    $fieldPropertyPhoto = field_get_items('node', $node, 'field_property_photo');
    $propertyPhotos = array();
    for($i = 0; $i < count($fieldPropertyPhoto); $i++){
        $propertyPhotos[$i]['url'] = url('sites/default/files/'.file_uri_target($fieldPropertyPhoto[$i]['uri'], array('absolute'=>true)));
        $propertyPhotos[$i]['alt'] = $fieldPropertyPhoto[$i]['alt'];
    }
    $vars['propertyPhotos'] = $propertyPhotos;

    $priceEntity = node_load($node->field_rental_pricing['und'][0]['target_id']);
    $vars['fieldHighSeasonDates'] = $priceEntity->field_high_season_dates['und'][0]['value'];
    $vars['fieldLowSeasonDates'] = $priceEntity->field_low_season_dates['und'][0]['value'];
    $vars['fieldHighSeasonDailyRate'] = $priceEntity->field_high_season_daily_rate['und'][0]['value'];
    $vars['fieldHighSeasonWeeklyRate'] = $priceEntity->field_high_season_weekly_rate['und'][0]['value'];
    $vars['fieldHighSeasonMonthlyRate'] = $priceEntity->field_high_season_monthly_rate['und'][0]['value'];
    $vars['fieldLowSeasonDailyRate'] = $priceEntity->field_low_season_daily_rate['und'][0]['value'];
    $vars['fieldLowSeasonWeeklyRate'] = $priceEntity->field_low_season_weekly_rate['und'][0]['value'];
    $vars['fieldLowSeasonMonthlyRate'] = $priceEntity->field_low_season_monthly_rate['und'][0]['value'];
    $vars['fieldCleaningFee'] = $priceEntity->field_cleaning_fee['und'][0]['value'];

    $contentPhoto1 = node_load($node->field_property_content_photo['und'][0]['target_id']);
    $vars['contentPhotoTitle1'] = $contentPhoto1->field_photo_title['und'][0]['value'];
    $vars['contentPhotoDescription1'] = $contentPhoto1->field_photo_description['und'][0]['value'];
    $contentPhotoImage1 = $contentPhoto1->field_image_file;
    $vars['contentPhotoImage1'] = $contentPhotoImage1;
    $vars['contentPhotoImageUrl1'] = url('sites/default/files/'.file_uri_target($contentPhotoImage1['und'][0]['uri']), array('absolute'=>true));
    $vars['contentPhotoImageAlt1'] = $contentPhotoImage1['und'][0]['alt'];

    $contentPhoto2 = node_load($node->field_property_content_photo['und'][1]['target_id']);
    $vars['contentPhotoTitle2'] = $contentPhoto2->field_photo_title['und'][0]['value'];
    $vars['contentPhotoDescription2'] = $contentPhoto2->field_photo_description['und'][0]['value'];
    $contentPhotoImage2 = $contentPhoto2->field_image_file;
    $vars['contentPhotoImage2'] = $contentPhotoImage2;
    $vars['contentPhotoImageUrl2'] = url('sites/default/files/'.file_uri_target($contentPhotoImage2['und'][0]['uri']), array('absolute'=>true));
    $vars['contentPhotoImageAlt2'] = $contentPhotoImage2['und'][0]['alt'];

    $otherProperty = array();
    $j=0;
    foreach($propertyMap as $key => $rental_unit){
        if($rental_unit['title'] != $node->title){
            $otherProperty[$j] = $rental_unit;
                $j++;
        }
    }
    $vars['propertyMapWithoutOne'] = $otherProperty;
}

function minnehaha_preprocess_testimonials(&$vars, $hook){
    $node = $vars['node'];

    $fieldTestimonialSlogan = $node->field_page_slogan_testimonial;
    if ($fieldTestimonialSlogan){
        $vars['page_slogan'] = $fieldTestimonialSlogan['und'][0]['value'];
    }
    $fieldTestimonialHeaderBgImg = field_get_items('node', $vars['node'], 'field_header_bg_image_testimonia');
    if ($fieldTestimonialHeaderBgImg){
        $vars['image_url'] = url('sites/default/files/'.file_uri_target($fieldTestimonialHeaderBgImg[0]['uri']), array('absolute'=>true));
    }

}

function minnehaha_preprocess_article(&$vars, $hook){
    $node = $vars['node'];

    $articleHeaderBgImg = field_get_items('node', $vars['node'], 'field_article_header_bg_img');
    if ($articleHeaderBgImg){
        $vars['image_url'] = url('sites/default/files/'.file_uri_target($articleHeaderBgImg[0]['uri']), array('absolute'=>true));
    }

    $fieldParagraphOfContent = field_get_items('node', $node, 'field_paragraph_of_article');
    $sizeOfParagraphs = count($fieldParagraphOfContent);
    $basicParagraphs = array();
    for ($i = 0; $sizeOfParagraphs > $i; $i++)
    {
        $basicParagraphs[$i] = $fieldParagraphOfContent[$i]['value'];
    }
    $vars['basicPagePars'] = $basicParagraphs;

    $fieldContentPhotos = field_get_items('node', $node, 'field_article_content_photo');
    $basicPagePhotos = array();
    for($i = 0; $i < count($fieldContentPhotos); $i++){
        $contentPhoto = node_load($fieldContentPhotos[$i]['target_id']);
        $basicPagePhotos[$i]['contentPhotoTitle'] = $contentPhoto->field_photo_title['und'][0]['value'];
        $basicPagePhotos[$i]['contentPhotoDescription'] = $contentPhoto->field_photo_description['und'][0]['value'];
        $contentPhotoImage = $contentPhoto->field_image_file;
        $basicPagePhotos[$i]['contentPhotoImgUrl'] = url('sites/default/files/'.file_uri_target($contentPhotoImage['und'][0]['uri']), array('absolute'=>true));
        $basicPagePhotos[$i]['contentPhotoImgAlt'] = $contentPhotoImage['und'][0]['alt'];
    }
    if(!empty($basicPagePhotos)){$vars['basicPagePhotos'] = $basicPagePhotos;}else{$vars['basicPagePhotos'] = 'empty';}

}

function minnehaha_preprocess_user(&$vars, $hook){
    $node = $vars['node'];
    $fieldHeaderBkIma = field_get_items('node', $node, 'field_header_background_image');
    if ($fieldHeaderBkIma){
        $vars['image_url'] = url('sites/default/files/'.file_uri_target($fieldHeaderBkIma[0]['uri']), array('absolute'=>true));
    }

}

function minnehaha_preprocess_contactus(&$vars, $hook){
    $node = $vars['node'];
    if (!empty($node)){

        $fieldHeaderBkIma = field_get_items('node', $node, 'field_contact_header_background');
        if ($fieldHeaderBkIma){
            $image_url = url('sites/default/files/'.file_uri_target($fieldHeaderBkIma[0]['uri']), array('absolute'=>true));
            $vars['image_url'] = $image_url;
        }

        $fieldPageSlogan = field_get_items('node', $node, 'field_contuct_us_page_slogan');
        if ($fieldPageSlogan){
            $page_slogan = $fieldPageSlogan[0]['value'];
            $vars['page_slogan'] = $page_slogan;
        }

        $fieldPhoneNumber = field_get_items('node', $node, 'field_phone_number');
        if ($fieldPhoneNumber){
            $phone_number = $fieldPhoneNumber[0]['value'];
            $vars['phone_number'] = $phone_number;
        }

        $fieldStreetAddress = field_get_items('node', $node, 'field_street_address');
        if ($fieldStreetAddress){
            $street_address = $fieldStreetAddress[0]['value'];
            $vars['street_address'] = $street_address;
        }

        $fieldCity = field_get_items('node', $node, 'field_city');
        if ($fieldCity){
            $city = $fieldCity[0]['value'];
            $vars['city'] = $city;
        }

        $fieldState = field_get_items('node', $node, 'field_state');
        if ($fieldState){
            $state = $fieldState[0]['value'];
            $vars['state'] = $state;
        }

        $fieldZipCode = field_get_items('node', $node, 'field_zip_code');
        if ($fieldZipCode){
            $zip_code = $fieldZipCode[0]['value'];
            $vars['zip_code'] = $zip_code;
        }
    }
}

function minnehaha_preprocess_home(&$vars, $hook){
    $node = $vars['node'];
    if (!empty($node)){

        $slideImges = field_get_items('node', $node, 'field_front_slide_img');
        $slidePhotos = array();
        for($i = 0; $i < count($slideImges); $i++){
            $slidePhotos[$i]['url'] = url('sites/default/files/'.file_uri_target($slideImges[$i]['uri'], array('absolute'=>true)));
            $slidePhotos[$i]['alt'] = $slideImges[$i]['alt'];
        }
        $vars['slidePhotos'] = $slidePhotos;

        $welcomeNote = field_get_items('node', $node, 'field_welcome_note');
        if ($welcomeNote){
            $welcome_note = $welcomeNote[0]['value'];
            $vars['welcome_note'] = $welcome_note;
        }

        $welcomeIntro = field_get_items('node', $node, 'field_welcome_intro');
        if ($welcomeIntro){
            $welcome_intro = $welcomeIntro[0]['value'];
            $vars['welcome_intro'] = $welcome_intro;
        }

        $richSnippet = field_get_items('node', $node, 'field_rich_sninppets');
        if ($richSnippet){
            $rich_snippet = $richSnippet[0]['value'];
            $vars['rich_snippet'] = $rich_snippet;
        }
    }
}
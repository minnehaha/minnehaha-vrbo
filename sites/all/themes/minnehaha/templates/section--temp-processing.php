//    @ToDo this need to be moved into cache
var propertyTestimonialPhotoMap = Array();
<?php
foreach($propertyMap as $key=>$property){
    print 'propertyTestimonialPhotoMap.add({"id":"'.$property['universalId'].'","url":"'.$property['featuredTestimonialPhotoUrl'].'", "alt":"'.$property['featuredTestimonialPhotoAlt'].'"});';
}
?>
var finalTestimonialMap = propertyTestimonialPhotoMap.groupBy(function(n) {
return n.id;
});
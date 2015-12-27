
jQuery(document).ready(function($){
var rentalId = $('#rentalUnitId').val();

    var testimonialList = {
        selector: '#testimonial-list',
        element: function (){
            return $(this.selector);
        }
    };

var data = {
    type:'getTestimonial',
    rentalId: $('#rentalUnitId').val()
};

testimonialList.element().append('<div class="progress progress-striped active"><div class="bar" style="width: 60%;"></div></div>').fadeIn(1000);
socket.send(JSON.stringify(data));

socket.on('reviews', function (data) {
    testimonialList.element().find('.progress').fadeOut(1000);
    data.each(function(review){
        //if rental id not provided, default to property with id 2 @ToDo need to make it configurable
        var rentalId = (review.rentalUnitId == 'null')? 2 : review.rentalUnitId;
        $('#testimonial-list').append('<div class="row"><div class="span3"><img alt="' + finalTestimonialMap[rentalId][0].alt
            + '" class="img-circle" src="' + finalTestimonialMap[rentalId][0].url + '"> </div><div class="span6"><blockquote><p>'
            + review.content + '</p><small class="guest">' + review.submittedBy
            + ' ' + Date.create(review.dateReceived).format('{Month} {d}, {yyyy}') + '</small></blockquote></div></div><hr>');
    });
});

    $('a[data-toggle="tab"]').on('shown', function (e) {
        if(e.target.toString().endsWith('#unit-testimonial') && testimonialList.element().find('.progress')){
            testimonialList.element().find('.progress').fadeOut(1000);
        }
    })
});

jQuery(document).ready(function($){
var featuredTestimonialList = {
    selector: '#testimonial-list',
    element: function (){
        return $(this.selector);
    }
};

var data = {
    type:'featuredTestimonials'
};


featuredTestimonialList.element().append('<div class="progress progress-striped active"><div class="bar" style="width: 60%;"></div></div>').fadeIn(1000);
socket.send(JSON.stringify(data));

socket.on('reviews', function (data) {
        featuredTestimonialList.element().find('.progress').fadeOut(1000);
        var rentalId = (data.rentalUnitId == 'null')? 2 : data.rentalUnitId;
        $('#testimonial-list').append('<p><div class="span3"><img alt="' + finalTestimonialMap[rentalId][0].alt
            + '" class="img-circle" src="' + finalTestimonialMap[rentalId][0].url + '"></div><blockquote >'
            + data.content + '</p><small>'  + data.submittedBy + ' '
            + Date.create(data.dateReceived).format('{Month} {d}, {yyyy}') + '</small></blockquote></p>');
});
});
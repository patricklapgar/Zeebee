var timer;

$(document).ready(function() {

	$(".result").on("click", function() {
        var url = $(this).attr("href");
        var id = $(this).attr("data-linkId");
        
        if(!id){
            alert("data-linkId attribute not found");
        }

        increaseLinksClicked(id, url);
        return false;
    });

    var grid = $(".imageResults");
    grid.on("layoutComplete", function() {
        $(".gridItem img").css("visibility", "visible");
    });

    grid.masonry({
        itemSelector: ".gridItem",
        columnWidth: 200,
        gutter: 5,
        isInitLayout: false
    });

    // Fancy box code
    $("[data-fancybox]").fancybox({
        caption: function(instance, item) {
            var caption = $(this).data('caption') || '';
            var siteUrl = $(this).data('siteurl') || '';
            
            // Display link to image and image site
            if(item.type === 'image'){
                caption = (caption.length ? caption + '<br />' : '') + 
                '<a href="' + item.src + '">View Image </a><br>' +
                '<a href="' + siteUrl + '">Visit Page </a>';
            }
            return caption;
        },

        aftershow: function(instance, item) {
            increaseImageClicked(item.src);   
        }
    });

});
// This function loads all the search result images to be displayed
function loadImage(src, className) {
    var image = $("<img>");
    image.on("load", function() {
        $("." + className + " a").append(image);

        clearTimeout(timer);
        
        timer = setTimeout(function() {
            $(".imageResults").masonry();
        }, 200);
    });

    // Flags broken images
    image.on("error", function() {
        $("." + className).remove();
        $.post("ajax/setBroken.php", {src, src});
    });

    image.attr("src", src);
}

// Increase the number of clicks a user makes on a site result
function increaseLinksClicked(linkId, url) {
    // AJAX call to increase the clicks value for a specific link
    $.post("ajax/updateLinkCount.php", {linkId: linkId})
    .done(function(result) {
        if(result != ""){
            alert(result);
            return;
        }

        window.location.href = url;
    });
}

// Increase the number of clicks a user makes on a image result
function increaseImageClicked(imageUrl) {
    // AJAX call to increase the clicks value for a specific link
    $.post("ajax/updateImageCount.php", {imageUrl: imageUrl})
    .done(function(result) {
        if(result != ""){
            alert(result);
            return;
        }

    });
}
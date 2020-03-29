$(document).ready(function() {

	$(".result").on("click", function() {
        var url = $(this).attr("href");
        var id = $(this).attr("data-linkId");
        
        if(!id){
            alert("data-linkId attribute not found");
        }

        increaseLinksClicked(id, url);
        
    });

    var grid = $(".imageResults");
    grid.masonry({
        itemSelector: ".gridItem",
        columnWidth: 200,
        gutter: 5,
        transitionDuration: 0,
        isInitLayout: false
    });

});

function loadImage(src) {
    var image = $("<img>");
    image.on("")
}

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
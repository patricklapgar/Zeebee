$(document).ready(function() {

	$(".result").on("click", function() {
        var url = $(this).attr("href");
        var id = $(this).attr("data-linkId");
        
        if(!id){
            alert("data-linkId attribute not found");
        }

        increaseLinksClicked(id, url);
        
    });

});

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
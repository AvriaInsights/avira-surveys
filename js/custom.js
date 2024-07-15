$(function() {
    $('.search-menu').removeClass('toggled');

    $('.search-icon').click(function(e) {
        e.stopPropagation();
        $('.search-menu').toggleClass('toggled');
        $(".popup-search").focus();
    });

    $('.search-menu input').click(function(e) {
        e.stopPropagation();
    });

   /* $('.search-menu, body').click(function() {
        $('.search-menu').removeClass('toggled');
    });*/
    
    $('.search-bar-close').click(function() {
        $("#popupsearch").val("");
        $("#searchpopup").fadeOut();
        $("#searchpopup").html("");
        $('.search-menu').removeClass('toggled');
    });
});

window.onscroll = function () {
changeHeader();
};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function changeHeader() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}

         $('.js-menu-toggle').click(function(){
            $(".navbar-collapse").hide();
       });
       
       $('.navbar-toggler').click(function(){
          $(".navbar-collapse").show(); 
       });
      






    

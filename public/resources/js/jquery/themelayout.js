$(document).ready(function(){

    $("div#open-nav-login-form").hide();

    // show header login dialog / modal
   $("#nav-login-link").on('click', function(){
     $("#open-nav-login-form").dialog();
     });

});

/* open overlay with nav */
function openNav() {
    document.getElementById("open-overlay").style.height = "100%";
}

/* close overlay with nav */
function closeNav() {
    document.getElementById("open-overlay").style.height = "0%";
    $("div#open-nav-login-form").hide();
}

function changelayoutcolor($newcolor)
{
    var newColor = $(".mast-head").attr("background-color: <?= ?>");
    $(".mast-head").css("background-color", "{{ backgroundcolor }}");
}



// JavaScript Document
// Installed on 3/13/2017


$(document).ready(function(){

    /*var videoVolume = document.getElementById('video_wrapper');
    videoVolume.volume = 0.4;*/
	
  // jQuery Accordion Function
 /* $(function() {
     $(".mast-head-menu-button-wrapper").accordion();
  });*/

    /*var videoVolume = document.getElementById('video_wrapper');
    videoVolume.volume = 0;*/

    // Slide Menu
    $(".cpanel-leftmenu-button").click(function(){
      $("#cpanel-menu").slideToggle("slow", function(){
          $("#cpanel-menu-category1, #cpanel-menu-category2, #cpanel-menu-category3, #cpanel-menu-category4, #cpanel-menu-category5," +
              "#cpanel-menu-category6, #cpanel-menu-category7, #cpanel-menu-category8, #cpanel-menu-category9, #cpanel-menu-category10").show();
      });
    });
	
    $("#cpanel-menu-category1").click(function(){
        $("#admin-menu-category1 ul").slideToggle("slow");
    });

    $("#cpanel-menu-category2").click(function(){
        $("#admin-menu-category2 ul").slideToggle("slow");
    });

    $("#cpanel-menu-category3").click(function(){
        $("#admin-menu-category3 ul").slideToggle("slow");
    });

    $("#cpanel-menu-category4").click(function(){
        $("#admin-menu-category4 ul").slideToggle("slow");
    });

    $("#cpanel-menu-category5").click(function(){
        $("#admin-menu-category5 ul").slideToggle("slow");
    });

    $("#cpanel-menu-category6").click(function(){
        $("#admin-menu-category6 ul").slideToggle("slow");
    });

    $("#cpanel-menu-category7").click(function(){
        $("#admin-menu-category7 ul").slideToggle("slow");
    });

    $("#cpanel-menu-category8").click(function(){
        $("#admin-menu-category8 ul").slideToggle("slow");
    });

    $("#cpanel-menu-category9").click(function(){
        $("#admin-menu-category9 ul").slideToggle("slow");
    });

    $("#cpanel-menu-category10").click(function(){
        $("#admin-menu-category10 ul").slideToggle("slow");
    });


	/*  change function  */
	$('#contact_State').click(function(){
	    var submitBtn = $('#contact_Submit').text();
        if(submitBtn != ''){
            $('#stateChanged').dialog({
				width: 400,
				position: top,
				modal: true,
				title: 'Login Error'
            });
        }
	});

    $(".nav-mobile-button").click(function(){
        $(".nav-link-wrapper").slideToggle("slow");
    });


    //$("#cPanPages").load("appcms/views/"+$(this).attr("article")+".phtml");
    //$("#cPanPages").load("/appcms/cpanel/index");

    // handle left menu clicks
    $(".navItem").click(function (){
        var pageroute = $(this).attr("article"); //("music/index);

        //alert(pageroute);
        //$("#cpanel-menu").hide("slow", 5000);

        $("#cPanPages").load(pageroute);
        return false;

    });


    function swapContent(cv){
        $(".cpan-form").html('<img src="/resources/assets/miniLoader.gif">').show(4000);

        var url_toSwap = "/appcms/views/swapContent.phtml";

        $.post(url_toSwap, {contentVar: cv}, function(data){
            $("#showForms").html(data).show();
        });
    }

    function swapForm(fv){
        $(".form-preview").html('<img src="/resources/assets/images/miniLoader.gif">').show(4000);

        var url_toSwap_Form = "../wl_swap_Form_Content.php";

        $.post(url_toSwap_Form, {contentVar2: fv}, function(data){
            $(".form-preview").html(data).show();
        });
    }


    /* #################### START CMS FORMS VALIDATION ########################## */
   $("#gif-div").hide();
   $('#file-type').hide();
   $("#file-ext").hide();
   $("#file-size").hide();
   //$("#save_SubmitBtn").hide();
   //$('.tinymce-editor-wrapper').hide();

   /* ############### EDIT CORE PAGES #######################  */

   /*$('#core-page').on('change', function (){

       var pageNumber = $(this).val();
       var url = '/appcms/corepages/getSelectedValue?corepagenumber=' + pageNumber;

      var showGif = setInterval(showingTheGifCorePages, 2000);
       $("#gif-div").html('<img src="../../assets/images/miniLoader.gif" class="gif-div-image">').show(showGif);

      function showingTheGifCorePages(){
           $('#gif-div').hide();

          if(pageNumber !== ''){
              $.get(url, function(returnData){
                  if(!returnData){
                      alert('No Page Number To Send');
                  }
                  else{
                      $('.tinymce-editor-wrapper').show();
                      $('#editcorepages').html(returnData).show();
                      stopInterval();
                  }
              });
          }
      }

       function stopInterval(){
           clearInterval(showGif);
           //location.reload('/appcms/corepages/index');
           return false;
       }

   });*/

 /*  $('#corepages_SubmitBtn').on('click', function () {
       $('.tinymce-editor-wrapper').show();
   });*/

   /* ##################  FILE UPLOADS ##################### */

   $('#upload_slide_image').on('change', function (){

       $("#gif-div").html('<img src="../../assets/images/miniLoader.gif" class="gif-div-image">').show(showGif);

       var fileType = $(this).val();

       var showGif = setInterval(showingTheGifSlideUploads, 3000);

       if(fileType !== ''){

           //$("#gif-div").html('<img src="../../assets/images/miniLoader.gif" class="gif-div-image">').show(showGif);
       }

       function showingTheGifSlideUploads(){
           $('#gif-div').hide();

           console.log(fileData);
           $.ajax({
               url: '/slideshow/editpages',
               type: 'POST',
               data: 'corepagesnumber='+pageNumber,
               success: stopInterval()
           });
       }

       function stopInterval(){
           clearInterval(showGif);
           // $(window).load('/corepages/editpages', alert('Refreshing window'));
           return false;
       }

   });

}); // close document.ready
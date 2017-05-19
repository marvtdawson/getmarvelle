

    function validateRegForm(form){
     fail =  checkRegFormMemType(form.regMemberType.value);
     fail += checkRegFormName(form.regName.value);
     fail += checkRegFormAname(form.regAname.value);
     fail += checkRegFormEmail_1(form.regEmail_1.value);
     fail += checkRegFormEmail_2(form.regEmail_2.value);
     fail += checkRegFormPassWord(form.regPw.value);
     fail += checkRegFormTerms(form.regTerms.value);
     if(fail == "") return true
     else{alert(fail); return false}
     }

    function checkRegFormMemType(field){
		 if(field == null || field == ""){
		    	return "Member type must be filled out \n";
		    }
	     else if(field == 'NUL'){
             return "Please Select A Member type \n";
		 }
		 return "";
	
    }
        
    function checkRegFormName(field){
             if(field == null || field == ""){
                    return "Name must be filled out \n";
                }
             else if(field.length < 2){
                 return "Name is too short \n";
             }
             else if(field.length > 25){
                return "First Name is too long \n";
             }
             else if(/[^a-zA-Z0-9 ]/.test(field)){
                 return "Only Alpha Character allowed for First Name \n";
             }
             return "";

    }

    function checkRegFormAname(field){
             if(field == null || field == ""){
                    return "Artist Name must be filled out \n";
                }
             else if(field.length < 2){
                 return "Artist Name is too short \n";
             }
             else if(field.length > 25){
                return "Artist Name is too long \n";
             }
             else if(/[^a-zA-Z0-9 ]/.test(field)){
                 return "Only Alpha Numeric Character allowed for Artist Name \n";
             }
             return "";
    }
	 
    function checkRegFormEmail_1(field){
             if(field == null || field == ""){
                    return "Email must be filled out \n";
                }
             else if(field.length < 2){
                 return "Email is too short \n";
             }
             else if(field.length > 40){
                return "Email is too long \n";
             }
             else if(!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field)){
                 return "Email address is invalid. \n";
             }
             return "";
    }

    function checkRegFormEmail_2(field){
             if(field == null || field == ""){
                    return "Re-Email must be filled out \n";
                }
             else if(field.length < 2){
                 return "Re-Email is too short \n";
             }
             else if(field.length > 40){
                return "Re-Email is too long \n";
             }
             else if(!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field)){
                 return "Re-Email address is invalid. \n";
             }
             return "";
    }

    function checkRegFormPassWord(field){
             if(field == null || field == ""){
                    return "Password must be filled out \n";
                }
             else if(field.length < 6){
                 return "Password must be at least 6 characters\n";
             }
             else if(field.length > 12){
                return "Password is too long \n";
             }
             else if(!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field)){
                 return "Paswword require one each of: \n" +
                        "One capital letter: A-Z \n" +
                        "One number digit: 0-9";
             }
             else if(/[^a-zA-Z0-9]/.test(field)){
                 return "Only Alpha Character allowed for Password \n";
             }
             return "";

    }
    function checkRegFormTerms(field){
        if(field == null || field == ""){
            return "Please Agree To The Terms \n";
        }
        return "";
    }

    /* #################### START CMS FORMS VALIDATION ########################## */
    $("#gif-div").hide();

    /* ############### LOGIN FORM #######################  */

    /*$('#regMem_E1').bind('mouseleave', function (){

        var showGif = setInterval(2000);
        $("#gif-div").html('<img src="../../assets/images/miniLoader.gif" class="gif-div-image">').show(showGif);

         var pageNumber = $(this).val();
         var url = '/appcms/corepages/getSelectedValue?corepagenumber=' + pageNumber;




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

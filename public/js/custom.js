$(function(){
	$('#flexnav').flexNav();
});
$('[data-toggle="tooltip"]').tooltip();

$(document).ready(function()
{
    $('.carousel').carousel({
      interval: 6000
    });
});


$(window).load(function() {
    $('#nivo-slider').nivoSlider({
    	prevText: '',
    	nextText: ''
    });
});
$('.popup-text').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
    callbacks: {
        beforeOpen: function () {
            this.st.mainClass = this.st.el.attr('data-effect');
        }
    },
    midClick: true
});
$(document).ready(function() {
    if($('body').hasClass('sticky-search')) {
      var theLoc = $('.search-area').position().top;
      if($('body').hasClass('sticky-header')) {
        var header_h = $('header.main').outerHeight(); 
      } else {
        header_h = 0;
      }

      $(window).scroll(function() {
          if(theLoc >= $(window).scrollTop()) {
              if($('.search-area').hasClass('fixed')) {
                  $('.search-area').removeClass('fixed').css({top: 0});
              }
          } else { 
              if(!$('.search-area').hasClass('fixed')) {
                  $('.search-area').addClass('fixed').css({top: header_h});
              }
          }
      });
    }
    var object;
    $('.modify_action div').click(function(event){
      if($(this).parent().index()!= object){
        $('.modify_action').removeClass("modify_action_active");
        $('.modify_action ul').slideUp();
        $(this).parent().find('ul').slideToggle();
        $(this).parent().addClass('modify_action_active');
        object=$(this).parent().index();
        var action=$(this).text().toLowerCase();
        if($(this).text()!='Add / Edit' && $(this).text()!='Remove' && $(this).text()!='User')
        {
            $.post('moderator/'+action,function(output){
                $('#modifyContent').html(output);
            });
        }
      }
      else{
        $(this).parent().find('ul').slideUp();
        object=-1;
        $(this).parent().removeClass("modify_action_active");
        $('#modifyContent').html("<h3>Select your action to continue</h3>");
      }
      
    });

    $('.modify_action li').click(function(){
      var a=$(this).text();
      //alert(a);
    });
    $('.new_done_tricks a').click(function(event){
        $(this).hide();
        return false;
    });
    $('.remove_done_tricks .done_tricks a').click(function(){
        $(this).hide();
        var id=$(this).attr('href');
        var table='doneTricks';
        $.post('/ajax/delete',{table:table,id:id},function(){});
        return false;
    });
    $('.selectedTrick').change(function(){
        var trick=$(this).find(':selected').text();;
        if(trick=='Select trick...'){
            return ;
        }
        $(this).find(':selected').remove();
        trick="<div class='box-icon'>"+trick+"</div>";
        $('.new_done_tricks').append(trick);
    });
    $('.delete_comment_icon').click(function(){
        if(confirm("Are you sure?")){
            var $element=$(this).parent().parent();
            $element.animate({'opacity':0},600,function(){$element.hide();});
            var id=$element.find(".comment").val();
            $.post('/ajax/delete',{table:'slacklineComment',id:id},function(){});
        }
      
    });
    $('#submitNewTricks').click(function(){
        var array=$('.new_done_tricks').html();
        var user=$("#formPicture [name='id']").val();
        array=array.split('<div class="box-icon">');
        var done='';
        var count=array.length;
        for(var i=1;i<count;i++){
            done+=array[i].split('</div>');
        }
        $.post('/ajax/save',{table:'doneTricksProfile',id:0,user:user,trick:done},function(){
            var marginTop=($(window).height()-140)/2;
                var marginleft=($(window).width()-340)/2;
                $('#ajaxResponse').html("<div id='ajaxResponseContent'><div id='ajaxResponseContentText'>Please refresh to see result</div></div>");
                $('#ajaxResponse').css({'margin-top':marginTop,'margin-left':marginleft,'display':'block'}).animate({'opacity':1},500).animate({'opacity':1},2000).animate({'opacity':0},800);

        });
    });
    var objectAdmin;
    $('.administrator_modefy_element legend').click(function(){
      if($(this).parent().index()!=objectAdmin){
        $('.administrator_modefy_element form').slideUp();
        $(this).parent().find('form').slideToggle();
        objectAdmin=$(this).parent().index();
      }
      else{
          $(this).parent().find('form').slideUp();
          objectAdmin=-1;
      }
    });
    $('#basicUpdate').click(function(){
        var idUser=$('#idUser').val();
        var fullName=$('#fullName').val();
        var username=$('#username').val();
        var password='none';
        if($('#password').val()!== "")
            password=$('#password').val();
        var email=$('#email').val();
        var privacy=$('#privacyBasic :selected').val();
        var img=$('#profile_picture img').attr('src');
        var data={idUser:idUser,fullName:fullName,username:username,password:password,email:email,privacy:privacy,img:img};
        $.post('/profile/savebasic/',data,function(){
            var marginTop=($(window).height()-140)/2;
            var marginleft=($(window).width()-340)/2;
            $('#ajaxResponse').html("<div id='ajaxResponseContent'><div id='ajaxResponseContentText'>Changes has been saved!!!</div></div>");
            $('#ajaxResponse').css({'margin-top':marginTop,'margin-left':marginleft,'display':'block'}).animate({'opacity':0.95},500).animate({'opacity':0.95},2000).animate({'opacity':0},800);
        });
    });
    $('#aditionalUpdate').click(function(){
        var idUserAdd=$('#idUserAdd').val();
        var idUser=$('#idUser').val();
        var phoneNumber=$('#phoneNumber').val();
        var facebook=$('#facebookLink').val();
        var twitter=$('#twitterLink').val();
        var dateOfBirth=$('#dateOfBirth').val();
        var slackingFrom=$('#slackingFrom').val();
        var privacy=$('#privacyAditional :selected').val();
        var data={idUserAdd:idUserAdd,idUser:idUser,phoneNumber:phoneNumber,facebook:facebook,twitter:twitter,dateOfBirth:dateOfBirth,slackingFrom:slackingFrom,privacy:privacy};
        $.post('/profile/saveaditional/',data,function(){
            var marginTop=($(window).height()-140)/2;
            var marginleft=($(window).width()-340)/2;
            $('#ajaxResponse').html("<div id='ajaxResponseContent'><div id='ajaxResponseContentText'>Changes has been saved!!!</div></div>");
            $('#ajaxResponse').css({'margin-top':marginTop,'margin-left':marginleft,'display':'block'}).animate({'opacity':0.95},500).animate({'opacity':0.95},2000).animate({'opacity':0},800);
        });
    });
    $('#profile_picture').click(function(){
        $('#ProfilePicture').click();
        
    });
    $('#ProfilePicture').change(function(){
        $('#SaveProfilePicture').click();
    });
    $('#administrator_add').click(function(){
        $.post('administration/'+$(this).text().split('/')[0].toLowerCase(),function(output){
            $('#administration_content').html(output);
        });
    });
    $('#administrator_remove').click(function(){
        $.post('administration/'+$(this).text().toLowerCase(),function(output){
            $('#administration_content').html(output);
        });
    });
    $('#administrator_user').click(function(){
        $.post('administration/'+$(this).text().toLowerCase(),function(output){
            $('#administration_content').html(output);
        });
    });
    $('#ajaxResponse').click(function(){
        $(this).hide();
    });
});

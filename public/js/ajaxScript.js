$(document).ready(function(){
    $('.ajaxItemId').change(function(){
        var id=$(this).val();
        var $thisElement=$(this).parents('form');
        var table=$thisElement.find('.ajaxTableName').val();
        var data={id:id,table:table};
        $.post('ajax/index',data,function(output){
            $thisElement.find('.ajaxContent').html(output);
        });
    });
    $('.ajaxDelete').click(function(){
        var $thisElement=$(this).parents('form');
        var index=$thisElement.find('.ajaxItemId').find(':selected').index();
        var $selectedElement=$thisElement.find('.ajaxItemId').children()[index];
        var id=$selectedElement.value;
        var table=$thisElement.find('.ajaxTableName').val();
        if(id>0){
            $thisElement.find('.ajaxItemId').find(':selected').remove();
            var data={id:id,table:table};
            $.post('ajax/delete',data,function(output){
                var marginTop=($(window).height()-140)/2;
                var marginleft=($(window).width()-340)/2;
                $('#ajaxResponse').html("<div id='ajaxResponseContent'><div id='ajaxResponseContentText'>Item delete successfully!!!</div></div>");
                $('#ajaxResponse').css({'margin-top':marginTop,'margin-left':marginleft,'display':'block'}).animate({'opacity':1},500).animate({'opacity':1},2000).animate({'opacity':0},800);
        
            });
        }
    });
    $('.ajaxUserId').change(function(){
        var id=$(this).val();
        var $thisElement=$(this).parents('.container');
        var table='user';
        var data={id:id,table:table};
        $.post('ajax/index',data,function(output){
            $thisElement.find('.ajaxUserContent').html(output);
        });
    });
    $('.ajaxAdminUserId').change(function(){
        var id=$(this).val();
        var $thisElement=$(this).parents('.container');
        var table='userAdmin';
        var data={id:id,table:table};
        $.post('ajax/index',data,function(output){
            $thisElement.find('.ajaxUserContent').html(output);
        });
    });
    $('.ajaxSave').click(function(){
        var $parentElement=$(this).parents('form');
        var id=$parentElement.find('.ajaxItemId').val();
        var table=$parentElement.find('.ajaxTableName').val();
        if(table=='menu'){
            var text=$('#menuText').val();
            var controller=$('#menuController').val();
            var action=$('#menuAction').val();
            var rola=$('#menuRola').find(':selected').val();
            var position=$('#menuPosition').val();
            data={id:id,table:table,text:text,controller:controller,action:action,rola:rola,position:position};
        }
        if(table=='trickWeight'){
            var name=$('#trickWeightName').val();
            data={id:id,table:table,name:name};
        }
        if(table=='trickWeightMark'){
            var name=$('#trickWeightMarkName').val();
            if($('#trickWeightMarkWeight').find(':selected').val()==0){
                alert('Please choose weight');
                return ;
            }
            var weight=$('#trickWeightMarkWeight').find(':selected').val();
            data={id:id,table:table,name:name,weight:weight};
        }
        if(table=='typeSetup'){
            var name=$('#typeSetupName').val();
            data={id:id,table:table,name:name};
        }
        if(table=='doneTricks'){
            if($('#doneTrickUser').find(':selected').val()==0){
                alert('Please choose user');
                return ;
            }
            if($('#doneTrickTrick').find(':selected').val()==0){
                alert('Please choose trick');
                return ;
            }
            var user=$('#doneTrickUser').find(':selected').val();
            var trick=$('#doneTrickTrick').find(':selected').val();
            data={id:id,table:table,user:user,trick:trick};
        }
        if(table=='roles'){
            var name=$('#rolesName').val();
            data={id:id,table:table,name:name};
        }
        if(table=='gearComment'){
            if($('#gearCommentGear').find(':selected').val()==0){
                alert('Please choose gear');
                return ;
            }
            if($('#gearCommentUser').find(':selected').val()==0){
                alert('Please choose user');
                return ;
            }
            var gear=$('#gearCommentGear').find(':selected').val();
            var user=$('#gearCommentUser').find(':selected').val();
            var text=$('#gearCommentText').val();
            var date=$('#gearCommentDate').val();
            data={id:id,table:table,gear:gear,user:user,text:text,date:date};
        }
        if(table=='commentSlackline'){
            if($('#slacklineCommentSlackline').find(':selected').val()==0){
                alert('Please choose slackline');
                return ;
            }
            if($('#slacklineCommentUser').find(':selected').val()==0){
                alert('Please choose user');
                return ;
            }
            var slackline=$('#slacklineCommentSlackline').find(':selected').val();
            var user=$('#slacklineCommentUser').find(':selected').val();
            var text=$('#slacklineCommentText').val();
            var date=$('#slacklineCommentDate').val();
            data={id:id,table:table,slackline:slackline,user:user,text:text,date:date};
        }
        if(table=='user'){
            if($('#userRola').find(':selected').val()==0){
                alert('Please choose rola');
                return ;
            }
            var rola=$('#userRola').find(':selected').val();
            var name=$('#userFullName').val();
            var username=$('#userUsername').val();
            var password=$('#userPassword').val();
            var email=$('#userEmail').val();
            var active=0;
            if($('#userActive').is(':checked')){
                active=1;
            }
            data={id:id,table:table,rola:rola,name:name,username:username,password:password,email:email,active:active};
        }
        if(table=='userAdd'){
            var phone=$('#userAddPhone').val();
            var facebook=$('#userAddFacebook').val();
            var twitter=$('#userAddTwitter').val();
            var birth=$('#userAddBirth').val();
            var slackingFrom=$('#userAddSlackingFrom').val();
            var idUser=$('.ajaxItemIdUser').val();
            if($('#userAddPrivacy').length>0){
                var privacy=$('#userAddPrivacy').val();
                if(privacy==0){
                    alert('Forget to choose privacy!');
                    return ;
                }
                data={id:id,idUser:idUser,table:table,phone:phone,facebook:facebook,twitter:twitter,birth:birth,slackingFrom:slackingFrom,privacy:privacy};
            }
            else{
                data={id:id,idUser:idUser,table:table,phone:phone,facebook:facebook,twitter:twitter,birth:birth,slackingFrom:slackingFrom};
            }
        }
        $.post('ajax/save',data,function(){
            var marginTop=($(window).height()-140)/2;
            var marginleft=($(window).width()-340)/2;
            $('#ajaxResponse').html("<div id='ajaxResponseContent'><div id='ajaxResponseContentText'>Item saved successfully!!!</div></div>");
            $('#ajaxResponse').css({'margin-top':marginTop,'margin-left':marginleft,'display':'block'}).animate({'opacity':1},500).animate({'opacity':1},2000).animate({'opacity':0},800);

        });
        
    });
    $('#ajaxResponse').click(function(){
        $('#ajaxResponseContent').hide();
    });
    
});

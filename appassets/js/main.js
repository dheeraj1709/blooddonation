$(document).ready(function(){
    $(document).on('click','.submit_receiver, .submit_hospital',function(){

    })

    $(document).on('keyup','.userName',function(){
        var submitType = $(this).attr('usertype');
        var text = $(this).val();
        if(submitType == 'hospital'){
            var url = 'auth/check';
        }
        if(submitType == 'receiver'){
            var url = 'auth/check';
        }
        $.ajax({
            url : url,
            type : 'POST',
            data : {
                usertype : submitType,
                text : text
            },
            success : function(response){
                console.log(response)
            }
        })
    })

    $(document).on('click','.plus_icon',function(){
        var url = window.location.origin+'/blooddonation/dashboard/GetAvailabilityByHospitalECHO';
        $.ajax({
            url : url,
            type : 'GET',
            success : function(response){
                response = JSON.parse(response)
                response.bloodGroupsByHospital.forEach(function(res){
                    var code = `<div class="availabilityDiv"><span><input type="checkbox" name="${res.bloodgroup}" elId="${res.id}"></span><span>${res.bloodgroup}</span></div>`
                    $('.modal_body').append(code)
                })
                var buttonCode = `<span><button class="availabilityclose">Close</button></span><span><button class="availabilitysubmit">Submit</button></span>`
                populateModal(`Heading`,`${buttonCode}`)
            }
        })
    })

    $(document).on('click','.availabilityclose',clearModal);

    $(document).on('click','.viewRequests',function(){
        var url = window.location.origin+'/blooddonation/dashboard/GetRequirementECHO';
        $.ajax({
            url : url,
            type : 'GET',
            success : function(response){
                console.log(response)
            }
        })
    })
 })

function slideSignup(){
    if($('.signup_slider').hasClass('slide')){
        $('.signup_slider').removeClass('slide');
    }
    else{
        $('.signup_slider').addClass('slide')
    }
}

function logout(){
    var url = window.location.origin+'/blooddonation/auth/logout';
    $.ajax({
        url : url,
        type : 'GET',
        success:function(response){
            var json = JSON.parse(response)
            console.log(json)
                if(json.Status == 'SUCCESS'){
                    window.location.href = window.location.origin+'/blooddonation/auth'
                } 
        }
    })
}
function populateModal(heading,footer){
    $('.modal_header').html(heading);
    // $('.modal_body').html(body)
    $('.modal_footer').html(footer);
    $('.modal').css('display','block')
}
function clearModal(){
    $('.modal_header').empty();
    $('.modal_body').empty();
    $('.modal_footer').empty();
    $('.modal').css('display','none')
}

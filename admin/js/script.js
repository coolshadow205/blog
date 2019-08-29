$('#selectAllBoxes').click(function(event){
    if(this.checked){
        $('.checkBoxes').each(function(){
            this.checked = true;
        });
    }
    else{
        $('.checkBoxes').each(function(){
            this.checked = false;
        });
    }
        
});


//

$(document).ready(function() {
    $('#addPost').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            title: {
                validators: {
                    notEmpty: {
                        message: 'The title is required and cannot be empty'
                    },
                    stringLength: {
                        max: 100,
                        message: 'The title must be and less than 100 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'The username can only consist of alphabetical, number and underscore'
                    }
                }
            },
            post_tags: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    }
                }
            },
            post_content: {
                validators: {
                    notEmpty: {
                        message: 'The post content is required and cannot be empty'
                    }
                }
            }
        }
    });
});

function loadUsersOnline(){
    $.get("functions.php?onlineusers=result" , function(data){
        $('.usersonline').text(data);  
    });
}

setInterval(function(){
    //This function will be called after ever 2000 milliseconds.
    loadUsersOnline();
},2000);
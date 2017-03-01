$(document).ready(function(){
    var doc_height=$(document).height();
    var doc_width=$(document).width();
    $('.deleteNote').click(function(){
        window.Id=$(this).attr('id');
        window.delButton = $(this);
        $('#deleteNote').css({height:doc_height,width:doc_width})
        $('#deleteNote').show();
    })
    $('#no').click(function(){
       $('#deleteNote').hide(); 
      
      
    })
    $('#yes').click(function(){
        $.ajax({
            type:'POST',
            url:'/postNoteDelete',
            data:{id:Id,_token:Laravel.csrfToken},
            success:function(data){
                if(data == "success"){
                    delButton.parent().parent().fadeOut(500);
                    $('#deleteNote').hide();
                }else{
                    alert('An Error Occurred , Please Try Again')
                }    
                   
            } 
        })
    })
    $('.preview').click(function(e){
        $('.preview').prop("disabled",true);
         $('#preview').fadeOut(500);
        $('#preview').empty();
        var id=$(this).attr('id');
        var url = "/postNote/"+id;
        $.ajax({
            type:'POST',
            url:url,
            dataType: "JSON",
            data:{id:id,_token:Laravel.csrfToken},
            success:function(data){
                
                if(data.status == 'succsess'){
                    $("body").animate({ scrollTop: 0 }, 1000);
                    $('#preview').fadeIn(500,function(){
                        $('.preview').prop("disabled",false);
                    });
                    $('#preview').append('<div class="col-md-12">\n\
                                                <h1 class="text-center">'+data.note.category.name+'</h1>\n\
                                                <h3 class="text-center note-title">'+data.note.title+'</h3>\n\
                                                <div class="center">    \n\
                                                    <div class="col-md-6 center">\n\
                                                        <img src="/img/'+data.note.image_name+'" width="200" height="200" class="img-responsive">                             \n\
                                                    </div>\n\
                                                    <div class="col-md-6 note-text center">\n\
                                                        <p>'+data.note.text+'</p>                                \n\
                                                        <p>'+data.note.created_date+'</p>\n\
                                                    </div> \n\
                                                </div>\n\
                                            </div>')
                    
                }
                
                   
            } 
        })
        
    })
})
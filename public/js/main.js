var url = 'http://127.0.0.1:8000';

window.addEventListener('load', ()=>{

function dislike(){
    $('.btn-like').unbind('click').click(function(){
        $.ajax({
            url: url+'/dislike/' + $(this).data('id'),
            type: 'GET',
            success: (response)=>{
                console.log(response)
            }
        });
        $(this).text('🖤');
        $(this).addClass('btn-dislike').removeClass('btn-like');
        like();
    });
}dislike();

function like(){
    $('.btn-dislike').unbind('click').click(function(){
        $.ajax({
            url: url+'/like/' + $(this).data('id'),
            type: 'GET',
            success: (response)=>{
                console.log(response)
            }
        });
        $(this).text('❤️');
        $(this).addClass('btn-like').removeClass('btn-dislike');
        dislike();
    });

}like();

$('#buscador').submit(function(){
    $(this).attr('action', url+ '/users/'+$('#buscador #search').val())
});


});


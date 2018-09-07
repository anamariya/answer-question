function show_create_question_block(){
    $('#create_question_block').show();
}

$(function (){
    $('#create_question_form').submit(create_question);
});

function create_question(e){
    e.preventDefault();
    var form  = $('#create_question_form').serializeArray();
    $.ajax({
        type:'POST',
        url:'/question/create',
        data: {
            form: form,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success:function(data){
            window.location.reload();
        }
    });
}

function likeQuestion(id){
    $.ajax({
        type:'GET',
        url:'/question/like',
        data: {
            question_id: id
        },
        success:function(data){
            if(data === "ok"){
                window.location.reload();
            }
        }
    });
}

function show_answer_form(id){
    $('#add_answer'+id).show();
}

function add_answer(id, e){
    e.preventDefault();
    var text = $('#add_answer_text'+id).html();
    $.ajax({
        type:'POST',
        url:'/question/answer',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            question_id: id,
            answer_text: text
        },
        success:function(data){
            // window.location.reload();
        }
    });
}

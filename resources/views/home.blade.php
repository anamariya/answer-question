@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="nav flex-column nav-pills col-xs-12 col-md-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-my-questions-tab" data-toggle="pill" href="#v-pills-my-questions" role="tab" aria-controls="v-pills-my-questions" aria-selected="true">Мои вопросы</a>
            <a class="nav-link" id="v-pills-all-questions-tab" data-toggle="pill" href="#v-pills-all-questions" role="tab" aria-controls="v-pills-all-questions" aria-selected="false">Все вопросы</a>
        </div>
        <div class="tab-content col-xs-12 col-md-8" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-my-questions" role="tabpanel" aria-labelledby="v-pills-my-questions-tab">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-primary" type="button" onclick="show_create_question_block()">+ Задать вопрос</button>
                </div>
                <div id="create_question_block" class="mt-2">
                    <form id="create_question_form">
                        <div class="form-group">
                            <label for="create_question_category" class="control-label h6">Категория</label>
                            <select id="create_question_category" class="form-control" name="create_question_category" required>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="create_question_text" class="control-label h6">Вопрос</label>
                            <input type="text" class="form-control" id="create_question_text" name="create_question_text" required>
                        </div>
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                    </form>
                </div>
                <div class="d-flex flex-column">
                    @foreach($myQuestions as $myQuestion)
                    <div class="card m-2">
                        <div class="card-header">
                            <h4>{{$myQuestion->text}}</h4>
                            <p>Категория: {{$myQuestion->category->name}}</p>
                            @if(isset($questions_liked_by_me[$myQuestion->id]))
                                <i class="fas fa-thumbs-up m-1 liked"></i>{{$myQuestion->likes_amount}}
                            @else
                                <a onclick="likeQuestion({{$myQuestion->id}});return false;"><i class="fas fa-thumbs-up m-1"></i>{{$myQuestion->likes_amount}}</a>

                            @endif
                            <a onclick="show_answer_form({{$myQuestion->id}});return false;"><i class="fas fa-comment m-1 ml-2"></i></a>
                        </div>
                        <ul class="list-group list-group-flush">
                            @if($myQuestion->answers)
                                @foreach($myQuestion->answers as $comment)
                                    <li class="list-group-item">{{$comment->text}}</li>
                                @endforeach
                            @endif
                            <li class="list-group-item add_answer" id="add_answer{{$myQuestion->id}}">
                                <form id="add_answer_form">
                                    <div class="form-group">
                                        <textarea class="form-control" id="add_answer_text{{$myQuestion->id}}" name="add_answer_text{{$myQuestion->id}}" placeholder="Оставить комментарий" required>
                                        </textarea>
                                    </div>
                                    <button class="btn btn-primary" onclick="add_answer({{$myQuestion->id}})">Отправить</button>
                                </form>
                            </li>

                        </ul>

                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-all-questions" role="tabpanel" aria-labelledby="v-pills-all-questions-tab">
                <div class="d-flex flex-column">
                    @foreach($allQuestions as $question)
                    <div class="card m-2">
                        <div class="card-header">
                            <h4>{{$question->text}}</h4>
                            <p>Категория: {{$question->category->name}}</p>
                            <p>Автор: {{$question->user->name}}</p>
                            @if(isset($questions_liked_by_me[$question->id]))
                                <i class="fas fa-thumbs-up m-1 liked"></i>{{$question->likes_amount}}
                            @else
                                <a onclick="likeQuestion({{$question->id}});return false;"><i class="fas fa-thumbs-up m-1"></i>{{$question->likes_amount}}</a>

                            @endif
                            <a onclick="commentQuestion({{$question->id}});return false;"><i class="fas fa-comment m-1 ml-2"></i></a>
                            <div id="comment_on_question{{$question->id}}"></div>
                        </div>
                        {{--<ul class="list-group list-group-flush">--}}
                            {{--<li class="list-group-item">Cras justo odio</li>--}}
                            {{--<li class="list-group-item">Dapibus ac facilisis in</li>--}}
                            {{--<li class="list-group-item">Vestibulum at eros</li>--}}
                        {{--</ul>--}}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

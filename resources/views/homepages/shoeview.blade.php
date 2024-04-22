

<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="text-center">
            <h2>{{$shoe->title}}</h2>
            <h6>By {{$shoe->author->name}}</h6>
        </div>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <img src="{{ asset('images/' . $shoe->image_path) }}" class="card-img-top" style="height: 500px">

        <div class="mt-3">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Specification</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">Review</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="simple-tab-2" data-bs-toggle="tab" href="#simple-tabpanel-2" role="tab" aria-controls="simple-tabpanel-2" aria-selected="false">Pros</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="simple-tab-3" data-bs-toggle="tab" href="#simple-tabpanel-3" role="tab" aria-controls="simple-tabpanel-3" aria-selected="false">Cons</a>
                </li>
            </ul>
            <div class="tab-content pt-5" id="tab-content">
                <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">{{$shoe->specs}}</div>
                <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">{{$shoe->body}}</div>
                <div class="tab-pane" id="simple-tabpanel-2" role="tabpanel" aria-labelledby="simple-tab-2">{{$shoe->pros}}</div>
                <div class="tab-pane" id="simple-tabpanel-3" role="tabpanel" aria-labelledby="simple-tab-3">{{$shoe->cons}}</div>
            </div>
        </div>
    </div>
</div>


@if(Auth::check())
    <hr>
    @if($isRated)
        <div class="row mb-3" id="rated">
            <div class="col-3"></div>
            <div class="col-6 text-center" style="background-color: #d4dae5; padding: 10px">
                <p><b>Thank you for your Feedback!</b></p>
                <p style="margin: 0;">Your Rating: {{$rating}}</p>
                <p style="margin: 0;">Overall Rating: {{$overall_rating}}</p>
            </div>
        </div>
    @else
        <div class="row mb-3" id="rateme">
            <div class="col-3"></div>
            <div class="col-6 text-center" style="background-color: #d4dae5; padding: 10px">
                <p><b>Please Share Your Feedback:</b></p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating" value="1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating" value="2">
                    <label class="form-check-label" for="inlineRadio1">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating" value="3">
                    <label class="form-check-label" for="inlineRadio1">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating" value="4">
                    <label class="form-check-label" for="inlineRadio1">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating" value="5">
                    <label class="form-check-label" for="inlineRadio1">5</label>
                </div>
                <br>
                <button onclick="submitThisRating({{$shoe->id}}, {{Auth::id()}})" class="btn btn-secondary btn-sm mt-3">Rate</button>
            </div>
        </div>
    @endif
@endif
<hr>

    <div class="row mb-3">
        <div class="col-3"></div>
        <div class="col-6" style="background-color: #d4dae5; padding: 10px">
            <p><b>Comments:</b></p>
            @if(Auth::check())
            <div class="form-floating">
                <textarea id="commentss" class="form-control" name="body" style="height: 60px"></textarea>
                <label for="floatingTextarea2">Your Comment</label>
            </div>
            <button onclick="submitThisComment({{$shoe->id}}, {{Auth::id()}})" class="btn btn-success btn-sm mt-3">Submit</button>
            @endif
            <div id="commentsection" style="margin-top: 10px">
                @if(count($comments))
                    @foreach($comments as $comment)
                        <div class="d-flex" id="{{"comment".$comment->id}}" style="border: 1px solid; padding: 7px; margin: 5px;background-color: white">
                            <div class="flex-shrink-0">
                                <img src="{{asset('images/profile-logo.png')}}" width="60px">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 style="margin: 0px">{{$comment->author->name}}</h5>
                                <p style="margin: 0px">{{$comment->comment}}</p>
                            </div>

                            @if(Auth::id() == $shoe->user_id)
                                <button onclick="hideThisComment({{$comment->id}})" class="btn btn-danger btn-sm" id="viewbutton">Hide</button>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

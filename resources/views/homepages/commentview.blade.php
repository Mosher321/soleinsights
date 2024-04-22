@foreach($comments as $comment)
    <div class="d-flex" style="border: 1px solid; padding: 7px; margin: 5px;background-color: white">
        <div class="flex-shrink-0">
            <img src="{{asset('images/profile-logo.png')}}" width="60px">
        </div>
        <div class="flex-grow-1 ms-3">
            <h5 style="margin: 0px">{{$comment->author->name}}</h5>
            <p style="margin: 0px">{{$comment->comment}}</p>
        </div>
    </div>
@endforeach

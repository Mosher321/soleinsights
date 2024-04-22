@extends('layouts.welcome')

@push('styles')
    <style>
        .carousel-item img {
            width: 100%; /* or any custom width */
            height: 300px; /* or any custom height */
            object-fit: contain; /* this will prevent distortion of images */
        }
        .card-body {
            height: 170px; /* or any custom height */
            overflow: auto; /* add a scrollbar if the content is too long */
        }
    </style>
@endpush


@section('main-section')
    <div class="p-5 text-white text-center rounded" style="background-color: white;">
        <h1 class="m-4" style="color: black;font-family:Courier New;">Welcome to <span style="font-weight: bold">Sole Insights</span>!</h1>
{{--        <a id="backbutton" class="btn btn-warning m-3" style="display: none" href="{{route('welcome')}}">Go Back to List</a>--}}

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('images/wp9637119-shoes-pc-wallpapers.jpg')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/wp9637090-shoes-pc-wallpapers.jpg')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/wp2595321-shoes-wallpaper.jpg')}}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <hr>
    <div class="container" id="main">
        <h4 align="center" class="mb-4" style="color: black;font-family:Courier New;">Find the best shoe reviews!</h4>
        <div class="row">
                @if(count($shoes))
                    @foreach($shoes as $shoe)
                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/' . $shoe->image_path) }}" class="card-img-top" style="height: 200px">
                                <div class="card-body">
                                    <h5 class="card-title">{{$shoe->title}}</h5>
                                    <p style="margin: 0px">by {{$shoe->author->name}}</p>
                                    @if($overall_ratings[$loop->iteration-1] == 0)
                                        <span class="rating" data-default-rating="{{$overall_ratings[$loop->iteration-1]}}" disabled></span> (Not Rated Yet)<br><br>
                                    @else
                                        <span class="rating" data-default-rating="{{$overall_ratings[$loop->iteration-1]}}" disabled></span><br>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2"><button onclick="getShoe({{$shoe->id}}, {{Auth::id()}})" class="btn btn-outline-dark" id="viewbutton">View Details</button></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function getShoe(id, userid){
            $.ajax({
                url: "get-shoe",
                data: {'shoe_id': id, 'user_id': userid},
                success: function(result){
                    $('#backbutton').css("display", "inline");
                    $('#main').empty();
                    $('#main').append(result);
                }
            });
        }

        function submitThisRating(shoe_id, auth_id){
            var rating = parseInt($(".form-check-input:checked").val());
            $.ajax({
                url: "submit-rating",
                data: {'shoe_id': shoe_id, 'user_id': auth_id, 'rating': rating},
                success: function(result){
                    $('#rateme').fadeOut();
                    $('#main').prepend(result);
                }
            });
        }

        function submitThisComment(shoe_id, auth_id){
            var comment = $("#commentss").val();
            $.ajax({
                url: "submit-comment",
                data: {'shoe_id': shoe_id, 'user_id': auth_id, 'comment': comment},
                success: function(result){
                    $("#commentss").val('');
                    $('#commentsection').empty();
                    $('#commentsection').prepend(result);
                }
            });
        }

        function hideThisComment(comment_id){
            var theid = "#comment".concat(comment_id);
            $.ajax({
                url: "hide-comment",
                data: {'comment_id': comment_id},
                success: function(result){
                    $(theid).remove();
                }
            });
        }
    </script>
@endpush

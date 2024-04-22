@extends('layouts.welcome')

@section('main-section')
    <div class="p-5 text-white text-center rounded" style="background-color: white">
        <h1 style="color: black">User Dashboard</h1>
    </div>
    <hr>
    <div class="mt-5 mb-4">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h3 class="text-center">Write A Shoe Review</h3>
                <form class="mt-2" action="{{route('shoe.add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Shoe Name</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Shoe Category</label>
                        <select class="form-select">
                            <option value="Sneakers">Sneakers</option>
                            <option value="Boots">Boots</option>
                            <option value="Dress shoes">Dress shoes</option>
                            <option value="Sandals">Sandals</option>
                            <option value="Athletic shoes">Athletic shoes</option>
                            <option value="High heels">High heels</option>
                            <option value="Flats">Flats</option>
                            <option value="Loafers">Loafers</option>
                            <option value="Espadrilles">Espadrilles</option>
                            <option value="Oxfords">Oxfords</option>
                        </select>
                    </div>
                    <div class="form-floating mt-3">
                        <textarea class="form-control" id="comment" name="specs" placeholder="Comment goes here"></textarea>
                        <label for="comment">Write Shoe Specification</label>
                    </div>
                    <div class="form-floating mt-3">
                        <textarea class="form-control" id="comment" name="body" placeholder="Comment goes here"></textarea>
                        <label for="comment">Write your review</label>
                    </div>
                    <div class="form-floating mt-3">
                        <textarea class="form-control" id="comment" name="pros" placeholder="Comment goes here"></textarea>
                        <label for="comment">Write Pros About This Shoe</label>
                    </div>
                    <div class="form-floating mt-3">
                        <textarea class="form-control" id="comment" name="cons" placeholder="Comment goes here"></textarea>
                        <label for="comment">Write Cons About This Shoe</label>
                    </div>
                    <div class="mt-3">
                        <label for="formFile" class="form-label">Upload Shoe image</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

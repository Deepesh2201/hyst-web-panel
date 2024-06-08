@extends('admin-views.custom-layouts.main')
@section('main-section')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<section class="">
    <div class="back">
        <a href="list"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
    <div class="container">
        <form class="postsForm" action="{{url('api/v1/posts/save')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(session('errors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('errors') as $error)
                            <li>{{ ($error[0] ) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-row">
                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Header<span style="color: red">*</span></label>
                        <input class="effect form-control" type="text" name="title" placeholder="">
                        
                    </div>
                </div>
               
                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Full Address<span style="color: red">*</span></label>
                        <input class="effect form-control" type="text" name="address" placeholder="">
                    </div>
                </div>
                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Rent/Month<span style="color: red">*</span></label>
                        <input class="effect form-control" type="text" name="rent_per_month" placeholder="">
                    </div>
                </div>
                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Deposit<span style="color: red">*</span></label>
                        <input class="effect form-control" type="text"  name="deposit" placeholder="">
                    </div>
                </div>
                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>No. Of Bedrooms<span style="color: red">*</span></label>
                        <select class="effect form-control" name="bedrooms" placeholder="">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        
                    </div>
                </div>
                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>No. Of Bathroom<span style="color: red">*</span></label>
                        <select class="effect form-control" name="bathrooms" placeholder="">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        </select>
                </div>

                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Floor<span style="color: red">*</span></label>
                        <input class="effect form-control" type="text" name="floors" placeholder="">
                    </div>
                </div>
                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Description<span style="color: red">*</span></label>
                        <input class="effect form-control" type="text" name="description" placeholder="" style="height: 60px;">
                    </div>
                </div>

                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label class="typeDate">Possession<span style="color: red">*</span></label>
                        <input type="date" id="date" class="effect form-control" name="possession_date" type="text" placeholder="">
                        <!-- <label class="typeDate" >Possession</label> -->
                    </div>
                </div>


                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Image 1<span style="color: red">*</span></label>
                        <input class="effect form-control" type="file"  name="image1" placeholder="">
                    </div>
                </div>

                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Image 2</label>
                        <input class="effect form-control" type="file" name="image2" placeholder="">
                    </div>
                </div>

                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Image 3</label>
                        <input class="effect form-control" type="file" name="image3" placeholder="">
                    </div>
                </div>
                <div class="col-auto input-effect ">
                    <div class="form-group">
                        <label>Image 4</label>
                        <input class="effect form-control" type="file" name="image4" placeholder="">
                    </div>
                </div>

            </div>

            <div>
                <h4>Select Aminities</h4>
                <div class="row aminity">
                    @foreach ($amenities as $amenity)
                        <div class="col-sm-4 col-xs-4">
                            <div class="aminiBox">
                                <input type="checkbox" id="myCheckbox{{$amenity->id}}"  name="amenities[]" value="{{$amenity->id}}"/>
                                <label for="myCheckbox{{$amenity->id}}" class="lab">
                                    <img src="{{url('public/')}}/{{$amenity->icon}}">
                                </label>
                            </div>
                            <span>{{$amenity->name}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-12 col-sm-12">
                    <button type="submit" class="btn  subBtn"> Submit</button>
                </div>
            </div>
        </form>
        <br>
    </div>
    </div>
</section>
<script>
    // JavaScript for label effects only
    window.addEventListener("load", function() {
        $(".col-3 input").val("");

        $(".input-effect input").focusout(function() {
            if ($(this).val() != "") {
                $(this).addClass("has-content");
            } else {
                $(this).removeClass("has-content");
            }
        })
    });

    function showdate() {

        document.getElementsByClassName("typeDate").hidden = false;
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif
</script>
@endsection
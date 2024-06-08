
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h3>Store Details</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('save-store-registration') }}" method="POST" enctype="multipart/form-data" class="mt-5" style="border: 1px solid lightgray; padding: 20px;">
            @csrf <!-- Add CSRF token for security -->
    
            <div class="row">
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="storeName">Store Name</label>
                        <input type="text" class="form-control @error('storeName') is-invalid @enderror" name="storeName" id="storeName" placeholder="Store Name" value="{{ old('storeName') }}">

                    </div>
                </div>
    
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="storeDescription">Store Description</label>
                        <textarea class="form-control @error('storeDescription') is-invalid @enderror" name="storeDescription" id="storeDescription" placeholder="Description">{{ old('storeDescription') }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="storeAddress">Store Address</label>
                        <input type="text" class="form-control @error('storeAddress') is-invalid @enderror" name="storeAddress" id="storeAddress" placeholder="Store Address" value="{{ old('storeAddress') }}">

                    </div>
                </div>
{{--     
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="form-control @error('city') is-invalid @enderror" name="city" id="city">
                            <option>--Select--</option>
                            <!-- Add your options here -->
                        </select>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                 --}}
{{--     
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="area">Area</label>
                        <select class="form-control @error('area') is-invalid @enderror" name="area" id="area">
                            <option>--Select--</option>
                            <!-- Add your options here -->
                        </select>
                        @error('area')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}
                
            </div>
    
            <div class="row">
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="cat">Category</label>
                        <select class="form-control @error('cat') is-invalid @enderror" name="cat" id="cat">
                            <option value="">--Select Category--</option>
                            @foreach ($category as $catg)
                                <option value="{{$catg->id}}">{{$catg->name}}</option>
                            @endforeach

                            <!-- Add your options here -->
                        </select>
                        @error('cat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
{{--             
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="subcat">Subcategory</label>
                        <select class="form-control @error('subcat') is-invalid @enderror" name="subcat" id="subcat">
                            <option>--Select--</option>
                            <!-- Add your options here -->
                        </select>
                        @error('subcat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}
            
                <div class="col-12 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="glink">Google Link</label>
                        <input type="text" class="form-control @error('glink') is-invalid @enderror" name="glink" id="glink" value="{{ old('glink') }}">
                        @error('glink')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
    
            <div class="row">
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="ownername">Owner Name</label>
                        <input type="text" class="form-control @error('ownername') is-invalid @enderror" name="ownername" id="ownername" value="{{ old('ownername') }}">
                        @error('ownername')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="mob">Mobile</label>
                        <input type="text" class="form-control @error('mob') is-invalid @enderror" name="mob" id="mob" value="{{ old('mob') }}">
                        @error('mob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control @error('pwd') is-invalid @enderror" name="pwd" id="pwd">
                        @error('pwd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
    
            <div class="row">
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="storeLogo">Store Logo</label>
                        <input type="file" class="form-control @error('storeLogo') is-invalid @enderror" name="storeLogo" id="storeLogo">
                        @error('storeLogo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="col-12 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="storeBanner">Store Banner</label>
                        <input type="file" class="form-control @error('storeBanner') is-invalid @enderror" name="storeBanner" id="storeBanner">
                        @error('storeBanner')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="col-12 col-md-6 col-sm-6">
                    <div style="float: right; margin-top: 24px;">
                        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
    

  
    
</body>
</html>
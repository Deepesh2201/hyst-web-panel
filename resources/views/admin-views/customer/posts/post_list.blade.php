
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Post</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{url('public/custom-assets/css/post.css')}}">
    </head>
    <body>
        <section class="">
            <div class="back">
                <a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            </div>
            <div class="container">
                <div class="businessListPage">
                    
                    @foreach ($posts as $post)
                    <div class="outerListBox">
                    <div class="listBox">
                            <img src="{{url('public/images/post-images')}}/{{$post->image1}}">
                            <div class="listDesc">
                                <h4><a href="edit/{{$post->id}}" >{{$post->title}}</a></h4>
                                <p class="date">{{\Carbon\Carbon::parse($post->possession_date)->format('d M Y') }}</p>
                                <p class="desc"> {{$post->description}}</p>
                                @if($post->status == 1)
                                    <p class="text-success status"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;Active</p>
                                    @elseif($post->status == 0)
                                    <p class="text-danger status"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;Inactive</p>
                                @endif
                            </div>
                        </div>
                        <label class="toggle">
                            <input class="toggle-checkbox" type="checkbox" checked>
                            <div class="toggle-switch"></div>
                        </label>
                    @endforeach
                    </div>
                    
                    
                    
                    <div class="outerListBox">
                        <div  class="listBox">
                            <img src="images/house1.jpg">
                            
                            <div class="listDesc">
                                <h4><a href="createpost.html">Tilte</a></h4>
                                <p class="date">25 Sep 2023</p>
                                <p class="desc"> This is Description</p>
                                <p class="text-success status"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;Active</p>
                            </div>

                        
                        </div>

                        <label class="toggle">
                            <input class="toggle-checkbox" type="checkbox" checked>
                            <div class="toggle-switch"></div>
                        </label>

                   </div>

                    
                  <input type="file" id="fileInput" onchange="handleFileSelection()" />


                    
              
                </div>
                <div class="nodatafound">
                            <img src="{{url('public/custom-assets/images/no_data_found.png')}}" class="img-fluid" width="100%" height="100%">
                        </div>
                
                <div class="create">
                    <span href="" class="fa-pluss" onclick="showOptions();" >+</span>
                </div>

                <div class="btnsCreatePost"  id="btnsCreatePost" hidden>
                    <div class="btn1">
                        <a href="{{url('/api/v1/posts/create')}}" class="btn btn-sm btn-info">Jobs / Vacancies</a>
                    </div>
                    
                    <div class="btn2">
                        <a href="{{url('/api/v1/posts/create')}}" class="btn btn-sm btn-primary">Rent / Sells</a>
                    </div>
                </div>


                

                
            </div>
            </div>
        </div>
    </section>
   
    <script>
        function showOptions(){
            // document.getElementById("btnsCreatePost").hidden=false;

            var x = document.getElementById("btnsCreatePost");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
  
        }
    </script>


<script>
  function handleFileSelection() {
    const fileInput = document.getElementById('fileInput');
    const selectedFile = fileInput.files[0];
    _webViewController.evaluateJavascript('FilePicker.postMessage("$selectedFile")');
  }
</script>




    <script src="{{url('/custom-assets/js/jquery.min.js')}}"></script>
    <script src="{{url('/custom-assets/js/popper.js')}}"></script>
    <script src="{{url('/custom-assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('/custom-assets/js/main.js')}}"></script>
</body>
</html>

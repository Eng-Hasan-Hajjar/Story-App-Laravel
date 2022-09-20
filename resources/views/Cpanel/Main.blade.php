@extends('layout.master')

@section('Content')

 <div class="container">

    <div class="row">
        <h4 class="text-center"> Save Status Form</h4>
        <br>
        <br>   
        <form action="{{ route('SaveStatusPost') }}" method="post" enctype="multipart/form-data">
        
            <div class="form-group">
                <input type="file" name="FileI"   class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="StoryValueI" placeholder="Some Text (Null Able)"  class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" value="Upload"   class="btn btn-primary btn-block">
            </div>
            {{ csrf_field() }}
                
        </form>
    </div>

    <div class="row">
        <br>
        <h4 class="text-center">Stories</h4>
        <br>
        <br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @for ($i = 0; $i < $Count; $i++)
                <li data-target="#myCarousel" data-slide-to="{{ $i }}"></li>
                @endfor
            </ol>
          
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

              @foreach ($Stories as $Story)
              @if ($Story['File']['FileExt'] == "mp4")
                <div class="item ">
                  <video  height="480" controls>
                  <source src="{{ url('/storage/'.$Story['File']['FileBaseName']) }}" type="video/mp4">
                  </video>
                  <div class="carousel-caption">
                    <p>{{ $Story['StoryValue'] }}</p>
                  </div>
                </div>
              @else
                <div class="item ">
                    <img  height="480" src="{{ url('/storage/'.$Story['File']['FileBaseName']) }}" alt="Chania">
                    <div class="carousel-caption">
                      <p>{{ $Story['StoryValue'] }}</p>
                    </div>
                </div>
              @endif

              @endforeach

            </div>
          
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </div>


 </div>



@endsection

@section('Script')

<script>  

$('#myCarousel > div :first').addClass('active');
$('.carousel-indicators > li :first').addClass('active');

</script>


@endsection

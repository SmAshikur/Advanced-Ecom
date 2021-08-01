<?php
use App\Models\Banner;
$ban= Banner::banner();
//echo "<pre>";print_r($ban);die();
?>

@if(isset($pageName)&&$pageName=='index')
   <div>
       <div id="carouselBlk" class="container-fluid">
           <div id="myCarousel" class="carousel slide">
               <div class="carousel-inner">
                   @foreach($ban as $key=> $b)
                       <div class="item @if($key==0) active @endif">
                           <div class="container">
                               <a @if(!empty($b['link'])) href="{{$b['link']}}" @else  href="javascript:void(0)" @endif>
                                   <img style="width:90%;  " src="{{asset('images/bannar_images/'.$b['image'])}}" alt="{{$b['altTag']}}" title="{{$b['title']}}"/>
                               </a>
                               <div class="carousel-caption">
                                   <h4>First Thumbnail label</h4>
                                   <p>Banner text</p>
                               </div>
                           </div>
                       </div>
                   @endforeach
               </div>
               <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
               <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
           </div>
       </div>
   </div>
@endif

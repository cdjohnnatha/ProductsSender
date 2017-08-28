<section id="content" class="container">
  <div class="content-body page-gallery m-t-30">
    <div id="photo-gallery" class="gallery row" itemscope itemtype="http://schema.org/ImageGallery">
      @if($package->pictures)
        @foreach($package->pictures as $picture)
          <figure class="col-xs-6 col-sm-3" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <div class="card image-over-card m-t-30">
              <div class="card-image">
                <a href="{{$picture->path}}"
                   data-caption="<div class='text-center'>{{$picture->created_at}}</div>"
                   data-width="1600" data-height="1068" itemprop="contentUrl">
                  <img src="{{$picture->path}}" itemprop="thumbnail" alt="Image description">
                </a>
              </div>
              <div class="card-body">
                <h4 class="card-title text-center"></h4>
                <h6 class="category text-gray text-center"><span>{{$picture->created_at}}</span></h6>
              </div>
            </div>
          </figure>
        @endforeach
      @endif
    </div>
  </div>
</section>
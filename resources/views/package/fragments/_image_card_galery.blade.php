<section>
   <section class="content-body">
      <div class="">
        <div class="col-lg-4">
          <section class="card card-gallery">
            <header class="card-heading">
              <h2 class="card-title">Image Gallery</h2>
            </header>
            <section class="card-body p-0">
              <div id="photo-gallery" class="gallery row" itemscope itemtype="http://schema.org/ImageGallery">
                @if($package->pictures)
                  @foreach($package->pictures as $index=>$pictures)
                    <div class="col-xs-4">
                      <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="{{$pictures->path}}" data-caption="<div class='text-center'><br><em class='text-muted'>{{$package->created_at}}</div>" data-width="1600" data-height="1068" itemprop="contentUrl">
                              <img src="{{$pictures->path}}" itemprop="thumbnail" alt="Image description">
                            </a>
                      </figure>
                    </div>
                    @if($index > 7)
                      @break
                    @endif
                  @endforeach
                @endif
              </div>
            </section>
            @if(count($package->pictures) > 7)
              <footer class="card-footer border-top">
                <ul class="more">
                  <li>
                    <a href="javascript:void(0)" disabled>View More</a>
                  </li>
                </ul>
              </footer>
            @endif
          </section>
        </div>
      </div>
    </section>
  <!-- End image galery -->
</section>
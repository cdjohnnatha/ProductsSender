@extends('layouts.app')

@section('content')
<div id="content" class="container">
  <div class="content-body">
    <div class="row">
      <div class="col-lg-10">
        <div class="card" id="rootwizard">
          <div class="card-heading">
            <form class="form floating-label">
              <div class="form-wizard-nav">
                <div class="progress" style="width: 75%;">
                  <div class="progress-bar" style="width:0%;"></div>
                </div>
                <ul class="nav nav-justified nav-pills">
                  <li class="active">
                    <a href="#tab1" data-toggle="tab" aria-expanded="true">
                      <span class="step">1</span>
                      <span class="title">{{__('user.registration.form_info_title')}}</span>
                    </a>
                  </li>
                  <li class="">
                    <a href="#tab2" data-toggle="tab" aria-expanded="false"><span class="step">2</span>
                      <span class="title">Address</span>
                    </a>
                  </li>
                  <li class="">
                    <a href="#tab3" data-toggle="tab" aria-expanded="false"><span class="step">3</span>
                      <span class="title">Plans</span>
                    </a>
                  </li>
                  <li class="">
                    <a href="#tab4" data-toggle="tab" aria-expanded="false"><span class="step">3</span>
                      <span class="title">Payment</span>
                    </a>
                  </li>
                  <li class="">
                    <a href="#tab5" data-toggle="tab" aria-expanded="false"><span class="step">4</span>
                      <span class="title">Confirmation</span>
                    </a>
                  </li>
                </ul>
              </div>
          </div>
          <div class="card-body p-0">
            <div class="form-wizard form-wizard-horizontal">
              <div class="tab-content clearfix p-30">
                <div class="tab-pane active" id="tab1">
                  <section class="form-group">
                    @include('user._form')
                  </section>
                </div>
                <!--end #tab1 -->
                <div class="tab-pane" id="tab2">
                    @include('address._form', ['title' => __('user.registration.address_title')])
                </div>
                <!--end #tab2 -->

                <div class="tab-pane" id="tab3">
                  @include('subscription.index_user')
                  {{--{{$subscriptions}}--}}
                </div>

                <!--end #tab3 -->
                <div class="tab-pane" id="tab4">
                  <form class="form-horizontal" role="form">
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group label-floating is-empty">
                          <label class="control-label">First Name on Card</label>
                          <input type="text" class="form-control" name="card-holder-name" id="card-holder-name">
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group label-floating is-empty">
                          <label class="control-label">Last Name on Card</label>
                          <input type="text" class="form-control" name="card-holder-name" id="card-holder-name">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group label-floating is-empty">
                          <label class="control-label">Credit Card Number</label>
                          <input type="text" class="form-control" name="card-holder-name" id="card-holder-name">
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <h4>We Accept:</h4>
                        <ul class="style-none list-inline">
                          <li><img src="{{asset('/img/icons/cc/visa.png')}}" alt="" /></li>
                          <li><img src="{{asset('img/icons/cc/mastercard.png')}}" alt="" /></li>
                          <li><img src="{{asset('img/icons/cc/discover.png')}}" alt="" /></li>
                          <li><img src="{{asset('img/icons/cc/american-express.png')}}" alt="" /></li>
                        </ul>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-4">
                        <div class="form-group label-floating is-empty">
                          <label class="control-label">CVC Number</label>
                          <input type="text" class="form-control" name="card-holder-name" id="card-holder-name">
                        </div>
                      </div>
                      <div class="col-xs-4">
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <select class="form-control select" name="expiry-month" id="expiry-month">
                                <option>Month</option>
                                <option value="01">Jan (01)</option>
                                <option value="02">Feb (02)</option>
                                <option value="03">Mar (03)</option>
                                <option value="04">Apr (04)</option>
                                <option value="05">May (05)</option>
                                <option value="06">June (06)</option>
                                <option value="07">July (07)</option>
                                <option value="08">Aug (08)</option>
                                <option value="09">Sep (09)</option>
                                <option value="10">Oct (10)</option>
                                <option value="11">Nov (11)</option>
                                <option value="12">Dec (12)</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <div class="form-group">
                              <select class="form-control select" name="expiry-year">
                                <option value="13">2013</option>
                                <option value="14">2014</option>
                                <option value="15">2015</option>
                                <option value="16">2016</option>
                                <option value="17">2017</option>
                                <option value="18">2018</option>
                                <option value="19">2019</option>
                                <option value="20">2020</option>
                                <option value="21">2021</option>
                                <option value="22">2022</option>
                                <option value="23">2023</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-4">
                      </div>
                    </div>
                  </form>
                </div>
                <!--end #tab4 -->
                <div class="tab-pane" id="tab5">
                  <div class="p-t-20">
                    <div class="row">
                      <div class="col-xs-12 col-sm-6">
                        <h4 class="p-b-10 border-grey-bottom-1px">Your Information</h4>
                        <ul class="style-none">
                          <li>Paula Gomez</li>
                          <li>paula-go1023@gmail.com</li>
                        </ul>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                        <h4 class="p-b-10 border-grey-bottom-1px">Payment</h4>
                        <ul class="style-none list-inline">
                          <li><img src="assets/img/icons/cc/visa.png" alt="" class="pull-left m-r-15" /></li>
                        </ul>
                        <p>Visa Card ending in 1234</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 col-sm-6">
                        <h4 class="p-b-10 p-t-10 border-grey-bottom-1px">Shipping Address</h4>
                        <ul class="style-none">
                          <li>Paula Gomez</li>
                          <li>1600 Amphitheatre Parkway</li>
                          <li>Mountain View, CA 94043</li>
                          <li>Phone: +1 650-253-0000</li>
                        </ul>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                        <h4 class="p-b-10 p-t-10 border-grey-bottom-1px">Billing Address</h4>
                        <ul class="style-none">
                          <li>Paula Gomez</li>
                          <li>1600 Amphitheatre Parkway</li>
                          <li>Mountain View, CA 94043</li>
                          <li>Phone: +1 650-253-0000</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive border-grey-bottom-1px m-b-20 m-t-20">
                    <table class="table table-hover product-table">
                      <thead>
                      <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <th><img src="assets/img/ecom/products/2830_S4ql.jpeg" alt="" class="img-thumbnail"></th>
                        <td>
                          <span class="block">Lake Sunset</span>
                          <span class="block"><strong>Size:</strong> Large</span>
                          <span class="block"><strong>Color:</strong> Tri-Blend Vintage Royal</span>
                          <span class="block"><strong>SKU:</strong> #203004</span>
                        </td>
                        <td>2</td>
                        <td>$29.99</td>
                        <td>$59.98</td>
                      </tr>
                      <tr>
                        <th><img src="assets/img/ecom/products/39_Ie8T.jpeg" alt="" class="img-thumbnail"></th>
                        <td>
                          <span class="block">A Gaggle of Triangles</span>
                          <span class="block"><strong>Size:</strong> Large</span>
                          <span class="block"><strong>Color:</strong> Tri-Blend Vintage Royal</span>
                          <span class="block"><strong>SKU:</strong> #203004</span>
                        </td>
                        <td>1</td>
                        <td>$29.99</td>
                        <td>$29.99</td>
                      </tr>
                      <tr>
                        <th><img src="assets/img/ecom/products/12252_Tgi0.jpeg" alt="" class="img-thumbnail"></th>
                        <td>
                          <span class="block">Grunt</span>
                          <span class="block"><strong>Size:</strong> Large</span>
                          <span class="block"><strong>Color:</strong> Tri-Blend Vintage Royal</span>
                          <span class="block"><strong>SKU:</strong> #203004</span>
                        </td>
                        <td>1</td>
                        <td>$19.99</td>
                        <td>$19.99</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-11 text-right ">
                      <span class="block p-b-5">Item Subtotal:</span>
                      <span class="block p-b-5">Est. Shipping:</span>
                      <span class="block p-b-5 p-t-5">Total:</span>
                    </div>
                    <div class="col-xs-6 col-sm-1 p-0">
                      <span class="block p-b-5">$109.96</span>
                      <span class="block p-b-5">$8.50</span>
                      <span class="block p-b-5 cart-total">$118.46</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <ul class="pager wizard">
              <li class="previous disabled"><a class="btn btn-primary btn-round" href="javascript:void(0);">Previous</a></li>
              <li class="next"><a class="btn btn-primary btn-round" href="javascript:void(0);">Next</a></li>
              <li class="finish"><button class="btn btn-green btn-round pull-right">Place Order</button></li>
            </ul>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section id="chat_compose_wrapper">
    <div class="tippy-top">
      <div class="recipient">Allison Grayce</div>
      <ul class="card-actions icons  right-top">
        <li>
          <a href="javascript:void(0)">
            <i class="zmdi zmdi-videocam"></i>
          </a>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
            <i class="zmdi zmdi-more-vert"></i>
          </a>
          <ul class="dropdown-menu btn-primary dropdown-menu-right">
            <li>
              <a href="javascript:void(0)">Option One</a>
            </li>
            <li>
              <a href="javascript:void(0)">Option Two</a>
            </li>
            <li>
              <a href="javascript:void(0)">Option Three</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0)" data-chat="close">
            <i class="zmdi zmdi-close"></i>
          </a>
        </li>
      </ul>
    </div>
    <div class='chat-wrapper scrollbar'>
      <div class='chat-message scrollbar'>
        <div class='chat-message chat-message-recipient'>
          <img class='chat-image chat-image-default' src='assets/img/profiles/05.jpg' />
          <div class='chat-message-wrapper'>
            <div class='chat-message-content'>
              <p>Hey Mike, we have funding for our new project!</p>
            </div>
            <div class='chat-details'>
              <span class='today small'></span>
            </div>
          </div>
        </div>
        <div class='chat-message chat-message-sender'>
          <img class='chat-image chat-image-default' src='assets/img/profiles/02.jpg' />
          <div class='chat-message-wrapper '>
            <div class='chat-message-content'>
              <p>Awesome! Photo booth banh mi pitchfork kickstarter whatever, prism godard ethical 90's cray selvage.</p>
            </div>
            <div class='chat-details'>
              <span class='today small'></span>
            </div>
          </div>
        </div>
        <div class='chat-message chat-message-recipient'>
          <img class='chat-image chat-image-default' src='assets/img/profiles/05.jpg' />
          <div class='chat-message-wrapper'>
            <div class='chat-message-content'>
              <p> Artisan glossier vaporware meditation paleo humblebrag forage small batch.</p>
            </div>
            <div class='chat-details'>
              <span class='today small'></span>
            </div>
          </div>
        </div>
        <div class='chat-message chat-message-sender'>
          <img class='chat-image chat-image-default' src='assets/img/profiles/02.jpg' />
          <div class='chat-message-wrapper'>
            <div class='chat-message-content'>
              <p>Bushwick letterpress vegan craft beer dreamcatcher kickstarter.</p>
            </div>
            <div class='chat-details'>
              <span class='today small'></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer id="compose-footer">
      <form class="form-horizontal compose-form">
        <ul class="card-actions icons left-bottom">
          <li>
            <a href="javascript:void(0)">
              <i class="zmdi zmdi-attachment-alt"></i>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="zmdi zmdi-mood"></i>
            </a>
          </li>
        </ul>
        <div class="form-group m-10 p-l-75 is-empty">
          <div class="input-group">
            <label class="sr-only">Leave a comment...</label>
            <input type="text" class="form-control form-rounded input-lightGray" placeholder="Leave a comment..">
            <span class="input-group-btn">
                        <button type="button" class="btn btn-blue btn-fab  btn-fab-sm">
                          <i class="zmdi zmdi-mail-send"></i>
                        </button>
                      </span>
          </div>
        </div>
      </form>
    </footer>
  </section>
</div>
</div>





@endsection

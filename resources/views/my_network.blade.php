@extends('layouts.my_network_layout')
@section('content')
<div class="space" style="height:15px;"></div>
<div class="container"><!-------------advertisements-------Shamu 1-------->
  <div class="advertisements" style="background:#fff; border:1px solid #dfdfdf;">
    <div class="netlinks">
      <h2 class="sub_heading">Quick <span>Links</span></h2>
      <div class="border_red"></div>
      <ul>
        <li><a href=""><span><img src="{{url('public/asset/plugins/dist/images/new.png')}}"></span> What’s New</a></li>
        <li><a href=""><span><img src="{{url('public/asset/plugins/dist/images/job.png')}}"></span> Latest Jobs</a></li>
        <li><a href=""><span><img src="{{url('public/asset/plugins/dist/images/deals.png')}}"></span> Latest Deals</a></li>
        <li><a href=""><span><img src="{{url('public/asset/plugins/dist/images/timeline.png')}}"></span> Around You</a></li>
      </ul>
    </div>
    <div class="netlinks">
      <h2 class="sub_heading">Shortcuts</h2>
      <div class="border_red"></div>
      <ul>
        <li><a href=""><span><img src="{{url('public/asset/plugins/dist/images/bookmark.png')}}"></span> Bookmarked</a></li>
        <li><a href=""><span><img src="{{url('public/asset/plugins/dist/images/comein.png')}}"></span> Come In</a></li>
        <li><a href=""><span><img src="{{url('public/asset/plugins/dist/images/follow.png')}}"></span> Who To Follow</a></li>
      </ul>
    </div>
  </div>
  <!-------------advertisements---------------><!-------------all_posts----shamu 2---------->
    <div class="all_posts">
        <div class="edit_post" style="background:#fff; border:1px solid #dfdfdf;padding:15px; margin-bottom:15px;">
            @if(!$singlepostview)
            @include('posts.createpost')
            @endif
        </div>
        <!---------single_post 1--------->
        <div id="main_content">
            @include('posts.showposts')
        </div>
        <div class="col-md-12" id='loader_post_id' style='display:none;text-align:center'>
            <img src="{{ URL::to('public/images/postloader.gif')}}" style="width:10%" />
        </div>
        <!---------end single_post 1---------> 
    </div>
  <!-------------end all_posts--------------><!-------------business_ref------shamu 3-------->
  <div class="business_ref"> <!-----sponsored--------->
    <div class="sponsored" style="background:#fff;border:1px solid #dfdfdf;margin-bottom:15px; padding:15px;">
      <h2 class="sub_heading">Sponsored <span>Offers<span></h2>
      <div class="border_red"></div>
      <!---------sumup------------>
      <div class="sumup"> <!------sumup_head-------->
        <div class="sumup_head"><!---------------sumup_left-------------->
          <div class="sumup_left">
            <div class="fiture_logo"><a href="#"><img src="{{url('public/asset/plugins/dist/images/slogo.png')}}"></a></div>
            <!----------spons_name----------->
            <div class="spons_name"><a href="#">SumUp</a><br>
              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
                <option selected>sponsored</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <!----------end spons_name-----------></div>
          <!---------------end sumup_left--------------><!--------sumup_right--------->
          <div class="sumup_right"> <i class="fa fa-bookmark-o" aria-hidden="true"></i></div>
          <!--------END sumup_right---------></div>
        <!------end sumup_head--------><!--------sumup_content------------>
        <div class="sumup_content">
          <p>Whatever you do, #SumUpAir is the perfect way for your business to get paid. o monthly fees. Accept all cards.</p>
          <a href="#" class="blue_bg"><img src="{{url('public/asset/plugins/dist/images/sumup_logo.png')}}"></a><a href="#" class="post_name">Euro 19 Limited Offer - Get the new contactless reader today!</a>
          <p>No fixed costs. Only pay 1.95% per transaction. Direct payout to your bank account. </p>
          <a href="#" class="button_red">follow</a></div>
        <!--------end sumup_content------------></div>
      <!---------end sumup------------><!---------sumup------------>
      <div class="sumup"><!-----------sumup_head-------------->
        <div class="sumup_head"><!------sumup_left---------->
          <div class="sumup_left">
            <div class="fiture_logo"><a href="#"><img src="{{url('public/asset/plugins/dist/images/slogo.png')}}"></a></div>
            <div class="spons_name"><a href="#">SumUp</a><br>
              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
                <option selected>sponsored</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>
          <!------sumup_left----------><!-----sumup_right---------->
          <div class="sumup_right"><i class="fa fa-bookmark-o" aria-hidden="true"></i></div>
          <!-----end sumup_right----------></div>
        <!-----------end sumup_head--------------><!----sumup_content---->
        <div class="sumup_content">
          <p>Whatever you do, #SumUpAir is the perfect way for your business to get paid. o monthly fees. Accept all cards.</p>
          <a href="#" class="blue_bg"><img src="{{url('public/asset/plugins/dist/images/sumup_logo.png')}}"></a><a href="#" class="post_name">Euro 19 Limited Offer - Get the new contactless reader today!</a>
          <p>No fixed costs. Only pay 1.95% per transaction. Direct payout to your bank account. </p>
          <a href="#" class="button_red">follow</a></div>
        <!----endsumup_content----></div>
      <!---------end sumup------------> </div>
    <!-------sponsored-------------->
    <div class="sponsored"> <!-----------spons---------->
      <div class="spons">
        <h2 class="sub_heading">Sponsored <span>Company</span></h2>
        <div class="border_red"></div>
        <!--our_company-->
        <div class="our_company"> <!--company-->
          <div class="company simple_border_red"> <!--company_logo-->
            <div class="company_logo"> <img src="{{url('public/asset/plugins/dist/images/webapplisoft.png')}}" alt="#" /> </div>
            <!--end company_logo--> <!--company_content-->
            <div class="company_content"> <!--company_content_left-->
              <div class="company_content_left">
                <h3>Webapplisoft </h3>
                <p>Mohali, IN</p>
              </div>
              <!--end company_content_left--> <!--company_content_right-->
              <div class="company_content_right"> <a href="#" class="button_red">follow</a> </div>
              <!--end company_content_right--> </div>
            <!--end company_content--> </div>
          <!--end company--> <!--company-->
          <div class="company simple_border"> <!--company_logo-->
            <div class="company_logo"> <img src="{{url('public/asset/plugins/dist/images/webapplisoft.png')}}" alt="#" /> </div>
            <!--end company_logo--> <!--company_content-->
            <div class="company_content"> <!--------company_content_left--------->
              <div class="company_content_left">
                <h3>Webapplisoft </h3>
                <p>Mohali, IN</p>
              </div>
              <!--end company_content_left--> <!--company_content_right-->
              <div class="company_content_right"> <a href="#" class="button_red">follow</a> </div>
              <!--end company_content_right--> </div>
            <!--end company_content--> </div>
          <!--end company--> </div>
        <!--end our_company--> </div>
      <!-----------spons----------> <!-----------spons---------->
      <div class="spons">
        <h2 class="sub_heading">Sponsored <span>Company</span></h2>
        <div class="border_red"></div>
        <!------company------------>
        <div class="company"> <!--company_logo-->
          <div class="company_logo vertical1"> <img src="{{url('public/asset/plugins/dist/images/people.png')}}" alt="#" /> <a href="#" class="button_red">follow</a> </div>
          <!--end company_logo--> <!--company_content-->
          <div class="company_content vertical2"> <!--company_content_left-->
            <div class="company_content_left">
              <h3>Sarvesh Kumar Yadav</h3>
            </div>
            <!--end company_content_left--> <!--company_content_right-->
            <div class="company_content_right">
              <h4>Web Designer</h4>
              <h5>Webcoir It Solutions Pvt. Ltd.</h5>
              <p>Noida, IN</p>
            </div>
            <!--end company_content_right--> </div>
          <!--end company_content--> </div>
        <!------end company------------> <!-----company simple_border_red------->
        <div class="company simple_border_red"> <!--company_logo-->
          <div class="company_logo vertical1"> <img src="{{url('public/asset/plugins/dist/images/people.png')}}" alt="#" /> <a href="#" class="button_red">follow</a> </div>
          <!--end company_logo--> <!------------company_content vertical2------------>
          <div class="company_content vertical2"> <!-------company_content_left------>
            <div class="company_content_left">
              <h3>Sarvesh Kumar Yadav</h3>
            </div>
            <!--end company_content_left--> <!--------company_content_right-------->
            <div class="company_content_right">
              <h4>Web Designer</h4>
              <h5>Webcoir It Solutions Pvt. Ltd.</h5>
              <p>Noida, IN</p>
            </div>
            <!--end company_content_right--> </div>
          <!------------end company_content vertical2------------> </div>
        <!-----end company simple_border_red-------> </div>
      <!-----------end spons----------> </div>
    <!-------end sponsored--------------> </div>
  <!-------------business_ref--------------></div>

<!-- End sources Section -->
<!--<link href="//code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">  
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>  
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->

<script>
    /*$(document).ready(function () {
        $(window).scroll(function () {
		var colfix = ($(".col3").height()) / 2;
		if ($(window).scrollTop() > colfix) {
		$(".col3").addClass("col3fix");
		} else {
		$(".col3").removeClass("col3fix");
		}
        });
	});*/
</script>
<style>
    .col3fix {
	position: fixed;
	width: 270px;
	bottom:55px;
    }
</style>
@if(Auth::user()->status == 0)
    <script src="{{ URL::to('asset/js/bootstrap.min.js') }}"></script>
@endif  
<script type="text/javascript" src="{{ URL::to('public/js/post.js') }}"></script>

@endsection


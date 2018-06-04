@extends('layouts.authorised')

@section('content')
<!-- Start Products Section -->


<?php extract($data);
?>
<section id="products" class="products-section">
    <div class="container">
        <div class="row all_search">
        <!-- Search Box -->
        <div class="sbanner banner_search">
            <div class="bannerbox clearfix">
                <div class="bannerbox1">
                    <input type="" placeholder="Company / User">
                </div>
                <div class="bannerbox2">
                    <select>
                        <option>State</option>
                        <option>Delhi</option>
                        <option>Uttar Pradesh</option>
                        <option>Madhya Pradesh</option>
                        <option>Mharashtra</option>
                    </select>
                </div>
                <div class="bannerbox3">
                    <select>
                        <option>Country</option>
                        <option>Afghanistan</option>
                        <option>Albania</option>
                        <option>Algeria</option>
                        <option>American Samoa</option>
                        <option>England</option>
                        <option>India</option>
                    </select>
                </div>
                <div class="bannerbox4">
                    <button name=""><i class="fa fa-search" aria-hidden="true"></i><span>Search</span></button>
                </div>
            </div>
        </div>            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3>Companies</h3>
                    <p>Duis aute irure dolor in reprehenderit in voluptate</p>
                </div>                        
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Start sources items -->
                <ul id="sources-list">
                  @if(isset($companies) && count($companies))  
                  @foreach($companies as $user)
                    <li>
                        <div class="sources-img">
                            <img src="{{ $user->profilepic }}" class="img-responsive" alt="">
                        </div>
                        <div class="sources-item">
                            <div class="comp_name">{{ $user->fname }}</div>
                            <div class="comp_add">{{ $user->country }}</div>
                            <div class="star_review">
                                <div class="star_disabled"></div>
                                <div class="star_active" style="width:70px;"></div>
                            </div>
                            <div class="comp_name"></div>
                        </div>
                        <button class="followbtn" onclick="doFollow('{{ $user->follow_link }}',this)">Follow</button>
                    </li>
                 @endforeach   
                 @else 
                        <li>No company found</li>
                 @endif
                </ul>
                <!-- End sources items -->
            </div>
        </div>
    </div>
</section>
<!-- End Products Section -->


<!-- Start Services Section -->
<section id="services" class="services-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3>People</h3>
                    <p>Duis aute irure dolor in reprehenderit in voluptate</p>
                </div>                        
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Start people items -->
                <ul id="people-list">

                    @if(isset($users) && count($users))
                    @foreach($users as $user)
                    <li>
                        <div class="people-img">
                            <a href="{{ $user->user_link }}"><img src="{{ $user->profilepic }}" class="img-responsive" alt=""></a>
                        </div>
                        <div class="people-item">
                            <div class="people_name"><a href="{{ $user->user_link }}">{{$user->fname}}</a></div>
                            <div class="people_des">{{ $user->pres_desg }}</div>
                            <!--<div class="pcmp_name">Webcoir It Solutions</div>-->
                            <div class="people_add">{{$user->country}}</div>
                        </div>
                        <button class="followbtn" onclick="doFollow('{{ $user->follow_link }}',this)">Follow</button>
                    </li>
                    @endforeach
                    @else
                    <li>No user found</li>
                    @endif
                    
                   
                </ul>
                <!-- End sources items -->
            </div>
        </div>
    </div>
</section>
<!-- End Services Section -->	
<section id="foot" class="foot">        
    <footer class="style-1">
        <div class="container">
            <div class="row">
                @include("include.footer_login")
            </div>
        </div>

    </footer>
</section>

<script>
// JavaScript for show Signup Modal Auto On page load
    function myMod() {
        $("#signup").modal('show');
    }
    $(window).load(function () {
        setTimeout(myMod, 2000)
    });
</script>

@endsection
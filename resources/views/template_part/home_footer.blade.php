<div id="footer">
	<div class="container">
    	<a href="{{URL::to('/')}}"><img src="{{url('public/asset/plugins/dist/images/footer_logo.png')}}" alt="#" /></a>
        <ul class="social_media">
       	<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
		<li><a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
		<li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
		<li><a href="https://plus.google.com" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
        </ul>
        <ul class="footer_menu">
        	<li><a href="{{URL::to('/')}}">home</a></li>
            <li><a href="{{url('/about')}}">about</a></li>
            <li><a href="{{url('/terms-and-conditions')}}">Terms And Conditions </a></li>
            <li><a href="#">Contact Us </a></li>
            <li><a href="#"> Site Map </a></li>
        </ul>
        <h6>© Copyright Visteco Ltd 2018</h6>
        <p> Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain.</p>
    </div>
</div>
<!--end footer-->
<!--include jQuery Validation Plugin-->
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"
type="text/javascript"></script>
<script src="{{url('public/asset/plugins/dist/js/front-script.js')}}" type="text/javascript"></script>
<script>/* shammu like*/ $(function() {    var reaction = $('.reacts'),        star = $('.star');    reaction.addClass('show');    star.on('click',function() {        if(reaction.hasClass('show')) {            reaction.css({                'display':'none',            });            reaction.removeClass('show');        }        else {            reaction.css({                'display':'flex',            });            reaction.addClass('show');        }    });}); </script>
</body>
</html>
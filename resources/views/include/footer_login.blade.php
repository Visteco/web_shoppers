<footer class="col-md-12 style-1 text-center">
    <img src="images/logos/visteco.png" width="80%">
    <h5>Connect to all in one plateform !!</h5>
    <div class="footer-link">
        <ul class="pull-right">
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="terms.php">Terms of Use</a></li>
        </ul>
    </div>
    <p>&nbsp;</p>
    <div class="footer-social ">
        <ul>
            <li><a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
        </ul>
    </div>
    <p>&nbsp;</p>
    <p>Copyright © Visteco Ltd 2017</p>
    <p class="copyright">Design & Devloped By :  <a href="http://webcoir.com" target="_blank"><img src="images/logos/webcoir.png" width="30%"></a></p>

</footer>

<script src="{{ URL::to('asset/js/bootstrap.min.js') }}"></script>

<script src="{{ URL::to('js/styleswitcher.js') }}"></script>
<script src="{{URL::to('public/js/jquery.fitvids.js')}}"></script>
<script src="{{ URL::to('js/script.js') }}"></script>

<script src="{{URL::to('public/js/bootbox.min.js')}}"></script>

@if(Auth::check())

<script src="{{ URL::to('js/jquery.appear.js') }}"></script>
<script src="{{ URL::to('js/classie.js') }}"></script>
<script src="{{ URL::to('js/cbpAnimatedHeader.js') }}"></script>
<script src="{{ URL::to('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('public/js/post.js') }}"></script>
@endif

<script type="text/javascript">

function getSuggestion(thisone,link,parentId){
    var val = $(thisone).val();
     
     if(val.trim()==""){
         $("#"+parentId).html("");
         return false;
     }else{
        var queryLink = link+"/"+val;  
     }
         
         
         
    $.get(queryLink,function(data,status){
        
       
        
        if(data.success==true){
            $("#"+parentId).html(data.users);
        } 
            
            
            
    });
}
</script>
</body>
</html>

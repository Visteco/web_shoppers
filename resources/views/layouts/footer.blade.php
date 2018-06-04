
    <section id="foot" class="foot">        
        <footer class="style-1">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="section-title text-center">
							<h3>Visteco Ltd</h3>
							<p>Connect to all in one plateform !!</p>
							<span class="copyright">Copyright &copy; Visteco Ltd 2017</span>
						</div>
					</div>
				</div>
			</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <span class="copyright">Design & Devloped By :  <a href="http://webcoir.com" target="_blank">Webcoir IT Solutions Pvt Ltd</a> </span>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="footer-social text-center">
                            <ul>
                                <li><a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="footer-link">
                            <ul class="pull-right">
                                <li><a href="about.php">About Us</a>
                                </li>
								 <li><a href="contact.php">Contact Us</a>
                                </li>
								<li><a href="privacy.php">Privacy Policy</a>
                                </li>
                                <li><a href="terms.php">Terms of Use</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>


    <script src="{{ URL::to('asset/js/bootstrap.min.js') }}"></script>
    
    <script src="{{ URL::to('js/styleswitcher.js') }}"></script>
    
    <script src="{{ URL::to('js/script.js') }}"></script>
    
    <script src="{{URL::to('js/bootbox.min.js')}}"></script>
    
    @if(Auth::check())
        <script src="{{ URL::to('js/count-to.js') }}"></script>
        <script src="{{ URL::to('js/jquery.appear.js') }}"></script>
       
    @endif
   
   
    
</body>
</html>
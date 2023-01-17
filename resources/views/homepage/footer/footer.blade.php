<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-padding fix">
         <div class="container">
             <div class="row d-flex justify-content-between">
                 <div class="col-md-6 col-12">
                     <div class="single-footer-caption">
                         <div class="single-footer-caption">
                             <!-- logo -->
                             <div class="footer-logo">
                                 <h1 style="color: honeydew">
                                    <img style="width: 150px; heigh: 150px" src="{{URL::to('res/assets/logo/logo-full.jpeg')}}" alt="">
                                 </h1>
                             </div>
                             <div class="footer-tittle">
                                 <div class="footer-pera">
                                    <p>{{$system_info['system']['system_name']}}</p>
                                 </div>
                             </div>
                             <!-- social -->
                             <div class="footer-social">
                                 @foreach ($system_info['socmed'] as $item)
                                 <a href="{{$item->url}}"><i class="{{$item->icon}}"></i></a>
                                 @endforeach
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-6 col-12">
                     <div class="single-footer-caption mt-60">
                         <div class="footer-tittle">
                             <h4>Dapatkan info ter-update dari kami.</h4>
                             <!-- Form -->
                             <div class="footer-form" >
                                 <div>
                                     <form method="get" action="{{URL::to('/subscribe')}}">
                                         <input type="email" name="email" placeholder="Masukan email">
                                         <div class="form-icon">
                                         <button type="submit">
                                             <img src="res/assets/img/logo/form-iocn.png" alt="">
                                        </button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 {{-- <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                     <div class="single-footer-caption mb-50 mt-60">
                         <div class="footer-tittle">
                             <h4>Instagram Feed</h4>
                         </div>
                         <div class="instagram-gellay">
                             <ul class="insta-feed">
                                 <li><a href="#"><img src="res/assets/img/post/instra1.jpg" alt=""></a></li>
                                 <li><a href="#"><img src="res/assets/img/post/instra2.jpg" alt=""></a></li>
                                 <li><a href="#"><img src="res/assets/img/post/instra3.jpg" alt=""></a></li>
                                 <li><a href="#"><img src="res/assets/img/post/instra4.jpg" alt=""></a></li>
                                 <li><a href="#"><img src="res/assets/img/post/instra5.jpg" alt=""></a></li>
                                 <li><a href="#"><img src="res/assets/img/post/instra6.jpg" alt=""></a></li>
                             </ul>
                         </div>
                     </div>
                 </div> --}}
             </div>
         </div>
     </div>
    <!-- footer-bottom aera -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="footer-border">
                 <div class="row d-flex align-items-center justify-content-between">
                     <div class="col-lg-6">
                         <div class="footer-copy-right">
                             <p>
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                            </p>
                         </div>
                     </div>
                     <div class="col-lg-6">
                         <div class="footer-menu f-right">
                             <ul>                             
                                 {{-- <li><a href="#">Terms of use</a></li> --}}
                                 {{-- <li><a href="#">Privacy Policy</a></li> --}}
                                 {{-- <li><a href="#">Kontak</a></li> --}}
                             </ul>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>

 <!-- JS here -->
 
     <!-- All JS Custom Plugins Link Here here -->
     <script src="res/assets/js/vendor/modernizr-3.5.0.min.js"></script>
     <!-- Jquery, Popper, Bootstrap -->
     <script src="res/assets/js/vendor/jquery-1.12.4.min.js"></script>
     <script src="res/assets/js/popper.min.js"></script>
     <script src="res/assets/js/bootstrap.min.js"></script>
     <!-- Jquery Mobile Menu -->
     <script src="res/assets/js/jquery.slicknav.min.js"></script>

     <!-- Jquery Slick , Owl-Carousel Plugins -->
     <script src="res/assets/js/owl.carousel.min.js"></script>
     <script src="res/assets/js/slick.min.js"></script>
     <!-- Date Picker -->
     <script src="res/assets/js/gijgo.min.js"></script>
     <!-- One Page, Animated-HeadLin -->
     <script src="res/assets/js/wow.min.js"></script>
     <script src="res/assets/js/animated.headline.js"></script>
     <script src="res/assets/js/jquery.magnific-popup.js"></script>

     <!-- Breaking New Pluging -->
     <script src="res/assets/js/jquery.ticker.js"></script>
     <script src="res/assets/js/site.js"></script>

     <!-- Scrollup, nice-select, sticky -->
     <script src="res/assets/js/jquery.scrollUp.min.js"></script>
     <script src="res/assets/js/jquery.nice-select.min.js"></script>
     <script src="res/assets/js/jquery.sticky.js"></script>
     
     <!-- contact js -->
     <script src="res/assets/js/contact.js"></script>
     <script src="res/assets/js/jquery.form.js"></script>
     <script src="res/assets/js/jquery.validate.min.js"></script>
     <script src="res/assets/js/mail-script.js"></script>
     <script src="res/assets/js/jquery.ajaxchimp.min.js"></script>
     
     <!-- Jquery Plugins, main Jquery -->	
     <script src="res/assets/js/plugins.js"></script>
     <script src="res/assets/js/main.js"></script>
     
 </body>
</html>
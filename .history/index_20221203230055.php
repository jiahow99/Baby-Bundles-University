<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&amp;display=swap">
    <!-- Modal Video-->
    <link rel="stylesheet" href="vendor/modal-video/css/modal-video.min.css">
    <!-- Leaflet-->
    <link rel="stylesheet" href="vendor/leaflet/leaflet.css">
    <!-- Swiper slider-->
    <link rel="stylesheet" href="vendor/swiper/swiper-bundle.min.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">

    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.png">
    
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/header-style.css">

    
  </head>
  <?php require 'header.php' ?>
  <body>
    <!-- navbar-->
    <!-- Hero Slider -->
    <section>
      <div class="swiper hero-slider">
        <div class="swiper-wrapper" >
          <!-- Hero Slide-->
          <div class="swiper-slide hero-slide bg-size bg-center py-5" style="background: url(img/hero-banner-1.jpg)">
            <div class="container text-white py-5 index-forward">
              <div class="row">
                <div class="col-lg-7">
                  <h1>All items here are afforfable</h1>
                  <p class="lead">It's more affordable than buying new items.</p>
                  <ul class="list-inline">
                    <li class="list-inline-item me-0"><a class="btn btn-primary px-5" href="upload-product.php">Sell</a></li>
                    <li class="list-inline-item"></li><a class="btn btn-outline-light px-5" href="top.php">Buy</a>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Hero Slide-->
          <div class="swiper-slide hero-slide bg-size bg-center py-5" style="background: url(img/hero-banner-2.jpg)">
            <div class="container text-white py-5 index-forward">
              <div class="row">
                <div class="col-lg-7">
                  <h1>Save money on the things you need for baby.</h1>
                  <p class="lead">By buying your baby essentials in bulk, you’ll cut costs and always have a stock of everything you need for your baby.</p>
                  <ul class="list-inline">
                    <li class="list-inline-item me-0"><a class="btn btn-primary px-5" href="upload-product.php">Sell</a></li>
                    <li class="list-inline-item"></li><a class="btn btn-outline-light px-5" href="top.php">Buy</a>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Hero Slide-->
          <div class="swiper-slide hero-slide bg-size bg-center py-5" style="background: url(img/hero-banner-3.jpg)">
            <div class="container text-white py-5 index-forward">
              <div class="row">
                <div class="col-lg-7">
                  <h1>You always get the best quality</h1>
                  <p class="lead">We assure the product here are best condition.</p>
                  <ul class="list-inline">
                    <li class="list-inline-item me-0"><a class="btn btn-primary px-5" href="upload-product.php">Sell</a></li>
                    <li class="list-inline-item"></li><a class="btn btn-outline-light px-5" href="top.php">Buy</a>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-button-next swiper-nav-custom d-none d-lg-block"></div>
        <div class="swiper-button-prev swiper-nav-custom d-none d-lg-block"></div>
        <div class="swiper-pagination py-3 d-block d-lg-none"></div>
      </div>
    </section>

    <section class="py-2 bg-light" id="categories">
    <p class="h4 mt-4 text-uppercase text-primary mb-3 text-center">Categories</p>
      <!-- Row 1 (Category) -->
    <div class="d-flex justify-content-center py-5" align="center" style="gap:6rem;">
      <div class="col-2">
        <a href="top.php" class="category card overflow-hidden">
          <img src="img/top.jpg" class="card-img" alt="">
          <div class="card-img-overlay d-flex align-items-center justify-content-center p-0">
            <h2 class="card-title display-5 text-white fw-normal  underline">Top</h2>
          </div>
        </a>
      </div>

      <div class="col-2">
        <a href="bottom.php" class="category card overflow-hidden">
          <img src="img/bottom.jpg" class="card-img" alt="">
          <div class="card-img-overlay d-flex align-items-center justify-content-center p-0">
            <h2 class="card-title display-6 text-light fw-normal underline">Bottom</h2>
          </div>
        </a>
      </div>

      <div class="col-2">
        <a href="accessories.php" class="category card overflow-hidden">
          <img src="img/accessories.jpg" class="card-img" alt="">
          <div class="card-img-overlay d-flex align-items-center justify-content-center p-0">
            <h2 class="card-title display-6 text-white fw-normal  underline">Accessories</h2>
          </div>
        </a>
      </div>
      <div class="col-2">
        <a href="socks.php" class="category card overflow-hidden">
          <img src="img/socks.jpg" class="card-img" alt="">
          <div class="card-img-overlay d-flex align-items-center justify-content-center p-0">
            <h2 class="card-title display-6 text-white fw-normal  underline">Socks</h2>
          </div>
        </a>
      </div>
      </div>
      <!-- Row 2 (Category) -->
      <div class="d-flex justify-content-center" align="center" style="gap:6rem;">
        <div class="col-2">
            <a href="shoes.php" class="category card overflow-hidden">
              <img src="img/shoes.jpg" class="card-img" alt="">
              <div class="card-img-overlay d-flex align-items-center justify-content-center p-0">
                <h2 class="card-title display-6 text-white fw-normal  underline">Shoes</h2>
              </div>
            </a>
          </div>

          <div class="col-2">
            <a href="toy.php" class="category card overflow-hidden">
              <img src="img/toy.jpg" class="card-img" alt="">
              <div class="card-img-overlay d-flex align-items-center justify-content-center p-0">
                <h2 class="card-title display-6 text-white fw-normal  underline">Toy</h2>
              </div>
            </a>
          </div>

          <div class="col-2">
            <a href="baby-carts.php" class="category card overflow-hidden">
              <img src="img/baby-cart.jpg" class="card-img" alt="">
              <div class="card-img-overlay d-flex align-items-center justify-content-center p-0">
                <h2 class="card-title display-6 text-white fw-normal  underline">Baby Cart</h2>
              </div>
            </a>
          </div>
      </div>
    </section>

    
  
    
    <!-- Features Section -->
    <section class="py-5 bg-light" id="about">
      <div class="container py-5">
        <div class="row">
          <div class="col-lg-6 order-2 order-lg-1">
            <p class="h6 mb-1 text-uppercase text-primary mb-3">Our main goals</p>
            <h2 class="mb-4">You will find a range of aesthetic and cute clothes for your baby.</h2>
            <ul class="list-check list-unstyled row px-3 mb-4 gy-2">
              <li class="text-sm text-muted col-lg-6">Cute Top</li>
              <li class="text-sm text-muted col-lg-6">Fancy Bottom</li>
              <li class="text-sm text-muted col-lg-6">Adorable Shoes</li>
              <li class="text-sm text-muted col-lg-6">Outgoing asseccories</li>
              <li class="text-sm text-muted col-lg-6">Pretty Socks</li>
              <li class="text-sm text-muted col-lg-6">Enjoyful Toys</li>
            </ul> 
            <ul class="list-inline py-4 border-top border-bottom d-flex align-items-center">
              <li class="list-inline-item pr-4 mr-0"><img src="img/about-sign.png" alt="" width="80"></li>
              <li class="list-inline-item px-4 mr-0 border-left">
                <h5 class="mb-0">Yee Zhen</h5>
                <p class="small font-weight-normal text-muted mb-0">Chairman and founder </p>
              </li>
              <li class="list-inline-item pl-4 border-left">
                <h5 class="mb-0">+420 754 6545 656  4</h5>
                <p class="small font-weight-normal text-muted mb-0">Call to ask any question</p>
              </li>
              
            </ul>
            <ul class="list-inline py-4 border-top border-bottom d-flex align-items-center">
              <li class="list-inline-item pr-4 mr-0"><img src="img/about-sign.png" alt="" width="80"></li>
              <li class="list-inline-item px-4 mr-0 border-left">
                <h5 class="mb-0">Kah How</h5>
                <p class="small font-weight-normal text-muted mb-0">Chairman and founder </p>
              </li>
              <li class="list-inline-item pl-4 border-left">
                <h5 class="mb-0">+132 724 4253 323  1</h5>
                <p class="small font-weight-normal text-muted mb-0">Call to ask any question</p>
              </li>
              
            </ul>
          </div>
          <div class="col-lg-5 ms-auto mb-4 mb-lg-0 order-1 order-lg-2">
            <div class="p-2 border"><img class="img-fluid" src="img/about-img.jpg" alt=""></div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Divider Section -->
    <section class="bg-cover bg-center" style="background: url(img/hero-banner-2.jpg)">
      <div class="primary-overlay py-5">
        <div class="overlay-content">
          <div class="container">
            <div class="row align-items-center gy-4">
              <div class="col-lg-7 text-center text-lg-start">
                <h2 class="text-white mb-2">Need help on purchased clothes?</h2>
                <p class="text-white mb-0">If you have any questions, comments, suggestions, or if you want to contact us, please contact us ASAP.</p>
              </div>
              <div class="col-lg-3 ms-auto text-center text-lg-end"><a class="btn btn-outline-light px-4" href="#!">Contact Us</a></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Testimonials Section-->
    <section class="py-5">
      <div class="container py-5">
        <p class="h6 mb-1 text-uppercase text-primary mb-3">Our customers say</p>
        <div class="row mb-5">
          <div class="col-lg-5">
            <h2 class="mb-5">The Best Quality Used Clothing You Can Find</h2>
          </div>
          <div class="col-lg-7">
            <p class="text-muted">Just what I was looking for. Man, this thing is getting better and better as I learn more about it. Thanks for the great service.</p>
          </div>
        </div>
        <div class="swiper testimonials-slider">
          <div class="swiper-wrapper">
            <div class="swiper-slide p-3">
              <div class="testimonial p-5 shadow-sm mb-5">
                <div class="d-flex align-items-center mb-4">
                  <div class="testimonial-img flex-shrink-0"><img class="img-fluid rounded-circle" src="img/person-1.jpg" alt=""></div>
                  <div class="ms-4">
                    <h5 class="mb-0">Rodel Colez</h5>
                    <p class="small text-muted mb-1">Businessman</p>
                    <ul class="small list-inline text-primary mb-0">
                      <li class="list-inline-item m-0"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 1"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 2"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 3"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 4"><i class="fas fa-star"></i></li>
                    </ul>
                  </div>
                </div>
                <p class="text-muted text-sm mb-0">Thanks Clothes! Clothes has got everything I need. I love your system. I wish I would have thought of it first.</p>
              </div>
            </div>
            <div class="swiper-slide p-3">
              <div class="testimonial p-5 shadow-sm mb-5">
                <div class="d-flex align-items-center mb-4">
                  <div class="testimonial-img flex-shrink-0"><img class="img-fluid rounded-circle" src="img/person-2.jpg" alt=""></div>
                  <div class="ms-4">
                    <h5 class="mb-0">Mark Huff</h5>
                    <p class="small text-muted mb-1">Businessman</p>
                    <ul class="small list-inline text-primary mb-0">
                      <li class="list-inline-item m-0"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 1"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 2"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 3"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 4"><i class="fas fa-star"></i></li>
                    </ul>
                  </div>
                </div>
                <p class="text-muted text-sm mb-0">Clothes is exactly what our business has been lacking. Clothes did exactly what you said it does. Definitely worth the investment.</p>
              </div>
            </div>
            <div class="swiper-slide p-3">
              <div class="testimonial p-5 shadow-sm mb-5">
                <div class="d-flex align-items-center mb-4">
                  <div class="testimonial-img flex-shrink-0"><img class="img-fluid rounded-circle" src="img/person-1.jpg" alt=""></div>
                  <div class="ms-4">
                    <h5 class="mb-0">Rodel Colez</h5>
                    <p class="small text-muted mb-1">Businessman</p>
                    <ul class="small list-inline text-primary mb-0">
                      <li class="list-inline-item m-0"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 1"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 2"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 3"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 4"><i class="fas fa-star"></i></li>
                    </ul>
                  </div>
                </div>
                <p class="text-muted text-sm mb-0">Thank you so much for your help. Clothes is the next killer app. If you aren't sure, always go for Clothes. I don't always clop, but when I do, it's because of Clothes.</p>
              </div>
            </div>
            <div class="swiper-slide p-3">
              <div class="testimonial p-5 shadow-sm mb-5">
                <div class="d-flex align-items-center mb-4">
                  <div class="testimonial-img flex-shrink-0"><img class="img-fluid rounded-circle" src="img/person-1.jpg" alt=""></div>
                  <div class="ms-4">
                    <h5 class="mb-0">Rodel Colez</h5>
                    <p class="small text-muted mb-1">Businessman</p>
                    <ul class="small list-inline text-primary mb-0">
                      <li class="list-inline-item m-0"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 1"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 2"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 3"><i class="fas fa-star"></i></li>
                      <li class="list-inline-item m-0 4"><i class="fas fa-star"></i></li>
                    </ul>
                  </div>
                </div>
                <p class="text-muted text-sm mb-0">The service was excellent. This is simply unbelievable! Thanks to Clothes, we've just launched our 5th website!</p>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>
    <div class="bg-primary py-5 text-white">
      <div class="container">
        <div class="row gy-4 justify-content-center">
          <div class="col-lg-3 col-md-6">
            <div class="d-flex align-items-center">
              <h6 class="h1 mb-0">305</h6>
              <p class="ms-3 flex-grow-1 text-uppercase mb-0">Clothes completed </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="d-flex align-items-center">
              <h6 class="h1 mb-0">809</h6>
              <p class="ms-3 flex-grow-1 text-uppercase mb-0">Satisfied customers </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="d-flex align-items-center">
              <h6 class="h1 mb-0">354</h6>
              <p class="ms-3 flex-grow-1 text-uppercase mb-0">Feedbacks provided </p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <?php require 'footer.html' ?>

    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/navbar-transition.js"></script>
    <script src="vendor/swiper/swiper-bundle.min.js"></script>
    <script src="vendor/modal-video/js/modal-video.js"></script>
    <script src="vendor/leaflet/leaflet.js"></script>
    <script src="js/front.js"></script>
    <script>
      // ------------------------------------------------------- //
      //   Inject SVG Sprite - 
      //   see more here 
      //   https://css-tricks.com/ajaxing-svg-sprite/
      // ------------------------------------------------------ //
      function injectSvgSprite(path) {
      
          var ajax = new XMLHttpRequest();
          ajax.open("GET", path, true);
          ajax.send();
          ajax.onload = function(e) {
          var div = document.createElement("div");
          div.className = 'd-none';
          div.innerHTML = ajax.responseText;
          document.body.insertBefore(div, document.body.childNodes[0]);
          }
      }
      
      // injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
    </script>

    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="js/navbar-transition.js"></script>
  </body>
</html>
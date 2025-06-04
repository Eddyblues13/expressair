<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express Air Delivery - To every direction</title>
    <meta property="og:image" content="img/cargo.jpg" />
    <meta property="og:image:url" content="img/cargo.jpg" />
    <meta property="og:image:secure_url" content="img/cargo.jpg" />

    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rubik:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="//code.tidio.co/rip3i2znrk2hidz2yms3d7oht10rheh5.js" async></script>

    <!-- 
    - preload images
  -->
</head>

<body id="top">



    <!-- 
    - #HEADER
  -->

    <header class="header" data-header>
        <div class="container">


            <h1>
                <a href="{{route('homepage')}}" class="logo"> <img src="./assets/images/logo.png" width="200"
                        height="300"></a>
            </h1>
            <div class="gtranslate_wrapper"></div>
            <script>
                window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"left","switcher_vertical_position":"top","alt_flags":{"en":"usa","pt":"brazil","es":"colombia","fr":"quebec"}}
            </script>
            <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>



            <nav class="navbar" data-navbar>

                <div class="navbar-top">
                    <a href="{{route('homepage')}}" class="logo"><img src="./assets/images/logo.png" width="200"
                            height="300"></a>

                    <button class="nav-close-btn" aria-label="Clsoe menu" data-nav-toggler>
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                </div>



                <ul class="navbar-list">

                    <li class="navbar-item">
                        <a href="{{route('homepage')}}" class="navbar-link" data-nav-link>
                            <span>Home</span>

                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </li>

                    <li class="navbar-item">
                        <a href="{{route('track')}}" class="navbar-link" data-nav-link>
                            <span>Track</span>

                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </li>

                    <li class="navbar-item">
                        <a href="{{route('about')}}" class="navbar-link" data-nav-link>
                            <span>About</span>

                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </li>

                    <li class="navbar-item">
                        <a href="{{route('services')}}" class="navbar-link" data-nav-link>
                            <span>Service</span>

                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </li>

                    <li class="navbar-item">
                        <a href="#blog" class="navbar-link" data-nav-link>
                            <span>Blog</span>

                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </li>

                    <li class="navbar-item">
                        <a href="{{route('contact')}}" class="navbar-link" data-nav-link>
                            <span>Contact</span>

                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </li>

                </ul>

            </nav>

            <button class="nav-open-btn" aria-label="Open menu" data-nav-toggler>
                <ion-icon name="menu-outline"></ion-icon>
            </button>

            <div class="overlay" data-nav-toggler data-overlay></div>

        </div>
    </header>
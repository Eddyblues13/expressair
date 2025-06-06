@include('home.header')





<main>
    <article>

        <!-- 
        - #HERO
      -->

        <section class="section hero" aria-label="home" id="home"
            style="background-image: url('./assets/images/hero-banner.jpg')">
            <div class="container">

                <div class="hero-content">

                    <h2 class="h1 hero-title">
                        <span class="span">DELIVERING </span> EXCELLENCE
                    </h2>

                    <p class="hero-text">
                        Deliver Fast International Cargo Services

                    </p>

                    <a href="{{route('track')}}" class="btn-outline">Track</a>

                    <img src="./assets/images/hero-shape.png" width="116" height="116" loading="lazy"
                        class="hero-shape shape-1">

                    <img src="./assets/images/hero-shape.png" width="116" height="116" loading="lazy"
                        class="hero-shape shape-2">

                </div>

            </div>
        </section>


        <section class="section newsletter" aria-label="newsletter">
            <div class="container">

                {{-- Error Message at the Top --}}
                @if (session('error'))
                <div
                    style="background-color: white; color: red; padding: 15px; border: 1px solid red; margin-bottom: 20px;">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" onclick="this.parentElement.style.display='none'"
                        style="float:right; border:none; background:none; font-size:16px; cursor:pointer;">&times;</button>
                </div>
                @endif

                {{-- Success Message --}}
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <b>Success!</b> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif (session('message'))
                <div class="alert alert-success" role="alert">
                    <b>Success!</b> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="newsletter-content">
                    <h2 class="h2 section-title">Enter Your Tracking Number</h2>
                    <form action="{{ route('package') }}" method="POST" class="newsletter-form">
                        @csrf
                        <input type="text" name="search" placeholder="Enter Your Tracking Number"
                            aria-label="Tracking Number" class="email-field">
                        <button type="submit" class="newsletter-btn">Track</button>
                    </form>
                </div>

            </div>
        </section>






        <section class="section about" id="about" aria-label="about">
            <div class="container">

                <figure class="about-banner img-holder" style="--width: 400; --height: 720;">
                    <img src="./assets/images/about-banner.jpg" width="400" height="720" loading="lazy" alt=""
                        class="img-cover">

                    <img src="./assets/images/about-shape-1.png" width="260" height="170" loading="lazy" alt=""
                        class="abs-img abs-img-1">

                    <img src="./assets/images/about-shape-2.png" width="500" height="500" loading="lazy" alt=""
                        class="abs-img abs-img-2">
                </figure>

                <div class="about-content">

                    <p class="section-subtitle">Why Choose Us</p>

                    <h2 class="h2 section-title">We Are Professional Logistics & cargo Agency</h2>

                    <p class="section-text">
                        Sed ut perspiciatis unde omnis iste natus error volup tatem accusantium dolorem que
                        laudantium, totam
                        inventore.
                    </p>

                    <ul class="about-list">

                        <li class="about-item">
                            <div class="about-icon">
                                <ion-icon name="chevron-forward"></ion-icon>
                            </div>

                            <p class="about-text">
                                Go beyond logistics, make the world go round and revolutionize business.
                            </p>
                        </li>

                        <li class="about-item">
                            <div class="about-icon">
                                <ion-icon name="chevron-forward"></ion-icon>
                            </div>

                            <p class="about-text">
                                Logistics through innovation, dedication, and technology. ready, set, done.
                            </p>
                        </li>

                        <li class="about-item">
                            <div class="about-icon">
                                <ion-icon name="chevron-forward"></ion-icon>
                            </div>

                            <p class="about-text">
                                We take pride in serving our customers safely. together with passion.
                            </p>
                        </li>

                        <li class="about-item">
                            <div class="about-icon">
                                <ion-icon name="chevron-forward"></ion-icon>
                            </div>

                            <p class="about-text">
                                Imagination what we can easily see is only a small percentage.
                            </p>
                        </li>

                        <li class="about-item">
                            <div class="about-icon">
                                <ion-icon name="chevron-forward"></ion-icon>
                            </div>

                            <p class="about-text">
                                Quality never goes out of style. safety, quality, professionalism.
                            </p>
                        </li>

                        <li class="about-item">
                            <div class="about-icon">
                                <ion-icon name="chevron-forward"></ion-icon>
                            </div>

                            <p class="about-text">
                                The quality shows in every move we make where business lives.
                            </p>
                        </li>

                    </ul>

                    <a href="{{route('about')}}" class="btn">Learn More</a>

                </div>

            </div>
        </section>





        <!-- 
        - #SERVICE
      -->

        <section class="section service" id="service" aria-label="service">
            <div class="container">

                <p class="section-subtitle">All Services</p>

                <h2 class="h2 section-title">Trusted For Our Services</h2>

                <p class="section-text">
                    We Are International Cargo Services.
                </p>

                <ul class="service-list grid-list">

                    <li>
                        <div class="service-card">

                            <div class="card-icon">
                                <img src="./assets/images/service-icon-1.png" width="80" height="60" loading="lazy"
                                    alt="Truck">
                            </div>

                            <h3 class="h3 card-title">
                                <span class="span">01</span> Air Freight
                            </h3>

                            <p class="card-text">
                                Safe Carriage of Baggages, all kinds anywhere in the world by our experience team of
                                Pilots. Our experienced pilots are always up to the task responding to your every
                                delivery needs to the far ends of the world
                            </p>

                        </div>
                    </li>

                    <li>
                        <div class="service-card">

                            <div class="card-icon">
                                <img src="./assets/images/service-icon-2.png" width="74" height="60" loading="lazy"
                                    alt="Ship">
                            </div>

                            <h3 class="h3 card-title">
                                <span class="span">02</span> Road Freight
                            </h3>

                            <p class="card-text">
                                The word cargo refers in particular to goods or produce being conveyed generally for
                                commercial gain by ship, boat, or aircraft, although the term is now often extended to
                                cover all types of freight, including that carried by train, van, truck, or container.
                            </p>



                        </div>
                    </li>

                    <li>
                        <div class="service-card">

                            <div class="card-icon">
                                <img src="./assets/images/service-icon-3.png" width="60" height="60" loading="lazy"
                                    alt="Airplane">
                            </div>

                            <h3 class="h3 card-title">
                                <span class="span">03</span> Ocean Freight
                            </h3>

                            <p class="card-text">
                                Reliable and fantastic cargo carriers that sail around the world delivering on the go.
                                We boast of a robust collection of excellent working sea carriers. The ocean pathways
                                are well know to our reputable sailors who are years ahead with experience.
                            </p>

                        </div>
                    </li>

                    <li>
                        <div class="service-card">

                            <div class="card-icon">
                                <img src="./assets/images/service-icon-4.png" width="50" height="60" loading="lazy"
                                    alt="Train">
                            </div>

                            <h3 class="h3 card-title">
                                <span class="span">04</span> Rail Freight
                            </h3>

                            <p class="card-text">
                                Our aim is to optimize and improve your supply chain so that we can give you the
                                best service.
                            </p>

                        </div>
                    </li>

                    <li>
                        <div class="service-card">

                            <div class="card-icon">
                                <img src="./assets/images/service-icon-5.png" width="63" height="60" loading="lazy"
                                    alt="Trolley">
                            </div>

                            <h3 class="h3 card-title">
                                <span class="span">05</span> Warehousing
                            </h3>

                            <p class="card-text">
                                Get all meta data and real time information about your shipment. We provide top notch
                                management reporting
                            </p>


                        </div>
                    </li>

                    <li>
                        <div class="service-card">

                            <div class="card-icon">
                                <img src="./assets/images/service-icon-6.png" width="46" height="60" loading="lazy"
                                    alt="Paper">
                            </div>

                            <h3 class="h3 card-title">
                                <span class="span">06</span> Project Cargo
                            </h3>

                            <p class="card-text">
                                Having been in the business with vast experience, we are careful to conform and comply
                                with every rule there is to carriers. This keeps your shipment safer.
                            </p>

                        </div>
                    </li>

                </ul>

            </div>
        </section>





        <!-- 
        - #FEATURE
      -->

        <section class="section feature" aria-label="feature">
            <div class="container">

                <div class="title-wrapper">

                    <div>
                        <p class="section-subtitle">Estimation</p>

                        <h2 class="h2 section-title">Has a wide range of solutions</h2>

                        <p class="section-text">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard
                            dummy text ever
                            since the when an
                            printer took.
                        </p>
                    </div>

                    <a href="#" class="btn">Read More</a>

                </div>

                <ul class="feature-list grid-list">

                    <li>
                        <div class="feature-card" style="--card-number: '01'">

                            <div class="card-icon">
                                <img src="./assets/images/feature-icon-1.png" width="72" height="91" alt="">
                            </div>

                            <h3 class="h3 card-title">Solutions and specialized</h3>

                            <p class="card-text">
                                Our aim is to optimize and improve your supply chain so that we can give you the
                                best service
                            </p>

                            <a href="#" class="card-btn" aria-label="Read more">
                                <ion-icon name="arrow-forward"></ion-icon>
                            </a>

                        </div>
                    </li>

                    <li>
                        <div class="feature-card" style="--card-number: '02'">

                            <div class="card-icon">
                                <img src="./assets/images/feature-icon-2.png" width="94" height="94" alt="">
                            </div>

                            <h3 class="h3 card-title">Multiple warehouses</h3>

                            <p class="card-text">
                                We provide multiple drop off and pickup locations so you don't have to worry. And
                                you should not face
                                any kind...
                            </p>

                            <a href="#" class="card-btn" aria-label="Read more">
                                <ion-icon name="arrow-forward"></ion-icon>
                            </a>

                        </div>
                    </li>

                    <li>
                        <div class="feature-card" style="--card-number: '03'">

                            <div class="card-icon">
                                <img src="./assets/images/feature-icon-3.png" width="93" height="93" alt="">
                            </div>

                            <h3 class="h3 card-title">Tracking made easy</h3>

                            <p class="card-text">
                                A tracking number for the entire process. so that you can find the exact position.
                                this process will
                                help you
                            </p>

                            <a href="#" class="card-btn" aria-label="Read more">
                                <ion-icon name="arrow-forward"></ion-icon>
                            </a>

                        </div>
                    </li>

                </ul>

            </div>
        </section>





        <!-- 
        - #PROJECT
      -->

        <section class="section project" aria-label="project">
            <div class="container">

                <p class="section-subtitle">Projects</p>

                <h2 class="h2 section-title">Featured Projects</h2>

                <p class="section-text">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy
                    text ever since
                    the when an
                    printer took.
                </p>

                <ul class="project-list">

                    <li class="project-item">
                        <div class="project-card">

                            <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                                <img src="./assets/images/project-1.jpg" width="397" height="352" loading="lazy"
                                    alt="Warehouse inventory" class="img-cover">
                            </figure>

                            <button class="action-btn" aria-label="View image">
                                <ion-icon name="expand-outline"></ion-icon>
                            </button>

                            <div class="card-content">
                                <p class="card-tag">Warehousing , Distrbution</p>

                                <h3 class="h3">
                                    <a href="#" class="card-title">Warehouse inventory</a>
                                </h3>

                                <a href="#" class="card-link">Read More</a>
                            </div>

                        </div>
                    </li>

                    <li class="project-item">
                        <div class="project-card">

                            <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                                <img src="./assets/images/project-2.jpg" width="397" height="352" loading="lazy"
                                    alt="Warehouse inventory" class="img-cover">
                            </figure>

                            <button class="action-btn" aria-label="View image">
                                <ion-icon name="expand-outline"></ion-icon>
                            </button>

                            <div class="card-content">
                                <p class="card-tag">Logistics, Analytics</p>

                                <h3 class="h3">
                                    <a href="#" class="card-title">Minimize Manufacturing</a>
                                </h3>

                                <a href="#" class="card-link">Read More</a>
                            </div>

                        </div>
                    </li>

                    <li class="project-item">
                        <div class="project-card">

                            <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                                <img src="./assets/images/project-3.jpg" width="397" height="352" loading="lazy"
                                    alt="Warehouse inventory" class="img-cover">
                            </figure>

                            <button class="action-btn" aria-label="View image">
                                <ion-icon name="expand-outline"></ion-icon>
                            </button>

                            <div class="card-content">
                                <p class="card-tag">Warehousing , Distrbution</p>

                                <h3 class="h3">
                                    <a href="#" class="card-title">Warehouse inventory</a>
                                </h3>

                                <a href="#" class="card-link">Read More</a>
                            </div>

                        </div>
                    </li>

                    <li class="project-item">
                        <div class="project-card">

                            <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                                <img src="./assets/images/project-4.jpg" width="397" height="352" loading="lazy"
                                    alt="Warehouse inventory" class="img-cover">
                            </figure>

                            <button class="action-btn" aria-label="View image">
                                <ion-icon name="expand-outline"></ion-icon>
                            </button>

                            <div class="card-content">
                                <p class="card-tag">Logistics, Analytics</p>

                                <h3 class="h3">
                                    <a href="#" class="card-title">Minimize Manufacturing</a>
                                </h3>

                                <a href="#" class="card-link">Read More</a>
                            </div>

                        </div>
                    </li>

                    <li class="project-item">
                        <div class="project-card">

                            <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                                <img src="./assets/images/project-5.jpg" width="397" height="352" loading="lazy"
                                    alt="Warehouse inventory" class="img-cover">
                            </figure>

                            <button class="action-btn" aria-label="View image">
                                <ion-icon name="expand-outline"></ion-icon>
                            </button>

                            <div class="card-content">
                                <p class="card-tag">Warehousing , Distrbution</p>

                                <h3 class="h3">
                                    <a href="#" class="card-title">Warehouse inventory</a>
                                </h3>

                                <a href="#" class="card-link">Read More</a>
                            </div>

                        </div>
                    </li>

                    <li class="project-item">
                        <div class="project-card">

                            <figure class="card-banner img-holder" style="--width: 397; --height: 352;">
                                <img src="./assets/images/project-6.jpg" width="397" height="352" loading="lazy"
                                    alt="Warehouse inventory" class="img-cover">
                            </figure>

                            <button class="action-btn" aria-label="View image">
                                <ion-icon name="expand-outline"></ion-icon>
                            </button>

                            <div class="card-content">
                                <p class="card-tag">Logistics, Analytics</p>

                                <h3 class="h3">
                                    <a href="#" class="card-title">Minimize Manufacturing</a>
                                </h3>

                                <a href="#" class="card-link">Read More</a>
                            </div>

                        </div>
                    </li>

                </ul>

            </div>
        </section>





        <!-- 
        - #BLOG
      -->

        <section class="section blog" aria-label="blog" id="blog">
            <div class="container">

                <p class="section-subtitle">Our Blogs</p>

                <h2 class="h2 section-title">Recent news & events</h2>

                <p class="section-text">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy
                    text ever since
                    the when an
                    printer took.
                </p>

                <ul class="blog-list grid-list">

                    <li>
                        <div class="blog-card">

                            <figure class="card-banner img-holder" style="--width: 770; --height: 500;">
                                <img src="./assets/images/blog-1.jpg" width="770" height="500" loading="lazy"
                                    alt="At the end of the day, going forward, a new normal that has evolved from. your only logistic partner."
                                    class="img-cover">
                            </figure>

                            <div class="card-content">

                                <time class="card-meta" datetime="2022-08-02">
                                    <span class="span">02</span> Aug
                                </time>

                                <h3 class="h3 card-title">
                                    <a href="#">
                                        At the end of the day, going forward, a new normal that has evolved from.
                                        your only logistic
                                        partner.
                                    </a>
                                </h3>

                                <p class="card-text">
                                    New chip traps clusters of migrating tumor cells asperiortenetur, blanditiis
                                    odit. typesetting
                                    industry the standard
                                    dummy text ever since the when an printer.
                                </p>

                                <a href="#" class="btn-link">
                                    <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

                                    <span class="span">Read More</span>
                                </a>

                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="blog-card">

                            <figure class="card-banner img-holder" style="--width: 770; --height: 500;">
                                <img src="./assets/images/blog-2.jpg" width="770" height="500" loading="lazy"
                                    alt="Going forward, a new normal that has evolved from generation. moving your products across all borders."
                                    class="img-cover">
                            </figure>

                            <div class="card-content">

                                <time class="card-meta" datetime="2022-08-21">
                                    <span class="span">21</span> Aug
                                </time>

                                <h3 class="h3 card-title">
                                    <a href="#">
                                        Going forward, a new normal that has evolved from generation. moving your
                                        products across all
                                        borders.
                                    </a>
                                </h3>

                                <p class="card-text">
                                    New chip traps clusters of migrating tumor cells asperiortenetur, blanditiis
                                    odit. typesetting
                                    industry the standard
                                    dummy text ever since the when an printer.
                                </p>

                                <a href="#" class="btn-link">
                                    <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

                                    <span class="span">Read More</span>
                                </a>

                            </div>

                        </div>
                    </li>

                </ul>

            </div>
        </section>





        <!-- 
        - #NEWSLETTER
      -->

    </article>
</main>





@include('home.footer')
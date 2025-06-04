@include('home.header')

<style>
    /* Style inputs */
    input[type=text],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }




    /* Create two columns that float next to eachother */
    .column {
        float: left;
        width: 50%;
        margin-top: 6px;
        padding: 20px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

        .column,
        input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
    }
</style>
<main>
    <article>










        <section class="section hero" aria-label="home" id="home"
            style="background-image: url('./assets/images/contact.jpg')">
            <div class="container">

                <div class="hero-content">

                    <h2 class="h1 hero-title">
                        <span class="span">About </span>Us
                    </h2>
                    <img src="./assets/images/hero-shape.png" width="116" height="116" loading="lazy"
                        class="hero-shape shape-1">

                    <img src="./assets/images/hero-shape.png" width="116" height="116" loading="lazy"
                        class="hero-shape shape-2">

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

                </div>

            </div>
        </section>
    </article>
</main>
@include('home.footer')
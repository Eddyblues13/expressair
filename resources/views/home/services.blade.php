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
            style="background-image: url('./assets/images/services.jpg')">
            <div class="container">

                <div class="hero-content">

                    <h2 class="h1 hero-title">
                        <span class="span">Services </span>
                    </h2>
                    <img src="./assets/images/hero-shape.png" width="116" height="116" loading="lazy"
                        class="hero-shape shape-1">

                    <img src="./assets/images/hero-shape.png" width="116" height="116" loading="lazy"
                        class="hero-shape shape-2">

                </div>

            </div>
        </section>

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



    </article>
</main>
@include('home.footer')
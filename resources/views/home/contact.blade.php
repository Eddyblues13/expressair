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
                        <span class="span">Contact </span>Us
                    </h2>
                    <img src="./assets/images/hero-shape.png" width="116" height="116" loading="lazy"
                        class="hero-shape shape-1">

                    <img src="./assets/images/hero-shape.png" width="116" height="116" loading="lazy"
                        class="hero-shape shape-2">

                </div>

            </div>
        </section>


        <section class="section" aria-label="newsletter">
            <div class="container">


                <div style="text-align:center">
                    <h2>Contact Us</h2>

                </div>
                <div class="row">
                    <div class="column">
                        <img src="/assets/images/contact.jpg" style="width:100%">
                    </div>
                    <div class="column">
                        <form action="/action_page.php">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="firstname" class="email-field"
                                placeholder="Your name..">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lastname" class="email-field"
                                placeholder="Your last name..">
                            <label for="lname">Subject</label>
                            <input type="text" id="lname" name="lastname" class="email-field" placeholder="Subject.">
                            <label for="subject">Message</label>
                            <textarea id="subject" name="message" class="email-field" placeholder="Write something.."
                                style="height:170px"></textarea>
                            <input type="submit" class="newsletter-btn" value="Submit">
                        </form>
                    </div>
                </div>


            </div>
        </section>
    </article>
</main>
@include('home.footer')
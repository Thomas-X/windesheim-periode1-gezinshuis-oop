<div class="container-fluid">
    <div id="ownCourasel" class="slider" >
        <div id="arrow-left" class="arrow">
            <i class="fas fa-angle-left"></i>
        </div>
        <div id="img">
            <div class="slide">
                <div class="wrap">
                    <div class="container">
                        <div id="speechBlue" class="speech">
                            <h4>Warm huis</h4>
                            <p>Lorum ipsum kinderen moeten ook diploma halen enzo is goed voor brain en is relevant enzo. Door het schrijven
                                van deze tekst met daarin woorden als enzo maakt deze hele tekst heel professioneel. </p>
                        </div>
                    </div>
                </div>
                <img src="imgs/happy-child.jpg" alt="blije kind" />
            </div>
            <div class="slide">
                <div class="wrap">
                    <div class="container">
                        <div class="speech">
                            <h4>Diploma gehaald</h4>
                            <p>Lorum ipsum kinderen moeten ook diploma halen enzo is goed voor brain en is relevant enzo. Door het schrijven
                                van deze tekst met daarin woorden als enzo maakt deze hele tekst heel professioneel. </p>
                        </div>
                    </div>
                </div>
                <img src="imgs/huis.jpg" alt="blije kind" />
            </div>
            <div class="slide">
                <div class="wrap">
                    <div class="container">
                        <div class="speech">
                            <h4>Dagje uit</h4>
                            <p>Lorum ipsum kinderen moeten ook diploma halen enzo is goed voor brain en is relevant enzo. Door het schrijven
                                van deze tekst met daarin woorden als enzo maakt deze hele tekst heel professioneel. </p>
                        </div>
                    </div>
                </div>
                <img src="imgs/efteling.jpg" alt="blije kind" />
            </div>
        </div>
        <div id="arrow-right" class="arrow">
            <i class="fas fa-angle-right"></i>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm12 mb-4">
            <div class="card ownCard">
                <img class="card-img-top" src="imgs/meisjesinraam.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" >over ons</h5>
                    <p class="card-text">Liefde voor de mens. Ontdekt wat voor organisatie wij zijn.  </p>
                    <div class="a-wrap">
                        <a href="about" class="btn btn-primary a-btn-default" >lees meer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm12 mb-4">
            <div class="card ownCard">
                <img class="card-img-top" src="imgs/evenement.jpg" alt="Card image cap">
                <div class="card-body" style="border-bottom-color: #4CCFAC;">
                    <h5 class="card-title" style="color: #4CCFAC; " >evenementen</h5>
                    <p class="card-text">Af en toe doen we leuke evenementen met onze kinderen. Zo nu en dan gaan wij een dagje uit. Ervaar met ons mee wat wij beleven. </p>
                    <div id="a-wrap-grey" class="a-wrap">
                        <a href="evenement" class="btn btn-primary a-btn-default">ontdekt meer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm12 mb-4">
            <div class="card ownCard">
                <img class="card-img-top" src="imgs/contact.jpg" alt="Card image cap">
                <div class="card-body"  style="border-bottom-color: #a0c041">
                    <h5 class="card-title" style="color: #b2cf5d;">contact</h5>
                    <p class="card-text">Neem contact met ons op en ontdekt wat voor mogelijkheden wij u te bieden heeft.</p>
                    <div id="a-wrap-green" class="a-wrap">
                        <a href="contact" class="btn btn-primary a-btn-default">neem contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid welcome-wrap mb-5 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 left-welcome text-center">
                <span style="font-size: 20px">Welkom op gezinshuis regterink</span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 right-welcome">
                <p> Af en toe doen we leuke evenementen met onze kinderen. Zo nu en dan gaan wij een dagje uit. Ervaar met ons mee wat w
                    Af en toe doen we leuke evenementen met onze kinderen. Zo nu en dan gaan wij een dagje uit. Ervaar met ons mee wat w
                    Af en toe doen we leuke evenementen met onze kinderen. Zo nu en dan gaan wij een dagje uit. Ervaar met ons mee wat w</p>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row m-5">
        <div class="event-header text-center w-100 pt-5">
            <h3>evenementen bij regtering</h3>
        </div>
    </div>
    <div class="row mt-5">
        <?php foreach ($events as $key => $event): ?>
            <div class="col-lg-4 col-md-4 col-sm-6 mt-5 mb-5">
                <div class="blog-card">
                    <div class="blog-body">
                        <div class="img-wrap">
                            <img src="imgs/event/event<?= ($key + 1) ?>.jpg"/>
                            <div class="date-wrap">
                                <div class="date-text">
                                    <div class="date-num">
                                        <span><?= substr($event['date_event'], 8, 9)  ?></span>
                                        <span><?php
                                                    $d = date_parse_from_format("Y-m-d", $event["date_event"]);
                                                    echo $month[$d["month"]];
                                                    ?>
                                        </span>
                                    </div>
                                    <span class="day">
                                        <?php
                                            $day = date('N', strtotime($event["date_event"]));
                                            echo $days[$day - 1];
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-name">
                            <div class="blog-name-wrap">
                                <div class="name-button text-center">
                                    <p><?= $event['eventname'] ?></p>
                                    <a href="#" class="btn btn-primary a-btn-default unique-btn">naar evenement</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<script src="js/home.js"></script>
<script src="js/events.js"></script>
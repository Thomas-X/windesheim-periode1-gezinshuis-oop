<div class="container-fluid bg-light p-0">

    <div id="map" style="height: 400px;width: 100%;"></div>
    <div class="container " style="position: relative; top: -100px;">
        <div class="row bg-white wrapper m-0 p-3">
            <div class="col-lg-7 col-md-7 col-sm-12 mb-4">
                <h3 class="title">Neem contact op</h3>
                <form class="mt-3">
                    <div class="form-group ">
                        <div class="input-group mb-5">
                            <div class="input-group-prepend">
                                <div class="input-group-text icon-form"><i class="fas fa-user"></i></div>
                            </div>
                            <select class="form-control ownInput " id="exampleSelect1">
                                <option selected disabled>Aanhef</option>
                                <option>Heer</option>
                                <option>Mevrouw</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="input-group mb-5">
                            <div class="input-group-prepend">
                                <div class="input-group-text icon-form"><i class="fas fa-user"></i></div>
                            </div>
                            <input type="text" name="name" class="form-control ownInput" placeholder="Voornaam">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="input-group mb-5">
                            <div class="input-group-prepend">
                                 <div class="input-group-text icon-form"><i class="fas fa-user"></i></div>
                            </div>
                            <input type="text" name="lastName" class="form-control ownInput" placeholder="Achternaam">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="input-group mb-5">
                            <div class="input-group-prepend">
                                <div class="input-group-text icon-form"><i class="fas fa-phone"></i></div>
                            </div>
                            <input type="text" name="phone" class="form-control ownInput" placeholder="Telefoonnummer">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="input-group mb-5">
                            <div class="input-group-prepend">
                                <div class="input-group-text icon-form"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" name="email" class="form-control ownInput" placeholder="Email address">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="input-group mb-4">
                            <textarea class="form-control ownInput border-grey" id="description" rows="3" placeholder="Vraag of opmerking"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success house-btn w-100 mb-4">Versturen</button>
                </form>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h3 class="title mb-4">Adresgegevens</h3>
                <div class="d-flex flex-column  contactBox" id="purple">
                    <p><b>Hoofdkantoor gezinshuis: </b></p>
                    <span>Windesheim 1</span>
                    <span>8232 AF, Almere</span>
                </div>
                <div class="d-flex flex-column  contactBox mt-4" id="yellow">
                    <p><b> Voor vragen bel:</b></p>
                    <p> <i class="fas fa-phone" style="color: white;"></i> 0320 6584526  </p>

                </div>
                <div class="d-flex flex-column mt-4 p-2" id="social">
                    <p class="m-0"><b> Volg ons op social media:</b>
                        <a class="social-link" href=""><i class="fab fa-twitter"></i></a>
                        <a class="social-link" href=""><i class="fab fa-facebook-f"></i></a>
<!--                        <a class="social-link" href=""><i class="fab fa-linkedin-in"></i></a>-->
                    </p>

                </div>
            </div>
        </div>

    </div>

</div>
<script>
    // Initialize and add the map
    function initMap() {

        // The location of the place
        var myLatLng = {lat: 52.370387, lng: 5.221969};
        // The map, centered at place
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 16, center: myLatLng});
        // The marker, positioned at mylan
        var marker = new google.maps.Marker({position: myLatLng, map: map});
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHFjsKf5IGRxLdVvQaaFGjNyHzSZv6znc&callback=initMap">
</script>

<script src="public/js/contact.js"></script>
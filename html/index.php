<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/assets/assets.php';
require_once ASSETS_DIR . '/index/addAddress.php';
require_once PARTIALS_DIR . '/header.php';
require_once PARTIALS_DIR . '/alerts.php';

?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header addBold">Add Address</div>
            <div id="addSuggestInterchangeFilePanelBody" class="card-body">
                <form id="originalAddressForm">
                    <div class="form-group">
                        <label for="addressOne">Address 1</label>
                        <input type="text" class="form-control" id="addressOne" name="addressOne" aria-describedby="addressOneMessage" placeholder="Street Number, P.O Box" required>
                        <label id="addressOneMessage" class="form-text text-danger inputMessage"></label>
                    </div>
                    <div class="form-group">
                        <label for="addressTwo">Address 2</label>
                        <input type="text" class="form-control" id="addressTwo" name="addressTwo" aria-describedby="addressTwoMessage" placeholder="Apartment, Suite, Unit">
                        <label id="addressTwoMessage" class="form-text text-danger inputMessage"></label>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" aria-describedby="cityMessage" placeholder="City" required>
                            <label id="cityMessage" class="form-text text-danger inputMessage"></label>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <select class="form-control" id="state" name="state" aria-describedby="stateMessage">
                                <option value="" selected>Select State</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select required>
                            <label id="stateMessage" class="form-text text-danger inputMessage"></label>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip" aria-describedby="zipMessage" placeholder="Zip Code" required>
                            <label id="zipMessage" class="form-text text-danger inputMessage"></label>
                        </div>
                    </div>

                    <button type="button" id="validateAddress" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="selectAddressModal" tabindex="-1" role="dialog" aria-labelledby="selectAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectAddressModalLabel">Verify Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="addressFoundForm" class="col-12 col-md-6" method="POST">
                            <h6 id="addressFoundMessage">Address Found:</h6>
                            <div id="fullAddressUsps"></div>
                            <input type="hidden" id="addressOneUsps" name="addressOneFinal" value="">
                            <input type="hidden" id="addressTwoUsps" name="addressTwoFinal" value="">
                            <input type="hidden" id="cityUsps" name="cityFinal" value="">
                            <input type="hidden" id="stateUsps" name="stateFinal" value="">
                            <input type="hidden" id="zipUsps" name="zipFinal" value="">
                            <input type="submit" id="addressFoundSubmit" class="btn btn-primary mt-3" value="Add USPS">
                        </form>
                        <form class="col-12 col-md-6 border-left" method="POST">
                            <h6>Typed Address:</h6>
                            <div id="fullAddressOriginal"></div>
                            <input type="hidden" id="addressOneOriginal" name="addressOneFinal" value="">
                            <input type="hidden" id="addressTwoOriginal" name="addressTwoFinal" value="">
                            <input type="hidden" id="cityOriginal" name="cityFinal" value="">
                            <input type="hidden" id="stateOriginal" name="stateFinal" value="">
                            <input type="hidden" id="zipOriginal" name="zipFinal" value="">
                            <input type="submit" class="btn btn-primary mt-3" value="Add Original">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <script src="/assets/js/common.min.js"></script>
  <script src="/assets/js/index/main.js"></script>

<?php require_once PARTIALS_DIR . '/footer.php'; ?>
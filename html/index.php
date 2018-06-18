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
                        <input type="text" class="form-control" id="addressOne" name="addressOne" aria-describedby="addressOneMessage" placeholder="Street Number, P.O Box" value="<?php echo isset($_POST['addressOneFinal']) ? $_POST['addressOneFinal'] : null; ?>" required>
                        <label id="addressOneMessage" class="form-text text-danger inputMessage"></label>
                    </div>
                    <div class="form-group">
                        <label for="addressTwo">Address 2</label>
                        <input type="text" class="form-control" id="addressTwo" name="addressTwo" aria-describedby="addressTwoMessage" placeholder="Apartment, Suite, Unit" value="<?php echo isset($_POST['addressTwoFinal']) ? $_POST['addressTwoFinal'] : null; ?>">
                        <label id="addressTwoMessage" class="form-text text-danger inputMessage"></label>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" aria-describedby="cityMessage" placeholder="City" value="<?php echo isset($_POST['cityFinal']) ? $_POST['cityFinal'] : null; ?>" required>
                            <label id="cityMessage" class="form-text text-danger inputMessage"></label>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <select class="form-control" id="state" name="state" aria-describedby="stateMessage">
                                <option value="" <?php echo !isset($_POST['stateFinal']) || $_POST['stateFinal'] === "" ? 'selected' : ''; ?>>Select State</option>
                                <option value="AL" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "AL" ? 'selected' : ''; ?>>Alabama</option>
                                <option value="AK" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "AK" ? 'selected' : ''; ?>>Alaska</option>
                                <option value="AZ" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "AZ" ? 'selected' : ''; ?>>Arizona</option>
                                <option value="AR" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "AR" ? 'selected' : ''; ?>>Arkansas</option>
                                <option value="CA" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "CA" ? 'selected' : ''; ?>>California</option>
                                <option value="CO" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "CO" ? 'selected' : ''; ?>>Colorado</option>
                                <option value="CT" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "CT" ? 'selected' : ''; ?>>Connecticut</option>
                                <option value="DE" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "DE" ? 'selected' : ''; ?>>Delaware</option>
                                <option value="DC" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "DC" ? 'selected' : ''; ?>>District Of Columbia</option>
                                <option value="FL" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "FL" ? 'selected' : ''; ?>>Florida</option>
                                <option value="GA" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "GA" ? 'selected' : ''; ?>>Georgia</option>
                                <option value="HI" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "HI" ? 'selected' : ''; ?>>Hawaii</option>
                                <option value="ID" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "ID" ? 'selected' : ''; ?>>Idaho</option>
                                <option value="IL" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "IL" ? 'selected' : ''; ?>>Illinois</option>
                                <option value="IN" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "IN" ? 'selected' : ''; ?>>Indiana</option>
                                <option value="IA" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "IA" ? 'selected' : ''; ?>>Iowa</option>
                                <option value="KS" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "KS" ? 'selected' : ''; ?>>Kansas</option>
                                <option value="KY" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "KY" ? 'selected' : ''; ?>>Kentucky</option>
                                <option value="LA" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "LA" ? 'selected' : ''; ?>>Louisiana</option>
                                <option value="ME" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "ME" ? 'selected' : ''; ?>>Maine</option>
                                <option value="MD" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "MD" ? 'selected' : ''; ?>>Maryland</option>
                                <option value="MA" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "MA" ? 'selected' : ''; ?>>Massachusetts</option>
                                <option value="MI" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "MI" ? 'selected' : ''; ?>>Michigan</option>
                                <option value="MN" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "MN" ? 'selected' : ''; ?>>Minnesota</option>
                                <option value="MS" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "MS" ? 'selected' : ''; ?>>Mississippi</option>
                                <option value="MO" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "MO" ? 'selected' : ''; ?>>Missouri</option>
                                <option value="MT" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "MT" ? 'selected' : ''; ?>>Montana</option>
                                <option value="NE" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "NE" ? 'selected' : ''; ?>>Nebraska</option>
                                <option value="NV" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "NV" ? 'selected' : ''; ?>>Nevada</option>
                                <option value="NH" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "NH" ? 'selected' : ''; ?>>New Hampshire</option>
                                <option value="NJ" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "NJ" ? 'selected' : ''; ?>>New Jersey</option>
                                <option value="NM" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "NM" ? 'selected' : ''; ?>>New Mexico</option>
                                <option value="NY" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "NY" ? 'selected' : ''; ?>>New York</option>
                                <option value="NC" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "NC" ? 'selected' : ''; ?>>North Carolina</option>
                                <option value="ND" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "ND" ? 'selected' : ''; ?>>North Dakota</option>
                                <option value="OH" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "OH" ? 'selected' : ''; ?>>Ohio</option>
                                <option value="OK" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "OK" ? 'selected' : ''; ?>>Oklahoma</option>
                                <option value="OR" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "OR" ? 'selected' : ''; ?>>Oregon</option>
                                <option value="PA" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "PA" ? 'selected' : ''; ?>>Pennsylvania</option>
                                <option value="RI" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "RI" ? 'selected' : ''; ?>>Rhode Island</option>
                                <option value="SC" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "SC" ? 'selected' : ''; ?>>South Carolina</option>
                                <option value="SD" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "SD" ? 'selected' : ''; ?>>South Dakota</option>
                                <option value="TN" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "TN" ? 'selected' : ''; ?>>Tennessee</option>
                                <option value="TX" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "TX" ? 'selected' : ''; ?>>Texas</option>
                                <option value="UT" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "UT" ? 'selected' : ''; ?>>Utah</option>
                                <option value="VT" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "VT" ? 'selected' : ''; ?>>Vermont</option>
                                <option value="VA" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "VA" ? 'selected' : ''; ?>>Virginia</option>
                                <option value="WA" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "WA" ? 'selected' : ''; ?>>Washington</option>
                                <option value="WV" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "WV" ? 'selected' : ''; ?>>West Virginia</option>
                                <option value="WI" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "WI" ? 'selected' : ''; ?>>Wisconsin</option>
                                <option value="WY" <?php echo isset($_POST['stateFinal']) && $_POST['stateFinal'] === "WY" ? 'selected' : ''; ?>>Wyoming</option>
                            </select required>
                            <label id="stateMessage" class="form-text text-danger inputMessage"></label>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip" aria-describedby="zipMessage" placeholder="Zip Code"  value="<?php echo isset($_POST['zipFinal']) ? $_POST['zipFinal'] : null; ?>" required>
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
                        <hr class="col-12 d-md-none p-0">
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
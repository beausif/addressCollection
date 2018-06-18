$(function () {

    $('#validateAddress').on('click', validateAddress);

    /**
     * Clean and validate provided address data
     * Return USPS formatted address
     */
    function validateAddress() {
        resetErrors();
        trimElements($('#addressOne, #addressTwo, #city, #state, #zip'));
        if(!checkValidation($('#addressOne, #city, #state, #zip'))){
            return;
        }

        $.ajax({
            url: '/assets/php/validateAddress.php',
            method: 'POST',
            data: $('#originalAddressForm').serialize(),
            dataType: 'JSON'
        })
            .done(handleValidateAddress);
    }

    /**
     * Set error for each invalid element
     * Set modal data to allow user to choose final address
     * Show modal
     *
     * @param data
     */
    function handleValidateAddress(data){
        if(data.success === false){
            if(data.hasOwnProperty('invalidElements')){
                $.each(data.invalidElements, function(key,value){
                    $(value.element).addClass('is-invalid')
                        .next().text(value.message);
                });
                return;
            }
        }

        if(data.hasOwnProperty('address') && data.address.hasOwnProperty('Address')){
            setUspsAddressInModal(data.address.Address);
        } else {
            $('#addressFoundMessage').text('No USPS Address Found');
            $('#addressFoundSubmit').prop('disabled', true).hide();
        }

        setOriginalAddressInModal();

        $('#selectAddressModal').modal('show');
    }

    /**
     * Reset form errors
     */
    function resetErrors(){
        $('.is-invalid').removeClass('is-invalid');
        $('.inputMessage').text('');
    }

    /**
     * Trim passed in elements
     *
     * @param $elements
     */
    function trimElements($elements){
        $.each($elements, function(key, element){
            $(element).val($.trim($(element).val()));
        });
    }

    /**
     * Validate that each element is not empty
     *
     * @param $elements
     * @returns {boolean}
     */
    function checkValidation($elements){
        var validForm = true;
        $.each($elements, function(key, element){
            if($(element).val().length === 0){
                $(element).addClass('is-invalid')
                    .next().text('Required Field');
                validForm = false;
            }
        });
        return validForm;
    }

    /**
     * Sets USPS address data in modal form
     *
     * @param Address
     */
    function setUspsAddressInModal(Address){
        $addressOne = Address.hasOwnProperty('Address2') ? Address.Address2 : '';
        $addressTwo = Address.hasOwnProperty('Address1') ? Address.Address1 : '';
        $city = Address.hasOwnProperty('City') ? Address.City : '';
        $state = Address.hasOwnProperty('State') ? Address.State : '';
        $zip5 = Address.hasOwnProperty('Zip5') ? Address.Zip5 : '';
        $zip4 = Address.hasOwnProperty('Zip4') && Address.Zip4 !== Object(Address.Zip4) ? Address.Zip4 : '';
        $zip = $zip4 !== '' ? $zip5 + '-' + $zip4 : $zip5;

        $('#fullAddressUsps').html(
            buildAddressString($addressOne, $addressTwo, $city, $state, $zip)
        );

        $('#addressOneUsps').val($addressOne);
        $('#addressTwoUsps').val($addressTwo);
        $('#cityUsps').val($city);
        $('#stateUsps').val($state);
        $('#zipUsps').val($zip);
    }

    /**
     * Sets user provided address data in modal form
     */
    function setOriginalAddressInModal(){
        $addressOne = $('#addressOne').val();
        $addressTwo = $('#addressTwo').val();
        $city = $('#city').val();
        $state = $('#state').val();
        $zip = $('#zip').val();

        $('#fullAddressOriginal').html(
            buildAddressString($addressOne, $addressTwo, $city, $state, $zip)
        );

        $('#addressOneOriginal').val($addressOne);
        $('#addressTwoOriginal').val($addressTwo);
        $('#cityOriginal').val($city);
        $('#stateOriginal').val($state);
        $('#zipOriginal').val($zip);
    }

    /**
     * Returns the address as a single html formatted string
     *
     * @param $addressOne
     * @param $addressTwo
     * @param $city
     * @param $state
     * @param $zip
     * @returns string
     */
    function buildAddressString($addressOne, $addressTwo, $city, $state, $zip){
        $addressString = $addressOne + '<br>';

        if($addressTwo.length > 0){
            $addressString += $addressTwo + '<br>';
        }

        $addressString += $city + ', ' + $state + ' ' + $zip;
        return $addressString
    }


});
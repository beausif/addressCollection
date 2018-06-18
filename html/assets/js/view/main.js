$(function () {

    $('#addressCollection').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/assets/php/getAddressCollection.php',
            type: 'POST'
        },
        columnDefs: [
            {
                targets: 0,
                data: 'dateAdded',
                type: 'date'
            }, {
                targets: 1,
                data: 'address1'
            }, {
                targets: 2,
                data: 'address2'
            }, {
                targets: 3,
                data: 'city'
            }, {
                targets: 4,
                data: 'state'
            }, {
                targets: 5,
                data: 'zip'
            }
        ]
    });

});
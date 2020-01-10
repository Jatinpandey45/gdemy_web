var table = $('#data_table_post').DataTable({
    processing: true,
    serverSide: true,
    order: [[ 2, "desc" ]],
    "pagingType": "simple",
    "dom": "lfrt",
    "ajax": {
        url: $("#route_post_list").val(),
        data: {
            "page": $("#get_current_page").val()
        }
    },
    columns: [{
            data: 'question',
            name: 'Question',
        },
        {
            data: 'schedule_type',
            name: 'Schedule',
            'orderable': false,
            "sortable":false,
        },
        {
            data: 'publish_at',
            name: 'Created'
        },
        {
            data: "action",
            "className": "text-right",
            "render": function(data, type, row) {
                return '<a href="' + row.edit_route + '"><i class="material-icons">edit</i></a>' +
                    '<a href="javascript:void(0);" class="remove-item" data-id="' + data + '"><i class="material-icons">delete</i></a>';
            },
            'orderable': false,

            "sortable":false,
        }
    ]
});




var REMOVE_DATA_FROM_TABLE = {


    __REMOVE_FROM_LIST: function(type, id) {

        $.ajax({
            type: "get",
            url: $("#trash_route").val(),
            data: {
                type: type,
                id: id
            },
            dataType: "json",
            success: function(response) {

                console.log(response);

                table
                    .row($(this).parents('tr'))
                    .remove()
                    .draw();

                swal("Your quiz has been moved to trash!", {
                    icon: "success",
                });

            }
        });

    }
}



$('body').on('click', '.remove-item', function() {



    swal({
            title: "Are you sure?",
            text: "Once deleted, you will be able to recover this quiz from trash!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var id = $(this).attr('data-id');
                REMOVE_DATA_FROM_TABLE.__REMOVE_FROM_LIST("quiz", id);
            }
        });




});
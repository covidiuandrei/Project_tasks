var i = 0;
function showalert(message, alerttype) {
    $('#alerts').append('<div id="alertdiv_'+i+'" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">×</a><span>' + message + '</span></div>');
    console.log($("#alertdiv_"+i+' .close').length);
    $("#alertdiv_"+i+' .close').on('click',function(){
        $(this).closest('.alert').remove();
    });
    i++;
};
(function ($) {
    $(document).ready(function () {
        $('.datepicker').datepicker({minDate: 0});

        $('#add-task-form').submit(function (event) {
            var name = $('input[name=name]').val(),
            description = $('textarea[name=description]').val(),
            date = $('input[name=date]').val();
            if (!name || !description || !date) {
                console.log(name);
                console.log(description);
                console.log(date);
                showalert('All fields are necessary','alert-danger');
                event.preventDefault();
                return ;
            }
            $.ajax({
                type: 'POST', 
                url: ajax_url,
                data: {
                    action: 'add-task',
                    token: ajax_token,
                    'name': name,
                    'description': description,
                    'date': date
                },
                dataType: 'json', 
                encode: true
            }).done(function (data) {
                if (data.Result == 'OK'){
                    $('input[name=name]').val(''),
                    $('textarea[name=description]').val(''),
                    $('input[name=date]').val('');
                    showalert(data.Message,'alert-success');
                } else {
                    showalert(data.Message,'alert-danger');
                }

            }).error(function (data){
                showalert(data.responseText,'alert-danger');
            });

            event.preventDefault();
        });
    });
})(jQuery);
// Showing Add new field
$('.add-new-text').on('click', function () {
    var sib = $(this).siblings('.add-new-input-container');
    sib.css('display', 'block')
})

// Closing Input Field
function close(e, el) {
    var el = (typeof el !== 'undefined') ? el : $(this);
    var parent = el.parents('.add-new-input-container');
    parent.find('input').val('');
    parent.find('.has-error').text('');
    parent.css('display', 'none');
}

$('.add-new-close').on('click', close);

// Checking and Storing data to respective table
$('.add-new-btn').on('click', function () {
    var __csrf = $('meta[name=csrf]').attr('content'),
        el = $(this),
        parent = $(this).parents('.add-new-input-container'),
        inputField = parent.find('input'),
        val = inputField.val(),
        col = inputField.data('col'),
        url = inputField.data('route'),
        payload = {};
    payload[col] = val;

    $.ajax({
        url: url,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': __csrf,
        },
        data: payload,
        success: function (data) {
            var target = parent.parents('.form-group').find('.col-md-6'),
                html = '';

            if (target.children()[0].localName == 'select') {
                target.children()[0].append(new Option(val.toUpperCase(), data, '', true));
            }
            else {
                html += '<label class="checkbox-inline">';
                html += '<input name="colors_id[]"';
                html += ' type="checkbox" id="colors_id" checked';
                html += ' value="' + data + '"/>';
                html += wcUpperJS(val)
                html += '</label>';
                target.prepend(html);
            }
            close('', el);
        },
        error: function (err) {
//                        console.dir(err);
            if (err.status == 422) {
                var error_msg = err.responseJSON.errors[col][0];
                parent.find('.has-error').text(error_msg);
            }
        }
    });
})

$(document).ready(function ($) {
    var body = $('body'),
        formModal = $('#request-modal'),
        loader = $('<div></div>').attr('id','loader').append($('<div></div>')),
        agree = $('input[name=i_agree]');

    agree.change(function () {
        let button = $(this).parents('form.useAjax').find('button[type=submit]');
        if (agree.is(':checked')) button.removeAttr('disabled');
        else button.attr('disabled','disabled');
    });

    $('button[type=submit]').click(function(e) {
        e.preventDefault();

        let formData = new FormData,
            form = $(this).parents('form.use-ajax');

        if (form.length && agree.is(':checked')) {
            addLoader(body,loader);
            form.find('input, textarea, select').each(function () {
                let self = $(this);
                if (self.attr('type') === 'file') formData.append(self.attr('name'),self[0].files[0]);
                else if (self.attr('type') === 'checkbox' || self.attr('type') === 'radio') formData = processingCheckFields(formData,self);
                else formData = processingFields(formData,self);
            });

            $('.error').html('');
            form.find('input, select, textarea, button').attr('disabled','disabled');

            $.ajax({
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                type: form.attr('method'),
                success: function (data) {
                    formModal.modal('hide');
                    unlockAll(body,form,agree,loader);
                    form.find('input, textarea').val('');

                    let messageModal = $('#message-modal');
                    messageModal.find('h3').html(data.message);
                    messageModal.modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    let response = jQuery.parseJSON(jqXHR.responseText);
                    $.each(response.errors, function (field, errorMsg) {
                        form.find('.error.'+field).html(errorMsg[0]);
                    });
                    unlockAll(body,form,agree,loader);
                }
            });
        }
    });
});

function processingFields(formData, inputObj) {
    if (inputObj.length) {
        $.each(inputObj, function (key, obj) {
            if (obj.type != 'checkbox' && obj.type != 'radio') {
                formData.append(obj.name,obj.value);
            }
        });
    }
    return formData;
}

function processingCheckFields(formData, inputObj) {
    if (inputObj.length) {
        inputObj.each(function(){
            var _self = $(this);
            if(_self.is(':checked')) {
                formData.append(_self.attr('name'),_self.val());
            }
        });
    }
    return formData;
}

function unlockAll(body,form,agree,loader) {
    form.find('input, select, textarea, button').removeAttr('disabled');
    agree.prop('checked', false);
    loader.remove();
    body.css({
        'overflow':'auto',
        'padding-right':0
    });
}

function addLoader(body,loader) {
    body.prepend(loader);
    body.css({
        'overflow':'hidden',
        'padding-right':20
    });
}

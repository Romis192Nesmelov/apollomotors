window.allMonths = ['Янв.', 'Фев.', 'Март', 'Апр.', 'Май', 'Июнь', 'Июль', 'Авг.', 'Сент.', 'Окт.', 'Нояб.', 'Декаб.'];
window.statisticsData = [];
$(document).ready(function () {
    // Phone mask
    $('input[name=phone], input.phone').mask("+7(999)999-99-99");

    CKEDITOR.replaceClass = 'ckeditor';
    $('.styled').uniform();

    if (window.showMessage) $('#message-modal').modal('show');

    setTimeout(function () {
        windowResize();
    },1000);

    $(window).resize(function() {
        windowResize();
    });

    // Single picker
    // $('.daterange-single').daterangepicker({
    //     singleDatePicker: true,
    //     locale: {
    //         format: 'DD/MM/YYYY'
    //     }
    // });

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            targets: [5]
        }],
        order: [],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Фильтр:</span> _INPUT_',
            lengthMenu: '<span>Показывать:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
            emptyTable: 'No data available in table',
            info: 'Показано с _START_ по _END_ из _TOTAL_',
            infoEmpty: 'Показано с 0 по 0 из 0',
            infoFiltered:   '(Фильтровать от _MAX_ общего числа)',
            thousands:      ',',
            loadingRecords: 'Загрузка...',
            zeroRecords:    'Нет данных',
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });;

    // Basic datatable
    $('.datatable-basic').DataTable();

    // Alternative pagination
    // $('.datatable-pagination').DataTable({
    //     pagingType: "simple",
    //     language: {
    //         paginate: {'next': 'Next &rarr;', 'previous': '&larr; Prev'}
    //     }
    // });

    // Preview upload image
    $('input[type=file]').change(function () {
        let input = $(this)[0],
            parent = $(this).parents('.edit-image-preview'),
            imagePreview = parent.find('img');

        if (input.files[0].type.match('image.*')) {
            let reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
                if (!imagePreview.is(':visible')) imagePreview.fadeIn();
            };
            reader.readAsDataURL(input.files[0]);
        } else if (parent.hasClass('file-advanced')) {
            imagePreview.attr('src', '');
            imagePreview.fadeOut();
        } else {
            imagePreview.attr('src', '/images/placeholder.jpg');
        }
    });

    // Copy to clipboard image path
    $('.table-items td.cb-copy > i').click(function () {
        let path = $(this).parents('tr').find('td.image-path').html();
        navigator.clipboard.writeText(path)
            .then(() => {
                alert('Путь скопирован!');
            })
    });

    // Click to delete items
    window.deleteId = null;
    window.deleteRow = null;

    // Change pagination on data-tables
    $('table.datatable-basic').on('draw.dt', function () {
        bindDelete();
        bindFancybox();
    });

    bindDelete();

    // Click YES on delete modal
    $('.delete-yes').click(function () {
        let deleteModal = $(this).parents('.modal');
        deleteModal.modal('hide');
        addLoader();

        $.post(deleteModal.attr('del-function'), {
            '_token': $('input[name=_token]').val(),
            'id': window.deleteId,
        }, function (data) {
            if (data.success) {
                window.deleteRow.remove();
                removeLoader();
            }
        });
    });

    // Carousel repair images
    $('#repair-images').owlCarousel(oul_settings(
        10,
        true,
        3000,
        {
            0: {
                items: 1
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    ));

    bindFancybox();

    // Changing button online-record settings
    if ($('.button-settings').length) {
        $('.button-settings .units input[type=radio]').on('switchChange.bootstrapSwitch', function (event, state) {
            let newVal = $(this).val();
            let container = $(this).parents('.button-settings');
            container.find('.distance input').attr('max',(newVal === 'percents' ? 50 : 300));
        });
    }

    // Click to idle-mechanics icon
    $('table.idle-mechanics.edit i').click(function () {
        var icon = $(this),
            parentCell = icon.parents('td');

        $.post('/admin/change-idle-mechanic', {
            '_token': $('input[name=_token]').val(),
            'date': parseInt(parentCell.attr('date')),
            'id': parseInt(parentCell.attr('id'))
        }, function (data) {
            if (data.success) {
                if (data.mode === 1) {
                    icon.removeClass('icon-spam text-danger-800');
                    icon.addClass('icon-checkmark text-success');
                } else {
                    icon.removeClass('icon-checkmark text-success');
                    icon.addClass('icon-spam text-danger-800');
                }
            }
        });
    });
});

function windowResize() {
    maxHeight($('.records-month'), 20);
}

function bindDelete() {
    let deleteIcon = $('.glyphicon-remove-circle');
    deleteIcon.unbind();
    deleteIcon.click(function () {
        let deleteModal = $('#' + $(this).attr('modal-data')),
            inputId = deleteModal.find('input[name=id]');

        window.deleteId = $(this).attr('del-data');
        window.deleteRow = $(this).parents('tr');

        if (inputId.length) inputId.val(window.deleteId);

        deleteModal.modal('show');
    });
}

function cloneArrayData(data) {
    let newData = [];
    $.each(data, function (k,item) {
        newData[k] = item;
    });
    return newData;
}

// function translit(text, engToRus) {
//     var rus = "щ ш ч ц ю я ё ж ъ ы э а б в г д е з и й к л м н о п р с т у ф х ь".split(/ +/g),
//         eng = "shh sh ch cz yu ya yo zh `` y' e` a b v g d e z i j k l m n o p r s t u f x `".split(/ +/g);
//
//     var x;
//     for(x=0;x<rus.length; x++) {
//         text = text.split(engToRus ? eng[x] : rus[x]).join(engToRus ? rus[x] : eng[x]);
//         text = text.split(engToRus ? eng[x].toUpperCase() : rus[x].toUpperCase()).join(engToRus ? rus[x].toUpperCase() : eng[x].toUpperCase());
//     }
//     return text;
// }

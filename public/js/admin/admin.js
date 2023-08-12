$(document).ready(function () {
    // Phone mask
    $('input[name=phone], input.phone').mask("+7(999)999-99-99");

    CKEDITOR.replaceClass = 'ckeditor';
    $('.styled').uniform();

    if (window.showMessage) $('#message-modal').modal('show');

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
    let deleteModal = $('#delete-modal');
    window.deleteId = null;
    window.deleteRow = null;

    // Change pagination on data-tables
    $('table.datatable-basic').on('draw.dt', function () {
        bindDelete(deleteModal);
        bindFancybox();
    });

    bindFancybox();
    bindDelete(deleteModal);

    // Click YES on delete modal
    $('.delete-yes').click(function () {
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
});

function bindDelete(deleteModal) {
    let deleteIcon = $('.glyphicon-remove-circle');
    deleteIcon.unbind();
    deleteIcon.click(function () {
        window.deleteId = $(this).attr('del-data');
        window.deleteRow = $(this).parents('tr');
        deleteModal.modal('show');
    });
}

function bindFancybox() {
    // Fancybox init
    $('a.fancybox').fancybox({
        padding: 3
    });
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

$(document).ready(function () {
    $('#fileupload').fileupload({
        dropZone: $('#dropzone'),
        dataType: 'json',
        done: function (e, data) {
            let img = data.result;
            $('#photo-preview').append(`<img src="${base_url}/upload/photo/${img.result.file_name}" class="photo-thumb me-3"/>`);
        }
    });
    $('#dropzone').on('click', function(e) {
        $("#fileupload").click();
    })

    $(document).bind('dragover', function (e) {
        var dropZone = $('#dropzone'),
            timeout = window.dropZoneTimeout;
        if (timeout) {
            clearTimeout(timeout);
        } else {
            dropZone.addClass('in');
        }
        var hoveredDropZone = $(e.target).closest(dropZone);
        dropZone.toggleClass('hover', hoveredDropZone.length);
        window.dropZoneTimeout = setTimeout(function () {
            window.dropZoneTimeout = null;
            dropZone.removeClass('in hover');
        }, 100);
    });
});


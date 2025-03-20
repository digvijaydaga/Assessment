jQuery(document).ready(function ($) {
    $('.cts-upload-btn').click(function (e) {
        e.preventDefault();
        var button = $(this);
        var target = button.data('target');

        var mediaUploader = wp.media({
            title: 'Select Image',
            button: { text: 'Use this Image' },
            multiple: false
        });

        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#' + target).val(attachment.url);
            $('#' + target + '_preview').attr('src', attachment.url).show();
        });

        mediaUploader.open();
    });

    $('.cts-remove-btn').click(function (e) {
        e.preventDefault();
        var target = $(this).data('target');
        $('#' + target).val('');
        $('#' + target + '_preview').hide();
    });
});

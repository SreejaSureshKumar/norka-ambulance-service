@props(['action'])
@push('custom-scripts')
<script>
    jQuery(function($) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        function validateField($elem) {

            var type = $elem.attr('id');
            var data = {
                field_name: type
            };
            data[type] = $('#' + type).val();
            var validation_selector = type;

            $('#' + validation_selector).removeClass('is-invalid').next(
                ' .invalid-message').remove();

            $.ajax({
                url: '{{ route($action) }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: data
            }).fail(function(xhr, textStatus) {
                console.log(xhr);

                if (xhr.responseJSON.errors && typeof xhr.responseJSON.errors[type][0] !==
                    'undefined') {
                    $('#' + validation_selector).removeClass('is-valid is-invalid').next(
                        '.invalid-message').remove();
                    $('#' + validation_selector).addClass('is-invalid').after(
                        '<span class="text-danger invalid-message" role="alert">' + xhr.responseJSON.errors[
                            type][0] + '</span>');

                }
            });
        }

        function validateDateField($elem) {
            var type = $elem.attr('id');

            var data = {
                field_name: type,
                departure_date: $('#departure_date').val(),
                departure_time: $('#departure_time').val(),
                arriving_date: $('#arriving_date').val()

            };
            data[type] = $('#' + type).val();
            var validation_selector = type;
            $('#' + validation_selector).removeClass('is-invalid').next(
                ' .invalid-message').remove();
            $.ajax({
                url: '{{ route('beneficiary.date-field-validation') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: data
            }).fail(function(xhr, textStatus) {
                console.log(xhr);

                if (xhr.responseJSON.errors && typeof xhr.responseJSON.errors[type][0] !==
                    'undefined') {

                    const $wrapper = $('#' + validation_selector + '_wrapper');
                    $wrapper.find('.invalid-message').remove(); // Remove old message
                    $('#' + validation_selector).removeClass('is-valid').addClass('is-invalid');
                    $wrapper.append('<span class="text-danger invalid-message" role="alert">' +
                        xhr.responseJSON.errors[type][0] + '</span>');

                }
            });
        }


        $('.form-control-validate').on('change', function() {

            validateField($(this));
        });
        $('.date-control-validate').on('change', function() {

            validateDateField($(this));
        });

    });
</script>
@endpush
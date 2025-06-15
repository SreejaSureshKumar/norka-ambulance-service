
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
                
                $('#' + validation_selector).removeClass('is-valid is-invalid').next(
                    '.valid-feedback, .invalid-message').remove();

                $.ajax({
                    url: '{{ route('beneficiary.application.validate') }}',
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

            $('.form-control-validate').on('change', function() {
             
                validateField($(this));
            });

           
        });
    </script>
@endpush

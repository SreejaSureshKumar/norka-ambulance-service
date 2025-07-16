<div class="modal fade" tabindex="-1" role="dialog" id="documentModal" wire:ignore>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal"><i class="ti ti-circle-x"></i></a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title d-none"></h5>
                <div style="height:400px;">
                    <iframe src="/placeholder.html" width="100%" height="400px" style="border: none;"></iframe>
                </div>
                <a href="#" class="document-download-control btn btn-primary mt-2 d-none"><em class="icon ni ni-download me-1"></em> Download</a>
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->

<script type="text/javascript">
    jQuery(function($) {
        $(document).on('click', '.document-modal-control', function (e) {
            e.preventDefault();
            var $control = $(this);
            var $download_control = $('#documentModal').find('.document-download-control');
            $download_control.addClass('d-none');
            var url = $control.attr('href');
            if (typeof url === undefined) {
                url = $control.data('url');
            }
            var download = $control.data('download');
            $('#documentModal').find('iframe').attr('src', url);
            if (download !== undefined) {
                $download_control.attr({
                    'href': url,
                    'download': download
                }).removeClass('d-none');
            }
            $('#documentModal').modal('show');
        });
    });
</script>
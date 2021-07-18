

<!-- Modal Delete User -->
<div class="modal fade " id="delete-user" tabindex="-1" role="dialog" aria-labelledby="myModalAdd" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger text-center wd100">
                    <!-- <i class="fa fa-exclamation-triangle fa"></i>&nbsp; -->
                    <h3 class="block-title text-center">Peringatan!</h3>
                    <!-- <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div> -->
                </div>
                <div class="block-content">
                    <!-- Basic Elements -->
                    <div class="row push">
                        <div class="col-lg-8 col-xl-12  float-center">
                            <p class="text-justify">Daftar tidak dapat dikembalikan jika Anda menghapus daftar ini, Lanjutkan penghapusan daftar ?</p>
                            <div class="form-group text-center wd100">
                                <a class="btn btn-outline-danger w-50 btn-delete link-button">Delete</a>
                                <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">Close</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- END Input Grid Sizes -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<script type="text/javascript">
    $(document).ready(function() {
        // delete modal
        $('#delete-user').on('show.bs.modal', function(e) {
            $(this).find('.btn-delete').attr('href', $(e.relatedTarget).data('href'));
            $(this).find('.user-name').text("");
            $(this).find('.user-name').append($(e.relatedTarget).data('good'));
        });
    
    });
</script>
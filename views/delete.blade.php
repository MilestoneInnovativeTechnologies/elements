<script>
    function deleteuser(obj, lnk){
        $('#deleteModal').attr('link',lnk);
        $("#deleteModal").modal('show');
    }
    function deleteLink(){
        var p=document.createElement('a');
        $(p).attr('href',$('#deleteModal').attr('link')).click();
        $('#deleteModal').append(p);
        $(p).html('.');
        $(p)[0].click();
    }
</script>

<!--Delete Modal -->
<div class="modal fade"
     id="deleteModal"
     aria-labelledby="modalToggleLabel"
     tabindex="-1"
     style="display: none"
     aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel">
                    Delete<box-icon name='question-mark'></box-icon></h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">Are you sure you want to delete?</div>
                <div class="modal-footer">
                    <a href=""  class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                        Cancel </a>
                    <button type="button" class="btn btn-danger" id="delete" onclick="deleteLink()">OK</button>
                </div>
        </div>
    </div>
</div>
<!-- / DeleteModal -->

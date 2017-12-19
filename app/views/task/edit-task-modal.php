<!-- The Modal -->
<div class="modal fade" id="edit-task-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h1 class="font-weight-light">Edit your task</h1>
        <br>
        <form method="POST" action="/tasks/edit">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="id" name="id">

            <div class="form-group">
                <textarea class="form-control" rows="5" name="description" id="description" placeholder="Description" required></textarea>
            </div>

            <button type="submit" class="btn btn-info btn-block">
                <i class="fa fa-edit"></i> Submit
            </button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      </div>
      
    </div>
  </div>
</div>
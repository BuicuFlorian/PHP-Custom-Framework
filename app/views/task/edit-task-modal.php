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
        <form method="POST" action="/tasks/edit">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="id" name="id">

            <div class="form-group">
                <label for="description"><b>Description:</b></label>
                <textarea class="form-control" rows="5" name="description" id="description" placeholder="Description" required></textarea>
            </div>

            <div class="form-group">
                <label for="completed"><b>Completed:</b></label>
                <select class="form-control" name="completed" id="completed" required>
                  <option value="1">True</option>
                  <option value="0">False</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning btn-block">
                <i class="fa fa-edit"></i> Update
            </button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      </div>
      
    </div>
  </div>
</div>
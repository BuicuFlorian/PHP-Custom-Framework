<!-- The Modal -->
<div class="modal fade" id="add-task-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h1 class="font-weight-light">Add new task</h1>
        <br>
        <form method="POST" action="/tasks">
            <div class="form-group">
                <label for="description"><b>Description:</b></label>
                <textarea class="form-control" rows="5" name="description" id="description" placeholder="Description" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Add
            </button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      </div>
      
    </div>
  </div>
</div>
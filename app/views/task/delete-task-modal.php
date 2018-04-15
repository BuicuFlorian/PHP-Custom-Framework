<!-- The Modal -->
<div class="modal fade" id="delete-task-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <br>
      </div>

      <!-- Modal body -->
      <div class="modal-body text-center">
        <h1 class="font-weight-light">Are you sure you want to delete this task?</h1>
        <hr>
        <form method="POST" action="/tasks/delete">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" id="id" name="id">

            <button type="submit" class="btn btn-success pull-right">
                <i class="fa fa-thumbs-up"></i> Yes
            </button>

            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">
                <i class="fa fa-thumbs-down"></i> No
            </button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      </div>
      
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $('.task').click(function () {
            let id = $(this).find('td').eq(0).html();
            let description = $(this).find('td').eq(1).html();
            let completed = $(this).find('td').eq(2).attr('id');

            $('#edit-task-modal').find('#id').val(id);
            $('#edit-task-modal').find('#description').val(description);
            $('#edit-task-modal').find('#completed').val(completed);

            $('#delete-task-modal').find('#id').val(id);
        });
    });
</script>
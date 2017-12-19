<script>
$(document).ready(function() {
    $('.task').click(function () {
        var id = $(this).find('td').eq(0).html();
        var description = $(this).find('td').eq(1).html();
        var completed = $(this).find('td').eq(2).html();

        $('#edit-task-modal').find('#id').val(id);
        $('#edit-task-modal').find('#description').val(description);

        $('#delete-task-modal').find('#id').val(id);
    });
});
</script>
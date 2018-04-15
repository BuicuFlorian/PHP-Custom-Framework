<?php require 'partials/head.php'; ?>

<?php if ($message) : ?>
    <div class="alert alert-success alert-dismissible fade show">
        <p class="lead"><?= $message ?></p>
    </div>
<?php endif; ?>

<?php if ($errors) : ?>
    <?= displayErrors($errors); ?>
<?php endif; ?>

<div class="container">
    <button type="button" id="add-task" class="btn btn-primary" data-toggle="modal" data-target="#add-task-modal">
        <i class="fa fa-plus"></i> Add new task
    </button>
    
    <?php if (count($tasks) > 0) : ?>
        <div class="col-sm-8 offset-2">
            <div class="table-responsive">          
                <table class="table table-striped" class="thead-dark">
                    <thead class="thead-dark">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Description</th>
                        <th>Completed</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($tasks as $task) : ?>
                            <tr class="task">
                                <td><?= $task->id ?></td>
                                <td><?= $task->description ?></td>
                                <?php if ($task->completed) : ?>
                                    <td id="1">
                                        <i class="fa fa-check"></i>
                                    </td>
                                <?php else : ?>
                                    <td id="0">
                                        <i class="fa fa-spinner fa-pulse"></i>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-task-modal">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" id="delete-task-btn" data-toggle="modal" data-target="#delete-task-modal">
                                        <i class="fa fa-trash-o"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if (isset($pagination)) : ?>
            <?= $pagination->links('/tasks'); ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php require 'task/add-task-modal.php'; ?>
<?php require 'task/edit-task-modal.php'; ?>
<?php require 'task/delete-task-modal.php'; ?>
<?php require 'task/script.php'; ?>
<?php require 'partials/footer.php'; ?>
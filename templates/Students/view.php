<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>

<?php
$this->assign('title', __('Student'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Students'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($student->name) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Name') ?></th>
                <td><?= h($student->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Username') ?></th>
                <td><?= h($student->username) ?></td>
            </tr>
            <tr>
                <th><?= __('Nis') ?></th>
                <td><?= h($student->nis) ?></td>
            </tr>
            <tr>
                <th><?= __('Gender') ?></th>
                <td><?= h($student->gender) ?></td>
            </tr>
            <tr>
                <th><?= __('Level') ?></th>
                <td><?= h($student->level) ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($student->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Birth Date') ?></th>
                <td><?= h($student->birth_date) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($student->created) ?></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $student->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $student->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Address') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($student->address)); ?>
    </div>
</div>

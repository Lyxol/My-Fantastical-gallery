<?php
echo $this->Html->css(['generalStyle']);
$this->assign('title', "My Fantastical Gallery - Inscription");
?>

<h1>Inscription</h1>

<?php
echo $this->Form->create(null, array('enctype' => 'multipart/form-data'));
?>
<fieldset>
    <?= $this->Form->control('Name', array('type' => 'string')) ?>
    <?= $this->Form->control('Email', array('type' => 'email')) ?>
    <?= $this->Form->control('Password', array('type' => 'password')) ?>
    <?= $this->Form->control('Confirm Password', array('type' => 'password')) ?>
    <?= $this->Form->button('validate') ?>
</fieldset>
<?= $this->Form->end() ?>
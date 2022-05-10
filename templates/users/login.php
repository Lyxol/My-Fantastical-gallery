<?php
echo $this->Html->css(['generalStyle']);
$this->assign('title', "My Fantastical Gallery - Connexion");
?>

<h1>Connexion</h1>

<?php
echo $this->Form->create(null, array('enctype' => 'multipart/form-data'));
?>
<fieldset>
    <?= $this->Form->control('Email', array('type' => 'auth_Email')) ?>
    <?= $this->Form->control('Password', array('type' => 'password')) ?>
    <?= $this->Form->button('validate') ?>
</fieldset>
<?= $this->Form->end() ?>
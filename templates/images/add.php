<?php

use Cake\Form\Form;

echo $this->Html->css(['generalStyle']);
$this->assign('title', "My Fantastical Gallery - Add your image");
?>

<h1>Add your image</h1>

<?php
echo $this->Form->create(null, array('enctype' => 'multipart/form-data'));
?>
<fieldset>
    <div>
        <?= $this->Form->control('upload', array('type' => 'file')) ?>
    </div>
    <div>
        <?= $this->Form->control('description',array('type' => 'textarea')) ?>
    </div>
    <?=$this->Form->button('validate')?>
</fieldset>
<?= $this->Form->end()?>
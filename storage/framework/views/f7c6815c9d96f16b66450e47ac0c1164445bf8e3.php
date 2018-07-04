<!-- Nome Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('nome', 'Nome:'); ?>

    <?php echo Form::text('nome', null, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('cursos.index'); ?>" class="btn btn-default">Cancel</a>
</div>

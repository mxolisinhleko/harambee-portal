<?php echo e(Form::model(Auth::User(), array('route' => array('setting.smtp.test'), 'method' => 'POST'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('email',__('Test Email'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email'),'required'=>'required'))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Send Mail'),array('class'=>'btn btn-primary btn-rounded'))); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/cmm9wxppgc5y/public_html/harambee/portal/resources/views/settings/testmail.blade.php ENDPATH**/ ?>
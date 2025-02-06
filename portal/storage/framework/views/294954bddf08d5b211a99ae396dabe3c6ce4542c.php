<?php echo e(Form::open(array('route'=>array('invoice.payment.store',$invoice_id),'method'=>'post','enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('payment_date',__('Payment Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('payment_date',date('Y-m-d'),array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('amount',__('Amount'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('amount',$invoice->getInvoiceDueAmount(),array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('receipt',__('Receipt'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::file('receipt',array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group ">
            <?php echo e(Form::label('notes',__('Notes'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('notes',null,array('class'=>'form-control','rows'=>3,'placeholder'=>__('Enter Payment Notes')))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <?php echo e(Form::submit(__('Add'),array('class'=>'btn btn-primary btn-rounded'))); ?>

</div>
<?php echo e(Form::close()); ?>



<?php /**PATH /home/cmm9wxppgc5y/public_html/harambee/portal/resources/views/invoice/payment.blade.php ENDPATH**/ ?>
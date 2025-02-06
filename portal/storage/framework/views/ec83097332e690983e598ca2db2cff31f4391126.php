<div class="modal-body">
    <div class="product-card">
        <div class="row">
            <div class="col-6">
                <div class="detail-group">
                    <h6><?php echo e(__('Property')); ?></h6>
                    <p class="mb-20"> <?php echo e(!empty($maintenanceRequest->properties)?$maintenanceRequest->properties->name:'-'); ?> </p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6><?php echo e(__('Unit')); ?></h6>
                    <p class="mb-20"><?php echo e(!empty($maintenanceRequest->units)?$maintenanceRequest->units->name:'-'); ?></p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6><?php echo e(__('Issue')); ?></h6>
                    <p class="mb-20"><?php echo e(!empty($maintenanceRequest->types)?$maintenanceRequest->types->title:'-'); ?></p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6><?php echo e(__('Maintainer')); ?></h6>
                    <p class="mb-20"> <?php echo e(!empty($maintenanceRequest->maintainers)?$maintenanceRequest->maintainers->name:'-'); ?> </p>
                </div>
            </div>

            <div class="col-6">
                <div class="detail-group">
                    <h6><?php echo e(__('Request Date')); ?></h6>
                    <p class="mb-20"><?php echo e(dateFormat($maintenanceRequest->request_date)); ?>  </p>
                </div>
            </div>
            <?php if(!empty($maintenanceRequest->fixed_date)): ?>
                <div class="col-6">
                    <div class="detail-group">
                        <h6><?php echo e(__('Fixed Date')); ?></h6>
                        <p class="mb-20"> <?php echo e(dateFormat($maintenanceRequest->fixed_date)); ?> </p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($maintenanceRequest->amount!=0): ?>
                <div class="col-6">
                    <div class="detail-group">
                        <h6><?php echo e(__('Amount')); ?></h6>
                        <p class="mb-20"> <?php echo e(priceFormat($maintenanceRequest->amount)); ?> </p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-6">
                <div class="detail-group">
                    <h6><?php echo e(__('Status')); ?></h6>
                    <p class="mb-20">
                        <?php if($maintenanceRequest->status=='pending'): ?>
                            <span
                                class="badge badge-warning"> <?php echo e(\App\Models\MaintenanceRequest::$status[$maintenanceRequest->status]); ?></span>
                        <?php elseif($maintenanceRequest->status=='in_progress'): ?>
                            <span
                                class="badge badge-info"> <?php echo e(\App\Models\MaintenanceRequest::$status[$maintenanceRequest->status]); ?></span>
                        <?php else: ?>
                            <span
                                class="badge badge-primary"> <?php echo e(\App\Models\MaintenanceRequest::$status[$maintenanceRequest->status]); ?></span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <?php if(!empty($maintenanceRequest->invoice)): ?>
                <div class="col-6">
                    <div class="detail-group">
                        <h6><?php echo e(__('Invoice')); ?></h6>
                        <p class="mb-20">
                            <a href="<?php echo e(asset(Storage::url('upload/invoice')).'/'.$maintenanceRequest->invoice); ?>"
                               download="download"><i class="fa fa-download"></i></a>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-6">
                <div class="detail-group">
                    <h6><?php echo e(__('Attachment')); ?></h6>
                    <p class="mb-20">
                        <?php if(!empty($maintenanceRequest->issue_attachment)): ?>
                            <a href="<?php echo e(asset(Storage::url('upload/issue_attachment')).'/'.$maintenanceRequest->issue_attachment); ?> "
                               download="download"><i class="fa fa-download"></i></a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="col-12">
                <div class="detail-group">
                    <h6><?php echo e(__('Notes')); ?></h6>
                    <p class="mb-20"><?php echo e($maintenanceRequest->notes); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/cmm9wxppgc5y/public_html/harambee/portal/resources/views/maintenance_request/show.blade.php ENDPATH**/ ?>
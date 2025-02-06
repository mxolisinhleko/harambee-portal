<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Tenant')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><h1><?php echo e(__('Dashboard')); ?></h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(__('Tenant')); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create tenant')): ?>
        <a class="btn btn-primary btn-sm ml-20" href="<?php echo e(route('tenant.create')); ?>" data-size="md"> <i
                class="ti-plus mr-5"></i><?php echo e(__('Create Tenant')); ?></a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-3 col-md-6 cdx-xxl-50 cdx-xl-50 ">
                <div class="card custom contact-card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="user-imgwrapper">
                                <img class="img-fluid rounded-50"
                                     src="<?php echo e((!empty($tenant->user) && !empty($tenant->user->profile))? asset(Storage::url("upload/profile/".$tenant->user->profile)): asset(Storage::url("upload/profile/avatar.png"))); ?>"
                                     alt="">
                            </div>
                            <div class="media-body">
                                <a href="<?php echo e(route('tenant.show',$tenant->id)); ?>">
                                    <h4><?php echo e(ucfirst(!empty($tenant->user)?$tenant->user->first_name:'').' '.ucfirst(!empty($tenant->user)?$tenant->user->last_name:'')); ?></h4>
                                    <h6 class="text-light"><?php echo e(!empty($tenant->user)?$tenant->user->email:'-'); ?></h6>
                                </a>
                            </div>
                            <?php if(Gate::check('edit tenant') || Gate::check('delete tenant') || Gate::check('show tenant')): ?>
                                <div class="user-setting">
                                    <div class="action-menu">
                                        <div class="action-toggle"><i data-feather="more-vertical"></i></div>
                                        <ul class="action-dropdown">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit tenant')): ?>
                                                <li>
                                                    <a class="" href="<?php echo e(route('tenant.edit',$tenant->id)); ?>"> <i
                                                            data-feather="edit"> </i><?php echo e(__('Edit Tenant')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete tenant')): ?>
                                                <li>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['tenant.destroy', $tenant->id],'id'=>'tenant-'.$tenant->id]); ?>

                                                    <a href="#" class="confirm_dialog"> <i
                                                            data-feather="trash"></i><?php echo e(__('Delete Tenant')); ?></a>
                                                    <?php echo Form::close(); ?>

                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show tenant')): ?>
                                                <li>
                                                    <a href="<?php echo e(route('tenant.show',$tenant->id)); ?>"> <i
                                                            data-feather="eye"> </i><?php echo e(__('View Tenant')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="user-detail">
                            <h5 class="text-primary mb-10"><i class="fa fa-info-circle mr-10"></i><?php echo e(__('Infomation')); ?>

                            </h5>
                            <p class="text-light"><?php echo e($tenant->address); ?></p>
                            <ul class="info-list">
                                <li><span><?php echo e(__('Phone')); ?> : </span><?php echo e(!empty($tenant->user)?$tenant->user->phone_number:'-'); ?></li>
                                <li><span><?php echo e(__('Family Member')); ?> :</span><?php echo e($tenant->family_member); ?></li>
                                <li>
                                    <span><?php echo e(__('Property')); ?> : </span><?php echo e(!empty($tenant->properties)?$tenant->properties->name:'-'); ?>

                                </li>
                                <li><span><?php echo e(__('Unit')); ?> : </span><?php echo e(!empty($tenant->units)?$tenant->units->name:'-'); ?>

                                </li>
                                <li>
                                    <span><?php echo e(__('Lease Start Date')); ?> : </span><?php echo e(dateFormat($tenant->lease_start_date)); ?>

                                </li>
                                <li>
                                    <span><?php echo e(__('Lease End Date')); ?> : </span><?php echo e(dateFormat($tenant->lease_end_date)); ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cmm9wxppgc5y/public_html/harambee/portal/resources/views/tenant/index.blade.php ENDPATH**/ ?>
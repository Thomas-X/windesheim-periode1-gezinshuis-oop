<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <h4>User names stored in db</h4>
    <ul>
        <form method="post" action="/bla">
            <div>
            <input type="email" name="email" id="email">
            <input class="waves-effect waves-light btn" type="submit" value="enter">
            </div>
            
        </form>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($user->username); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php defined('KOOWA') or die ?>

<div class="an-socialgraph-stat">
    <?php if($actor->isFollowable()) : ?> 
    <div class="stat-count">
        <?= $actor->followerCount ?>
        <span class="stat-name"><?= @text('COM-ACTORS-SOCIALGRAPH-FOLLOWERS') ?></span>
    </div>
    <?php endif; ?>
    
    <?php if($actor->isLeadable()) : ?>    
    <div class="stat-count">
        <?= $actor->leaderCount ?>
        <span class="stat-name"><?= @text('COM-ACTORS-SOCIALGRAPH-LEADERS') ?></span>
    </div>
    <?php endif; ?>
    
    <?php if($actor->isLeadable() && $viewer->isLeadable()) : ?>
        <?php $commons = $actor->getCommonLeaders($viewer); ?>    
        <?php if( isset($commons) && !$viewer->eql($actor) && $commons->getTotal() ) : ?>
        <div class="stat-count">
            <?= $commons->getTotal() ?>
            <span class="stat-name"><?= @text('COM-ACTORS-SOCIALGRAPH-COMMON') ?></span>
        </div>  
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php $limit = 7; ?>
         
<?php if($actor->leaderCount + $actor->followerCount) : ?>  
<div class="an-gadget-socialgraph">
<?php if( $actor->followerCount ) : ?>
<h4>
	<?= @text('COM-ACTORS-SOCIALGRAPH-FOLLOWERS') ?> 
	<?php if($actor->authorize('lead')): ?> - 
	<small>
		<a href="<?= @route($actor->getURL().'&get=graph&type=leadables') ?>">
			<?= @text('LIB-AN-ACTION-ADD') ?>
		</a>
	</small>
	<?php endif; ?>
</h4>
<?= @template('_grid', array('actors'=>$actor->followers->limit($limit))) ?>
<?php endif; ?>

<?php if( $actor->leaderCount ) : ?>
<h4><?= @text('COM-ACTORS-SOCIALGRAPH-LEADERS') ?></h4>
<?= @template('_grid', array('actors'=>$actor->leaders->limit($limit))) ?>
<?php endif; ?>

<?php if(count($actor->administrators)): ?>
<h4><?= @text('COM-ACTORS-PROFILE-ADMINS') ?></h4>
<?= @template('_grid', array('actors'=>$actor->administrators)) ?>
<?php endif; ?>
</div>
<?php else : ?>
<?= @message(@text('COM-ACTORS-SOCIALGRAPH-EMPTY-MESSAGE')) ?>
<?php endif; ?>
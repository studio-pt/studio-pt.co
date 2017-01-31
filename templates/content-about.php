<div class="page-body">
<div class="page-container">
  <?php if(have_rows('about')): ?>
    <?php while (have_rows('about')): the_row(); ?>
      <div class="row">
        <div class="col-xs-12">
          <h3 class="section-header"><?= the_sub_field('title'); ?></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <?= the_sub_field('japanese'); ?>
        </div>
        <div class="col-xs-12 col-md-6">
          <?= the_sub_field('english'); ?>
        </div>
      </div>
    <?php endwhile; ?>
    <?php else: ?>
    <?php endif; ?>

    <?php if(have_rows('company')): ?>
      <?php while (have_rows('company')): the_row(); ?>

        <div class="row">
          <div class="col-xs-12">
            <h3 class="section-header"><?= the_sub_field('title'); ?></h3>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <dl class="dl-company">
            <?php if( have_rows('japanese') ):?>
              <?php while ( have_rows('japanese') ) : the_row();?>
              <?php if( get_row_layout() == 'item' ): ?>
                <dt><?= the_sub_field('key'); ?></dt>
                <dd><?= the_sub_field('value'); ?></dd>
              <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
            </dl>
          </div>
          <div class="col-xs-12 col-sm-6">
            <dl class="dl-company">
            <?php if( have_rows('english') ):?>
              <?php while ( have_rows('english') ) : the_row();?>
              <?php if( get_row_layout() == 'item' ): ?>
                <dt><?= the_sub_field('key'); ?></dt>
                <dd><?= the_sub_field('value'); ?></dd>
              <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
            </dl>
          </div>
        </div>
      <?php endwhile; ?>
      <?php else: ?>
      <?php endif; ?>

    <?php if(have_rows('people')): ?>
      <?php while (have_rows('people')): the_row(); ?>
        <div class="row">
          <div class="col-xs-12">
            <h3 class="section-header"><?= the_sub_field('title'); ?></h3>
          </div>
        </div>
        <div class="row">
        <?php if( have_rows('person') ):?>
          <?php while ( have_rows('person') ) : the_row();?>
          <?php if( get_row_layout() == 'item' ): ?>
          <div class="col-xs-12 col-sm-6 col-md-4">
          <dl class="dl-person">
          <dt><?= the_sub_field('primary'); ?> <small><?= the_sub_field('secondary'); ?></small></dt>
          <dd><?= the_sub_field('role'); ?></dd>
          </dl>
          </div>
          <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>
        </div>
      <?php endwhile; ?>
      <?php else: ?>
      <?php endif; ?>
  </div>
  <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>
</div>

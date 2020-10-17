<?php if(isset($breadcrumb)){?>
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <?php foreach($breadcrumb as $i=>$b){?>
            <?php if($i>0){?>
                <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <?php }?>
            <a href="<?= $b['url']; ?>" <?php if($i+1==sizeof($breadcrumb)){?>class="breadcrumb--active"<?php }?>>
                <?= $b['display'] ?>
            </a>
        <?php }?>
    </div>
<?php }?>

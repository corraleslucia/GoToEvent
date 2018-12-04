<?php
if ($categories)
{
    foreach ($eventsByCategory as $category => $events)
    { ?>
        <div class="p-listev-plc" style="width: 100%">
            <p class="subtitle"><b><?php echo $category ?></b></p>
        </div>
        <?php
        if ($events)
        {
            foreach ($events as $key => $value)
            { ?>
                    <div class="element">
                        <?php if ($value->getid() != 0)
                        { ?>
                            <a class="link-divs "href="<?= BASE ?>event/showEventDetailsForUser/<?php echo $value->getId()?>">
                    <?php } ?>
                         <div class="div-img">
                            <?php
                            if ($value->getPoster() != '0')
                            { ?>
                                <img src="<?= IMG_UPLOADS . '/event/' . $value->getPoster() ?>" class="img-list-event" />
                            <?php
                            }?>
                        </div>
                        <div class="p-listev-art">
                            <p style="font-size:22px"><b><?php  echo $value->getDescription()?></b></p>
                        </div>
                    </a>
                    </div>

      <?php }
        }
        else
        { ?>
            <div class="element">
                <div class="p-listev-plc">
                    <p style="font-size:22px"><b>SIN EVENTOS</b></p>
                </div>
            </div>

    <?php
        }
    }
} ?>

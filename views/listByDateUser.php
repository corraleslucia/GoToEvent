<?php
if ($dates)
{
    foreach ($eventsByDate as $date => $events)
    { ?>
        <div class="p-listev-plc" style="width: 100%">
            <p class="subtitle"><b><?php echo $date ?></b></p>
        </div>
    <?php
        foreach ($events as $key => $value)
        { ?>
                <div class="element">
                    <?php if ($value->getid() != 0)
                    { ?>
                    <a class="link-divs "href="<?= BASE ?>event/showEventDetailsForUser/<?php echo $value->getId()?>">
                    <?php } ?>
                        <div class="div-img">
                            <img src="<?= IMG_UPLOADS . '/event/' . $value->getPoster() ?>" class="img-list-event" />
                        </div>
                        <div class="p-listev-art">
                            <p style="font-size:22px"><b><?php  echo $value->getDescription()?></b></p>
                        </div>
                    </a>
                </div>

  <?php }
    }
} ?>

<?php
if ($locations)
{
    foreach ($eventsByLocation as $city => $events)
    { ?>
        <div class="p-listev-art">
        <p style="font-size:22px"><b><?php echo $city ?></b></p>
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
                <div class="p-listev-art">
                    <div class="">
                        <img src="<?= IMG_UPLOADS . '/event/' . $value->getPoster() ?>" height="200" />
                    </div>
                    <p style="font-size:22px"><b><?php  echo $value->getDescription()?></b></p>
                </div>
                    </a>
                </div>
        <?php
            }
         }
         else
         { ?>
             <div class="element">
                 <div class="p-listev-art">
                     <p style="font-size:22px"><b>SIN EVENTOS</b></p>
                 </div>
             </div>
     <?php
         }
     }
} ?>

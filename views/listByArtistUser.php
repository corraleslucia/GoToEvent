<?php
if ($artists)
{
    foreach ($eventsByArtists as $artist => $events)
    { ?>
        <div class="p-listev-art">
        <p style="font-size:22px"><b><?php echo $artist ?></b></p>
        </div>
    <?php
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
  <?php }
    }
} ?>

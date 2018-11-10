<?php
    foreach ($eventsByLocation as $city => $events)
    { ?>
        <div class="p-listev-art">
        <p style="font-size:22px"><b><?php echo $city ?></b></p>
        </div>
    <?php
        foreach ($events as $key => $value)
        { ?>
                <div class="element">
                    <?php if ($value->getid() != 0)
                    { ?>
                        <a class="link-divs "href="<?= BASE ?>event/showEventDetails/<?php echo $value->getId()?>">
              <?php } ?>
                    <div class="p-listev-art">
                        <p style="font-size:22px"><b><?php  echo $value->getDescription()?></b></p>
                    </div>
                </a>
                </div>

  <?php } ?>
<?php } ?>

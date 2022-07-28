<?php if(isset($message) && $message instanceof Message): ?>
    <div class="row">
        <div class="col s12 m12">
            <div class="card <?= $message->getColor() ?>">
                <div class="card-content white-text">
                        <span class="card-title">
                            <?= $message->getTitle() ?>
                        </span>
                    <p><?= $message->getMessage() ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
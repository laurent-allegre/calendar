





                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Titre</label>
                            <input id="name" type="text" required class="form-control" name="name" value="<?= isset($data['name']) ? h($data['name']) : ''; ?>">
                            <?php if (isset($errors['name'])): ?>
                                <small class="form-text text-muted"><?= $errors['name']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input id="date" type="date" required class="form-control" name="date" value="<?= isset($data['date']) ? h($data['date']) : ''; ?>">
                            <?php if (isset($errors['date'])): ?>
                                <small class="form-text text-muted"><?= $errors['date']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="start">Heure de Démarrage</label>
                            <input id="start" type="time" required class="form-control" name="start" placeholder="HH:MN" value="<?= isset($data['start']) ? h($data['start']) : ''; ?>">
                            <?php if (isset($errors['start'])): ?>
                                <small class="form-text text-muted"><?= $errors['start']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="end">Heure de Fin</label>
                            <input id="end" type="time" required class="form-control" name="end" placeholder="HH:MN" value="<?= isset($data['end']) ? h($data['end']) : ''; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control"><?= isset($data['description']) ? h($data['description']) : ''; ?>  </textarea>
                </div>




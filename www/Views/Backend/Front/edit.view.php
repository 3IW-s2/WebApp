<?php
use App\Core\API;

$api = new API();
$fonts = $api->callAPI('GET', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBnK1LDpYGaK-4-xSXcMdqkWOH1Dxaen1o', false);

$fonts = json_decode($fonts, true);


foreach ($fonts['items'] as $font) {
    $allFonts[] = $font['family'];
}

?>

<main>
    <div class="container" style="width: 50%;">
        <div class="div-center">
            <section id="course" class="course">
                <div class="row">
                    <div class="course-col">

                        <div class = "title text-center">
                            <h2 class = "position-relative d-inline-block">Modification du style du site</h2>
                        </div>
                        <!-- un formulaire d'inscription -->
                        <form id="update-register-form" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $front['id'] ?>">
                                <label for="font">Police</label>
                                <select name="font" id="font">
                                    <option value="<?= $front['font'] ?>"><?= $front['font'] ?></option>
                                    <?php
                                    foreach ($allFonts as $font) {
                                        echo '<option value="'.$font.'">'.$font.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="font">Epaisseur de la police</label>
                                <select name="font_weight" id="font_weight">
                                    <option value="light">Light</option>
                                    <option value="normal">Normal</option>
                                    <option value="bold">Bold</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="primary_color">Couleur primaire</label>
                                <input type="color" id="primary_color" name="primary_color"
                                       value="<?= $front['primary_color'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="primary_color">Couleur de la barre de navigation</label>
                                <input type="color" id="nav_color" name="nav_color"
                                       value="<?= $front['nav_color'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file"
                                       id="logo" name="logo"
                                       accept="image/png, image/jpeg, image/jpg">

                                <br><small>Formats accéptés : jpg, jpeg, png</small><br>
                                <small>Max : 2Mo</small>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </section>
            <br>
            <?php if (isset($errors)) { ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                    <p><?= $errors; ?></p>
                <?php endforeach; ?>
            </div>
            <?php } if (isset($success)) { ?>
            <div class="alert alert-success">
                <p><?= $success; ?></p>
            </div>
            <?php }; ?>
        </div>
    </div>
</main>
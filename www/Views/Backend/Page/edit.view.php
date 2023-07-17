
<!DOCTYPE html>
<html>
<head>
    <style>
        #gjs {
            border: 3px solid #444;
        }

        /* Réinitialisez certains styles par défaut */
        .gjs-cv-canvas {
            top: 0;
            width: 100%;
            height: 100%;
        }

        .gjs-block.gjs-one-bg.gjs-four-color-h {
            height: 150px;
            width: 100px;
        }

        
    </style>
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <script src="https://unpkg.com/grapesjs@0.21.2/dist/grapes.min.js"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>
    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script src="js/gjs.init.js"></script>

</head>
<body>

    <div id="gjs">
       <?= $posts["content"]?>
    </div>
    <div id="tab-content" class="tab-content">
        <div id="blocks"></div>
      </div>
    <!-- recuperer ce qu'il y'a dans la div gjs pour l'enregistrer dans la colomn content -->
    <form id="add-page-form" method="post" action="">
    <?php if(isset($errors)): ?> <div class="alert alert-danger">   <p><?php echo $errors; ?></p>      </div> <?php endif; ?>
                                            <input type="checkbox" name="active" <?php if ($posts["image_path"] === "on") echo "checked"; ?>>

                                            <input type="hidden" name="content" id="content" >
                                           
                                            <div class="form-group">
                                                <label for="email">slug</label>
                                                <input type="text" name="slug" id="slug" class="form-control"  value="<?= $posts["slug"]?>" />
                                            </div>
                                            <div class="form-group">
                                                <label for="articleType">articleType</label>
                                                <select name="articleType" id="articleType" class="form-control">
                                                    <option value="">Sélectionnez un type d'article</option> <!-- Option vide par défaut -->
                                                    <?php foreach($types as $articleType): ?>
                                                        <option value="<?= $articleType['id'] ?>" <?php if($articleType['id'] == $posts['category_id']) echo 'selected' ?>><?= $articleType['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                </form>

                                <div class="form-group">
                                <label for="history">Historique</label>
                                <ul>
                                 
                                    <?php foreach ($history as $entry): 
                                     $data = json_decode($entry["content"], true);
                                        ?>
                                    <div class="modal fade" id="exampleModal<?= $entry["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <?= $data["content"] ?>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                 
                                        <?php
                                        ?>         <br> _____<br>
                                        <li> le slug: <?=$data["slug"] ?></li>   
                                        <li> le status: <?=substr($data["content"], 0, 100) ?></li> 
                                        <form id="update-register-form" method="post" action="">
                                            <textarea id="content" name="content" class="hidden-textarea"><?= $data["content"] ?></textarea>
                                            <input type="hidden" name="slug" value="<?= $data["slug"] ?>" />
                                            <input type="hidden" name="status" value="<?= $data["status"] ?>" />
                                            <input type="hidden" name="author" value="<?= $data["author"] ?>" />
                                            <input type="hidden" name="articleType" value="<?= $data["articleType"] ?>" />
                                            <button type="submit" name="submit" class="btn btn-primary">Restore</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal<?= $entry["id"] ?>">
                                           tout voir
                                     </button>
                                    <?php endforeach; ?>
                                  
                                </ul>
                                </div>
    <script>
        const editor = grapesjs.init({
            container: "#gjs",
            fromElement: true,
            //width: "auto",
            storageManager: false,
            plugins: ["gjs-preset-webpage" , "gjs-blocks-basic"],
            pluginsOpts: {
                "gjs-preset-webpage": {},
                "gjs-blocks-basic": {},
            },
            blockManager: {
                appendTo: "#blocks",
                blocks: [
                    {
                        id: "section", // id is mandatory
                        label: "<b>Section</b>", // You can use HTML/SVG inside labels
                        attributes: { class: "gjs-block-section" },
                        content:
                            '<section><h1>This is a simple title</h1><div>This is just a Lorem text: Lorem ipsum dolor sit amet</div></section>',
                    },
                    {
                        id: "text",
                        label: "Text",
                        content: '<div data-gjs-type="text">Insert your text here</div>',
                    },
                    {
                        id: "image",
                        label: "Image",
                        // Select the component once it's dropped
                        select: true,
                        // You can pass components as a JSON instead of a simple HTML string,
                        // in this case we also use a defined component type `image`
                        content: { type: "image" },
                        // This triggers `active` event on dropped components and the `image`
                        // reacts by opening the AssetManager
                        activate: true,
                    },
                ],
            },
        });

        var content_first = editor.getHtml();
        document.getElementById("content").value = content_first;
        editor.on("change:changesCount", ( ) => {
            content = editor.getHtml();
            document.getElementById("content").value = content;
        }); 
        
        

        

    </script>
</body>
</html>

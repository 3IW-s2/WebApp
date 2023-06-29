
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

        .gjs-block {
            width: auto;
            height: auto;
            min-height: auto;
        }
    </style>
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <script src="https://unpkg.com/grapesjs@0.21.2/dist/grapes.min.js"></script>
</head>
<body>
    <div id="gjs">
       <?= $posts["content"]?>
    </div>
    <div id="blocks"></div>
    <!-- recuperer ce qu'il y'a dans la div gjs pour l'enregistrer dans la colomn content -->
    <form id="add-page-form" method="post" action="">
                                            <input type="hidden" name="content" id="content" value=>
                                           
                                            <div class="form-group">
                                                <label for="email">slug</label>
                                                <input type="text" name="slug" id="slug" class="form-control"  value="<?= $posts["slug"]?>" />
                                            </div>
                                        
                                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                </form>

                                <div class="form-group">
                                <label for="history">Historique</label>
                                <ul>
                                 
                                    <?php foreach ($history as $entry): 
                                     $data = json_decode($entry["content"], true);

                                        ?>         <br> _____<br>
                                        <li> le titre: <?=$data["title"] ?></li>
                                        <li> le slug: <?=$data["slug"] ?></li>    
                                        <form id="update-register-form" method="post" action="">
                                            <input type="hidden" name="title" value="<?= $data["title"] ?>" />
                                            <textarea id="content" name="content" class="hidden-textarea"><?= $data["content"] ?></textarea>
                                            <input type="hidden" name="slug" value="<?= $data["slug"] ?>" />
                                            <input type="hidden" name="status" value="<?= $data["status"] ?>" />
                                            <input type="hidden" name="author" value="<?= $data["author"] ?>" />
                                            <button type="submit" name="submit" class="btn btn-primary">Restore</button>
                                        </form>
                                    <?php endforeach; ?>
                                  
                                </ul>
                                </div>
    <script>
        const editor = grapesjs.init({
            container: "#gjs",
            fromElement: true,
            //width: "auto",
            storageManager: false,
            plugins: ["gjs-preset-webpage"],
            pluginsOpts: {
                "gjs-preset-webpage": {},
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

        //recupère ce qu'il y'a dans la div gjs et affiche le resultat dans la console utilise html()
        
        //content = editor.getHtml();
        //met à la valeur de content tous à chaque modification de la div gjs
        editor.on("change:changesCount", () => {
            content = editor.getHtml();
            document.getElementById("content").value = content;
        }); 
        
        //if isset $_POST['submit'] alors envoyer content comme valeur de la colomn content
        

        

    </script>
</body>
</html>

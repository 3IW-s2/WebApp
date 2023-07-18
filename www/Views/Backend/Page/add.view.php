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
<!--         <h1>Hello World Component!</h1>
 -->    </div>
     <div id="tab-content" class="tab-content">
        <div id="blocks"></div>
      </div>
    <!-- recuperer ce qu'il y'a dans la div gjs pour l'enregistrer dans la colomn content -->
    <form action="" method="post">
        <?php if(isset($errors)): ?>
            <div class="alert alert-danger">
                 <p><?php echo $errors; ?></p>
                        </div>
             <?php endif; ?>
         <input type="checkbox" name="active">   
         <input type="hidden" name="content" id="content">
         <input type="text" name="slug" id="slug">
         <div>
             <label for="articleType">articleType</label>
             <select name="articleType" id="articleType" class="form-control">
                 <option value="">Sélectionnez un type d'article</option> <!-- Option vide par défaut -->
                 <?php foreach($types as $articleType): ?>
                     <option value="<?= $articleType['id'] ?>"><?= $articleType['name'] ?></option>
                 <?php endforeach; ?>
             </select>
         </div>
         <button type="submit" name="submit" class="btn btn-primary">Register</button>

    </form>

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
                    }

                ],
            },
        });

        //recupère ce qu'il y'a dans la div gjs et affiche le resultat dans la console utilise html()
        editor.on("change:changesCount", () => {
            content = editor.getHtml() + "<style>" + editor.getCss() + "</style>";
            document.getElementById("content").value = content;
        }); 

        //ajoute au pan

    </script>
</body>
</html>

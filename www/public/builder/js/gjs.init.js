$( document ).ready(function() {

  var editor = grapesjs.init({
    fromElement: 1,
    container : '#gjs',
    allowScripts: 1,
    forceClass: false,
    storageManager: {
      type: 0, // Storage type. Available: local | remote
    },
    canvas: {
      styles: ['css/canvas.css'],
      scripts: []
    },
    canvasCss: `
    .gjs-selected {
      outline: 2px solid #000 !important;
    }
    `,
    blockManager: {
      appendTo: '#blocks'
    },
    styleManager: {
      appendTo: '#style-manager-container'
    },
    traitManager: {
      appendTo: '#traits-container',
    },
    plugins: ['gjs-blocks-basic','grapesjs-preset-webpage','grapesjs-plugin-forms',Traits,Component,Blocks,Commands,RTE],
    pluginsOpts: {
      'grapesjs-preset-webpage': {
      },
      'gjs-blocks-basic':{
      },
      'grapesjs-plugin-forms': {
      }
    }
  });
  editor.Panels.getButton('options', 'sw-visibility').set('active', false);
  editor.Panels.getButton('views', 'open-blocks').set('active', true)
  //editor.Panels.removeButton('options', 'export-template');
  editor.Panels.removeButton('options', 'fullscreen');
  editor.Panels.removeButton('options', 'preview');
  //editor.Panels.removeButton('options', 'gjs-open-import-webpage');

  //remove uneeded body wrapper from mjml
  editor.getWrapper().toHTML = function(opts) {
    return this.getInnerHTML(opts);
  };

  //open style manager once block is dropped or clicked
  editor.on('block:drag:stop, component:selected', function(model) {
    let tagName = model?.attributes?.tagName;
    if (tagName && tagName != "mj-section"){
      window.openPanel("styles");
    }
  });

  //prevent janky rendering
  editor.on('load', function() {
    document.getElementById("gjs").style.display = "block";
  })

  setTimeout(() => {
    // Collapsed Category in Blocks
    const categories = editor.BlockManager.getCategories()
    categories.each(category => {
        category.set('open', false).on('change:open', opened => {
            opened.get('open') && categories.each(category => {
                category !== opened && category.set('open', false)
            })
        })
    })
}, 100);

  editor.Panels.removePanel('views');
  window.editor = editor;
});
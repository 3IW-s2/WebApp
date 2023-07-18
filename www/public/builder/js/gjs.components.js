function Component(editor){

  const dc = editor.DomComponents;

  //Column type extended
  dc.addType('wrapper', {
    extend: 'wrapper',
    model: {
      defaults: {
        name: 'Body', // you can rename columns there
        selectable: false,
        hoverable: false
      },
    },
  });

}
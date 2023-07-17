function Commands(editor){

    const cm = editor.Commands;

    cm.add('button:default', {
        run(editor) {
            editor.stopCommand('button:full');
            const comp = editor.getSelected();
            comp.addStyle({ width: '' });
        },
        stop(editor) {
            return;
        },
    });

    cm.add('button:full', {
        run(editor) {
            editor.stopCommand('button:default');
            const comp = editor.getSelected();
            comp.addStyle({ width: '100%' });
        },
        stop(editor) {
            return;
        },
    });
}
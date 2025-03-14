<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Editor.js</title>
        <link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">
        <script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
        <script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>
        <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>

    </head>
    <body>
    <h1>Editor.js</h1>
    <textarea id="id_here" name="name_here" hidden></textarea>
    <script>
        const myBlock =  {
            title: 'My First Block!',
            icon: 'universal-access-alt',
            category: 'my-category',

            edit() {
                return '<h1>Hello editor.</h1>'
            },

            save() {
                return '<h1>Hello saved content.</h1>'
            }
        }

        Laraberg.registerBlockType('my-namespace/my-block', myBlock)
        const option = {
            fontSizes:[{'xs':12},{'s':14},{'base':16}]
        }
        Laraberg.init('id_here');
    </script>
    </body>
</html>


<!--plantillas: Layouts por compomenetes de blade
para usuarios autenticados
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
     content="width=device-width, initial-scale=1.0">
    <title>Aprendible - {{ $title ?? '' }} </title>
    <meta name="descripcion"
        content="{{ $metaDescription ?? 'Default meta description'}}" /> {{-- para definir propiedades usamos camel Case --}}
    {{-- Aplicar estilos css en proyectos --}}
    {{-- Agregar css y jscrip sin herramientas adicionales --}}
        {{-- Primero tenemos que tener claro qu epos seguridad la unica carpte accesible por el navedador es public --}}
        {{-- public es la raiz de la aplicacion, cuando accesdemos al diminio (http://laravel-9.test)
            el servidor apunta a la carpeta public y ejecuta el archivo index.php, que sde encarga de levantar el framework,
            y direccionar la peticion a la ruta y controlador correspondiente
            --}}
        {{-- Como esta carpeta es publica podriamos crear la carpeta css con un archivo app.css donde agregamso lo sestilos
            y la carpeta js con el archivo app.js donde agregamos los jscript. Despues de eso hay que vincularlos
            a los componentes layouts, en este caso como ejemplo a app.blade.php y en el head agregamos
            los estilos y jscript. Podemos agregar cualquier libreria css o jscript que queramos utilizar
            o incluso agregarlos desde un CDN.
              --}}
            {{-- <link rel="stylesheet" href="/css/app.css">
                <script src="/js/app.js"></script> --}}
    {{-- Que pasa si queremos usas SASS para escribir css o queramos utilizar algun framework que requiera compilacion
        ahi es donde utilizamos Vite:  es una herramienta de compilación qu epermite desarollo mas rapido y agil para prtoyectos web modernos
        --}}
        {{-- Implementacion de Vite: --}}
        {{-- Cuando instalamos una nueva aplicacion de Laravel al revisasr la carpeta resources, nos encontramos con 2 carpetas:
            css y js, con sus respectivos archivos. Cualquier modificacion que realicemos en esos archivos no se va a ver
            replejada, debido a que son archivos fuentes y no podemos vincularlos a public.
            Para ello devemos configurar Vite para que compile estos archivos y su resultado lo ubique en public
            Configuracion:
            Tenemos un archivo llamado vite.config.js en la raiz de la apliacion, la configuracion que viene por defecto
            es suficiente para que funcione.Basicamente le estamos indicando donde estan los archivos ccs y js para Laravel.
            Hay que intalar las dependencias de NPM, hay que tener instalado nodejs ( ejecutar comando node -v, en terminal)
            Junto con nodejs viene npm (manejador de paquetes js) y con el podemos instalar las dependencias que vienen
            en el archivo pakage.json, con el comando npm install, esto nos crea una carpeta node_modules con las
            dependencias de js y entre ellas Vite y el plugin de laravel para Vite
            Una vez instaladas las dependencias podemos ejecutar el comando npm run dev, para levantar el servidor de Vite
            vemos la url del servidor y la de nuestra aplicacion de laravel, este valor se optiene del archivo .env
            variable APP_URL= .
            Solo falta vincular los assets a archivos de css y js, con la directiva @vite
            Una vez que terminemos de desarrollar ctrl+c cierra el servidor Vite. Pero los cambios dejaran de aplicarse
            para ello deberemos ejecutar npm run build, para que compile los archivos de css y js y los coloque en public
            dentro de la carpeta build/assets
             --}}
            @vite(['resources/css/app.css','resources/js/app.js'])

            {{-- Utilizar bootstrap --}}
            {{-- instalar bootstrap : intruccion npm i bootstrap --save-dev, para instalarlo y guardarlo
                 en las dependencias de desarrollo (dev)
                 No pude instalar da errores--}}

            {{-- Tailwind css --}}
            {{-- Ejecutar:
                npm install -D tailwindcss postcss autoprefixer
                npx tailwindcss init -p
            En archivo tailwind.config.js agregar en
            contenet:[
                "./resources/**/*.blade.php",
                "./resources/**/*.js",
                "./resources/**/*.vue",
            ]
            En archivo ./resources/css/app.css agregar:
            @tailwind base;
            @tailwind components;
            @tailwind utilities;
            y despues iniciar el servidor Vite
            npm run dev
            Instalar plugin para formularios:
            npm i @tailwindcss/forms --sace-dev
            Ir al archivo de configuracion de Tailwin
            tailwind.config.js, y registrar el plugin
            plugins: [require('@tailwindcss/forms')]
            --}}

</head>
<body class="antialiased bg-slate-100 dark:bg-slate-900">

<x-layouts.navigation />

{{-- traer el mensaje de session()->flash() --}}
{{-- esos mensaje tienen un estructura html con clase ssc --}}
{{-- este mensaje se muestra solo en este archivo --}}
@if (session('status'))
    {{-- {{-- mostrar si el mensaje existe  --}}
    <div class="max-w-screen-xl px-3 py-2 mx-auto font-bold text-white
            sm:px-6 lg:px-8 bg-emerald-500 dark:bg-emerald-700">
        {{ session('status') }}
    </div>


@endif

{{ $slot  }}

</body>
</html>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div>
        Hello World
    </div>

</x-app-layout> --}}


<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Hello World</h1>

    {{ Auth::user() }}
    {{ Auth::id() }}

    <?php

        $user = Auth::user();
        echo $user;
        echo "<br/>";
        echo $user->id;
        echo "<br/>";
        echo $user->name;
        echo "<br/>";
        echo $user->email;
        echo "<br/>";
        echo $user->password;
        echo "<br/>";


    ?>


</body>
</html>

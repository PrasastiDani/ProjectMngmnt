<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script>
        // Selalu pastikan tema cerah
        document.documentElement.classList.remove('dark');

        // Jika sebelumnya ada preferensi di localStorage, hapus agar tidak berpengaruh
        localStorage.removeItem('color-theme');
    </script>


</head>

<body class="bg-gray-900">
    @yield('content')

    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            const passwordField = document.getElementById("floating_password");
            const eyeIcon = document.getElementById("eyeIcon");
            const eyeOffIcon = document.getElementById("eyeOffIcon");

            // Toggle the type of password input field
            if (passwordField.type === "password") {
                passwordField.type = "text"; // Show the password
                eyeIcon.classList.add("hidden"); // Hide the eye icon
                eyeOffIcon.classList.remove("hidden"); // Show the eye-off icon
            } else {
                passwordField.type = "password"; // Hide the password
                eyeIcon.classList.remove("hidden"); // Show the eye icon
                eyeOffIcon.classList.add("hidden"); // Hide the eye-off icon
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>

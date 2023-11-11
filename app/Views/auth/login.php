<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMS-PPBOB</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Left Panel (Form) -->
        <div class="w-1/2 bg-white flex items-center justify-center">
            <div class="w-full max-w-sm p-8">
                <img class="mx-auto h-10 w-auto" src="<?php echo base_url('img\Logo.png'); ?>" alt="Your Company">
                <h2 class="mt-6 text-center text-xl font-semibold text-gray-900">Lengkapi data untuk membuat akun</h2>

                <!-- Display validation errors -->
                <?php if (session()->has('validation_errors')) : ?>
                    <div class="alert alert-danger">
                        <?php foreach (session('validation_errors') as $error) : ?>
                            <?= esc($error) ?><br>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>

                <!-- Display error message -->
                <?php if (session()->has('error_message')) : ?>
                    <div class="alert alert-danger">
                        <?= esc(session('error_message')) ?>
                    </div>
                <?php endif ?>

                <form class="mt-8 space-y-6" action="<?= base_url('login');?>" method="POST">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="relative">
                            <input id="email" name="email" type="email" placeholder="Masukan email anda" autocomplete="email" required class="w-full py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-indigo-600 sm:text-sm">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" placeholder="Buat Password" autocomplete="new-password" required class="w-full py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-indigo-600 sm:text-sm">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-lock text-gray-400"></i>
                            </span>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full py-2 px-4 text-white bg-red-600 rounded-md font-semibold hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 focus:ring-inset">Masuk</button>
                    </div>
                </form>

                <p class="mt-6 text-center text-sm text-gray-500">
                    Belum punya akun? registrasi <a href="register" class="text-red-600 hover:text-red-500 font-semibold">di sini</a>
                </p>
            </div>
        </div>

        <!-- Right Panel (Image) -->
        <div class="w-1/2 bg-cover bg-center" style="background-image: url('<?php echo base_url('img\Illustrasi Login.png'); ?>');"></div>
    </div>
</body>
</html>
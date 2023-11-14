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
                <img class="mx-auto h-10 w-auto" src="<?php echo base_url('img/Logo.png'); ?>" alt="Your Company">
                <h2 class="mt-6 text-center text-xl font-semibold text-gray-900">Masuk atau buat akun untuk memulai</h2>
                
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

                <form class="mt-8 space-y-6" action="<?= base_url('register'); ?>" method="POST">
                    <div>
                        <div class="relative">
                            <input name="email" type="email" placeholder="Masukan email anda" autocomplete="email" required class="w-full py-2 pl-8 pr-3 text-gray-900 rounded-md border <?= isset($validation) && $validation->hasError('email') ? 'border-red-500' : 'border-gray-300' ?> placeholder-gray-400 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-indigo-600 sm:text-sm">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </span>
                        </div>
                        <?php if (isset($validation) && $validation->hasError('email')) : ?>
                            <p class="text-red-500 text-xs"><?= $validation->getError('email') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <div class="relative">
                            <input name="first_name" type="text" placeholder="Nama Depan" autocomplete="given-name" required class="w-full py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-indigo-600 sm:text-sm">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-user text-gray-400"></i>
                            </span>
                        </div>
                    </div>

                    <div>
                        <div class="relative">
                            <input name="last_name" type="text" placeholder="Nama Belakang" autocomplete="family-name" required class="w-full py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-indigo-600 sm:text-sm">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-user text-gray-400"></i>
                            </span>
                        </div>
                    </div>

                    <div>
                        <div class="relative">
                            <input name="password" type="password" placeholder="Buat Password" autocomplete="new-password" required class="w-full py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-indigo-600 sm:text-sm">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-lock text-gray-400"></i>
                            </span>
                        </div>
                    </div>

                    <div>
                        <div class="relative">
                            <input name="confirm_password" type="password" placeholder="Konfirmasi Password" autocomplete="new-password" required class="w-full py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-indigo-600 sm:text-sm">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-lock text-gray-400"></i>
                            </span>
                        </div>
                    </div>

                    <div>
                    <button type="submit" class="w-full py-2 px-4 text-white bg-red-600 rounded-md font-semibold hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 focus:ring-inset">Registrasi</button>
                    </div>
                </form>


                <p class="mt-6 text-center text-sm text-gray-500">
                    Sudah punya akun? Login <a href="login" class="text-red-600 hover:text-red-500 font-semibold">di sini</a>
                </p>
            </div>
        </div>

        <!-- Right Panel (Image) -->
        <div class="w-1/2 bg-cover bg-center" style="background-image: url('<?php echo base_url('img/Illustrasi Login.png'); ?>');"></div>
    </div>
</body>
</html>

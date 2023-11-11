<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMS-PPBOB</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>
<body>
    <header>
    <!-- Navbar Container -->
    <div class="p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo and Icon (Kiri) -->
            <div class="flex items-center space-x-2">
                <img src="<?php echo base_url('img/Logo.png'); ?>" alt="" class="h-8 w-8">
                <a href="dashboard" class="text-3xl font-bold">SIM PPOB</a>
            </div>

            <!-- Tautan (Kanan) -->
            <div class="space-x-4">
                <a href="isitopup" class="">Top Up</a>
                <a href="transaksi" class="">Transaction</a>
                <a href="akun" class="">Akun</a>
            </div>
        </div>
    </div>
    <hr>
    
    <div class="p-8 flex flex-col justify-center items-center sm:w-full md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto">
        <!-- Profile Photo and Name -->
        <div class="mb-4 text-center">
            <label for="profileImageInput" class="cursor-pointer">
                <?php if (!empty($profileData['data']['profile_image'])) : ?>
                    <img
                        id="profileImagePreview"
                        src="<?php echo $profileData['data']['profile_image']; ?>"
                        alt="Foto Profile"
                        class="w-16 h-16 mx-auto rounded-full mb-2"
                    />
                <?php else : ?>
                    <!-- Provide a default image or handle the case where profile_image is empty -->
                    <img
                        id="profileImagePreview"
                        src="img\Profile Photo.png"
                        alt="Foto Profile"
                        class="w-16 h-16 mx-auto rounded-full mb-2"
                    />
                <?php endif; ?>
            </label>

            <p class="text-lg font-semibold">
                <?php if (!empty($profileData['data']['first_name']) && !empty($profileData['data']['last_name'])) : ?>
                    <?php echo $profileData['data']['first_name'] . ' ' . $profileData['data']['last_name']; ?>
                <?php else : ?>
                    <!-- Handle the case where either 'first_name' or 'last_name' is null or not set -->
                    Name Not Available
                <?php endif; ?>
            </p>
        </div>

        <!-- Input for selecting a new profile image -->
        <input
            type="file"
            id="profileImageInput"
            accept=".jpeg, .jpg, .png"
            style="display: none;"
            onchange="updateProfileImage()"
        />

        <script>
            function updateProfileImage() {
                const profileImageInput = document.getElementById('profileImageInput');
                const profileImagePreview = document.getElementById('profileImagePreview');

                const file = profileImageInput.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('file', file, file.name);

                fetch('https://take-home-test-api.nutech-integrasi.app/profile/image', {
                    method: 'PUT',
                    headers: {
                        'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InVzZXJAbnV0ZWNoLWludGVncmFzaS5jb20iLCJtZW1iZXJDb2RlIjoiTExLUjZKTDEiLCJpYXQiOjE2OTk1ODkwNTcsImV4cCI6MTY5OTYzMjI1N30.6jwk7WXv_bexZue07VsNZ7qvN2W4KpXRdtFrzjC29b4', // Replace with your actual JWT token
                    },
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);

                        // Update the profile image on the page
                        profileImagePreview.src = data.data.profile_image;
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Trigger file input click when the profile image is clicked
            const profileImagePreview = document.getElementById('profileImagePreview');
            const profileImageInput = document.getElementById('profileImageInput');

            profileImagePreview.addEventListener('click', () => {
                profileImageInput.click();
            });
        </script>

        <!-- Input Fields -->
        <div class="relative mb-4 flex flex-col items-start">
            <label class="font-semibold mb-1">Email</label>
            <div class="relative">
                <input id="email" name="email" type="text" value="<?php echo !empty($profileData['data']['email']) ? $profileData['data']['email'] : ''; ?>" autocomplete="given-name" required class="w-full sm:w-96 py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-red-600 sm:text-sm">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-envelope text-gray-400"></i>
                </span>
            </div>
        </div>

        <div class="relative mb-4 flex flex-col items-start">
            <label class="font-semibold mb-1">Nama Depan</label>
            <div class="relative">
                <input id="first_name" name="first_name" type="text" value="<?php echo !empty($profileData['data']['first_name']) ? $profileData['data']['first_name'] : ''; ?>" autocomplete="given-name" required class="w-full sm:w-96 py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-red-600 sm:text-sm">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-user text-gray-400"></i>
                </span>
            </div>
        </div>

        <div class="relative mb-4 flex flex-col items-start">
            <label class="font-semibold mb-1">Nama Belakang</label>
            <div class="relative">
                <input id="last_name" name="last_name" type="text" value="<?php echo !empty($profileData['data']['last_name']) ? $profileData['data']['last_name'] : ''; ?>" autocomplete="given-name" required class="w-full sm:w-96 py-2 pl-8 pr-3 text-gray-900 rounded-md border border-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-inset focus:border-red-600 sm:text-sm">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-user text-gray-400"></i>
                </span>
            </div>
        </div>

        <!-- Buttons with matching widths to input fields -->
        <div class="relative mb-4">
            <button type="button" id="editButton" class="w-full sm:w-96 py-2 px-4 border rounded-md font-semibold hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 focus:ring-inset" onclick="toggleButtons(true)">Edit Profile</button>
        </div>

        <div class="relative mb-4">
            <button type="button" id="logoutButton" class="w-full sm:w-96 py-2 px-4 text-white bg-red-600 rounded-md font-semibold hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 focus:ring-inset" onclick="logout()">Logout</button>
        </div>

        <div class="relative">
            <input id="edited" name="edited" type="hidden" value="false">
            <button type="button" id="saveButton" class="w-full sm:w-96 py-2 px-4 text-white bg-red-600 rounded-md font-semibold hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 focus:ring-inset" style="display: none;" onclick="saveProfile()">Simpan</button>
        </div>
    </div>
    
    <!-- Somewhere in your HTML, set the JWT token as a data attribute on an element -->
    <div id="jwtToken" data-token="<?php echo session('jwt'); ?>"></div>
    
    <script>
        function toggleButtons(showSaveButton) {
            document.getElementById('editButton').style.display = showSaveButton ? 'none' : 'block';
            document.getElementById('logoutButton').style.display = showSaveButton ? 'block' : 'none';
            document.getElementById('saveButton').style.display = showSaveButton ? 'block' : 'none';
        }

        function logout() {
            // Menghapus session yang disimpan
            sessionStorage.clear();

            // Mengarahkan ke halaman login
            window.location.href = 'login'; // Ganti dengan URL halaman login yang sebenarnya
        }

        // Access the JWT token from the data attribute
        const jwtTokenElement = document.getElementById('jwtToken');
        const jwtToken = jwtTokenElement ? jwtTokenElement.getAttribute('data-token') : null;

        function saveProfile() {
            const email = document.getElementById('email').value;
            const first_name = document.getElementById('first_name').value;
            const last_name = document.getElementById('last_name').value;

            fetch('https://take-home-test-api.nutech-integrasi.app/profile', {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + jwtToken,
                },
                body: JSON.stringify({
                    email: email,
                    first_name: first_name,
                    last_name: last_name,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 0) {
                        // Success notification
                        toastr.success(data.message);
                    } else {
                        // Error notification
                        toastr.error(data.message);
                    }

                    toggleButtons(false);
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle network errors or other issues
                });
        }
    </script>

    <footer>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    </footer>
</body>
</html>
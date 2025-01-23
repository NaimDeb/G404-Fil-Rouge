<?php
require_once "./components/htmlstart.php";
require_once "./components/header.php";


if (!isset($_SESSION["user"])) {
    header("location: ./home.php");
    die();
}

$username = $user->getUserName();
$user_image = $user->getUserDetails()->getImg_url();
$user_desc = $user->getProfile_description();
$user_role = $user->getRole();
$userMail = $user->getMail();


// Si la description est null, on affiche un message par défaut
if ($user_desc == null) {
    $user_desc = "Complétez votre profil avec une petite description !";
};

$isProfessional = false;

$user_FirstName = $user->getUserDetails()->getFirstName();
$user_LastName = $user->getUserDetails()->getLastName();
$user_Address = $user->getUserDetails()->getAddress();
$user_Phone = $user->getUserDetails()->getPhone();
$user_Country = $user->getUserDetails()->getCountry();





// Si l'utilisateur est un professionnel, on récupère les données.
if ($user->getProfessionalDetails() != null) {
    $user_professional = $user->getProfessionalDetails();
    $company_name = $user_professional->getCompany_name();
    $company_address = $user_professional->getCompany_address();
    $company_phone = $user_professional->getCompany_phone();
    $isProfessional = true;
}



?>

<main class="bg-primary-beige">
    <!-- Section profil -->
    <section class="w-full min-h-[35vh] bg-primary-green flex flex-col my-8 py-4">

        <!-- Profile picture container -->
        <div class="text-neutral-off-white bg-green-500 p-2 text-center hidden" id="responseMessage"></div>
        <div class="relative w-fit m-auto">
            <!-- Display user's profile picture -->
            <img src="./assets/images/users/<?= $user_image ?>" alt="Photo de l'utilisateur" class="w-[100px] h-[100px] rounded-full m-auto backdrop-brightness-50 my-8">


            <!-- Form to change profile picture, hidden by default -->
            <form id="changeProfilePictureForm" method="POST" action="../process/process_changeProfilePicture.php" enctype="multipart/form-data" class="hidden">
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="submitProfilePictureForm()">
            </form>

            <!-- Button to trigger profile picture change -->
            <button id="changeProfilePictureBtn" title="Changer la photo de profil" class="bg-neutral-off-white text-primary-green rounded-full p-2 text-sm m-auto absolute bottom-6 right-0" onclick="document.getElementById('profile_picture').click();">
                <i class="fas fa-pen"></i>
            </button>
        </div>

        <!-- Username and description container -->
        <div class="flex flex-col items-center gap-2 mb-4">
            <!-- Display username and role -->
            <p class="text-2xl font-bold text-neutral-off-white font-merriweather">
                <?php
                echo $username;
                if ($isProfessional) {
                    echo "<i title='Professionel' class='fas fa-check p-2'></i>";
                }
                ?>
            </p>

            <!-- Profile description container -->
            <div class="max-w-[80%] bg-neutral-off-white text-primary-green rounded-lg rounded-tl-none font-open-sans relative">
                <!-- Display profile description -->
                <p id="profile_desc" class="font-light py-2 px-4 text-sm"><?= $user_desc ?></p>

                <!-- Form to change profile description, hidden by default -->
                <form id="changeDescForm" method="POST" action=../process/process_changeProfileDesc.php" class="hidden">
                    <input type="text" name="profile_desc" id="profile_desc_input" class="font-light py-2 px-4 text-sm w-full" value="<?= $user_desc ?>">
                    <button type="submit" class="bg-primary-green text-neutral-off-white rounded-full p-2 text-sm m-auto">
                        <i class="fas fa-check"></i>
                    </button>
                </form>

                <!-- Button to trigger profile description change -->
                <button id="changeDescBtn" title="Changer la description" class="bg-neutral-off-white text-primary-green rounded-full p-2 text-sm m-auto absolute bottom-0 right-0" onclick="toggleDescForm()">
                    <i class="fas fa-pen"></i>
                </button>


            </div>
        </div>
    </section>

    


    <section class="flex justify-between gap-8 flex-wrap px-8">
        <!-- Form to change user -->
        <form method="POST" action="../process/process_changeUser.php" class="border-gray-400 border-[2px] shadow-sm w-full max-w-lg mx-auto bg-neutral-off-white p-8 rounded-lg mb-8">
            <p class="text-xl font-bold font-merriweather text-primary-green mb-4"> Informations de compte </p>
            <div class="mb-4">
                <label class="block text-primary-green text-sm font-bold mb-2" for="username">Nom d'utilisateur</label>
                <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="username" id="username" type="text" value="<?= $username ?>" placeholder="Nom d'utilisateur">
            </div>
            <div class="mb-4">
                <label class="block text-primary-green text-sm font-bold mb-2" for="user_mail">Email</label>
                <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="user_mail" id="user_mail" type="email" value="<?= $userMail ?>" placeholder="Email">
            </div>
            <div class="mb-4">
                <label class="block text-primary-green text-sm font-bold mb-2" for="old_password">Ancien mot de passe</label>
                <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="old_password" id="old_password" type="password" placeholder="Ancien mot de passe">
            </div>
            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label class="block text-primary-green text-sm font-bold mb-2" for="new_password">Nouveau mot de passe</label>
                    <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="new_password" id="new_password" type="password" placeholder="Nouveau mot de passe">
                </div>
                <div class="w-1/2">
                    <label class="block text-primary-green text-sm font-bold mb-2" for="confirm_password">Confirmer le mot de passe</label>
                    <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="confirm_password" id="confirm_password" type="password" placeholder="Confirmer le mot de passe">
                </div>
            </div>
            <!-- Bouton confirmer -->
            <div class="flex justify-end">
                <button class="px-4 py-2 bg-primary-green text-neutral-off-white font-semibold rounded-md hover:brightness-110 " type="submit">Confirmer les changements</button>
            </div>
        </form>

        <!-- Form user details -->
        <form method="POST" action="../process/process_changeUserDetails.php" class="border-gray-400 border-[2px] shadow-sm w-full max-w-lg mx-auto bg-neutral-off-white p-8 rounded-lg mb-8">
            <p class="text-xl font-bold font-merriweather text-primary-green mb-4"> Informations personnelles </p>

            <div class="mb-4">
                <label class="block text-primary-green text-sm font-bold mb-2" for="firstName">Prénom</label>
                <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="firstName" id="firstName" type="text" value="<?= $user_FirstName ?>" placeholder="Prénom">
            </div>
            <div class="mb-4">
                <label class="block text-primary-green text-sm font-bold mb-2" for="lastName">Nom</label>
                <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="lastName" id="lastName" type="text" value="<?= $user_LastName ?>" placeholder="Nom">
            </div>
            <div class="mb-4">
                <label class="block text-primary-green text-sm font-bold mb-2" for="address">Adresse</label>
                <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="address" id="address" type="text" value="<?= $user_Address ?>" placeholder="Adresse">
            </div>
            <div class="mb-4">
                <label class="block text-primary-green text-sm font-bold mb-2" for="phone">Téléphone</label>
                <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="phone" id="phone" type="text" value="<?= $user_Phone ?>" placeholder="Téléphone">
            </div>
            <div class="mb-4">
                <label class="block text-primary-green text-sm font-bold mb-2" for="country">Pays</label>
                <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name="country" id="country" type="text" value="<?= $user_Country ?>" placeholder="Pays">
            </div>
            <!-- Bouton confirmer -->
            <div class="flex justify-end">
                <button class="px-4 py-2 bg-primary-green text-neutral-off-white font-semibold rounded-md hover:brightness-110 " type="submit">Confirmer les changements</button>
            </div>
        </form>

        <?php if ($isProfessional) : ?>
            <!-- form pro_details -->
            <form method="POST" action="../process/process_changeProfessionalDetails.php" class="border-gray-400 border-[2px] shadow-sm w-full max-w-lg mx-auto bg-neutral-off-white p-8 rounded-lg mb-8">
                <p class="text-xl font-bold font-merriweather text-primary-green mb-4"> Informations d'entreprise </p>

                <div class="mb-4">
                    <label class="block text-primary-green text-sm font-bold mb-2" for="company_name">Nom de l'entreprise</label>
                    <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" id="company_name" name="company_name" type="text" value="<?= $company_name ?>" placeholder="Nom de l'entreprise">
                </div>
                <div class="mb-4">
                    <label class="block text-primary-green text-sm font-bold mb-2" for="company_address">Adresse de l'entreprise</label>
                    <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" id="company_address" name="company_address" type="text" value="<?= $company_address ?>" placeholder="Adresse de l'entreprise">
                </div>
                <div class="mb-4">
                    <label class="block text-primary-green text-sm font-bold mb-2" for="company_phone">Téléphone de l'entreprise</label>
                    <input class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" id="company_phone" name="company_phone" type="text" value="<?= $company_phone ?>" placeholder="Téléphone de l'entreprise">
                </div>
                <!-- Bouton confirmer -->
                <div class="flex justify-end">
                    <button class="px-4 py-2 bg-primary-green text-neutral-off-white font-semibold rounded-md hover:brightness-110 " type="submit">Confirmer les changements</button>
                </div>
            </form>
        <?php endif; ?>
    </section>
</main>


<script>

    // Fonction pour envoyer le formulaire de changement de photo de profil
        async function submitProfilePictureForm() {


            var form = document.getElementById('changeProfilePictureForm');

            // Envoyer post
            var formData = new FormData(form);

            console.log(formData);
            


            try {
                const response = await fetch('../process/process_changeProfilePicture.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    const data = await response.text();
                    console.log("ça marche : " + data);
                    
                    document.getElementById('responseMessage').textContent = "Image changée avec succès";
                    document.getElementById('responseMessage').textContent = response;
                    document.getElementById('responseMessage').classList.remove = "hidden";
                }

            } catch (error) {
                // Gestion des erreurs réseau ou autres
                console.error('Erreur:', error);
                document.getElementById('responseMessage').textContent = 'Impossible de contacter le serveur.';
            }
        }


        // Fonction pour afficher/masquer le formulaire de changement de description
        function toggleDescForm() {
            var form = document.getElementById('changeDescForm');
            var desc = document.getElementById('profile_desc');
            var input = document.getElementById('profile_desc_input');

            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                desc.classList.add('hidden');
                input.focus();
            } else {
                form.classList.add('hidden');
                desc.classList.remove('hidden');
            }
        }
    </script>
<?php
require_once "./components/htmlstart.php";
require_once "./components/header.php";
?>

<main class="flex items-center justify-center bg-fit bg-cover bg-[url(../../assets/images/heropc.png)]">



    <!-- Formulaire d'inscription  -->
    <div class="w-[35%] min-h-[90vh] bg-primary-beige flex items-center justify-center px-10 py-8  shadow-lg">
        <form action="../process/process_inscription.php" method="POST" class="w-full space-y-6">

            <?php
                if (isset($_GET['error'])) {
                    $msg = '<div class="w-full bg-red-500 text-white text-center p-2 rounded-md">';

                    switch ($_GET['error']) {
                        case 'emptyfield':
                            $msg .= 'Veuillez remplir tous les champs';
                            break;
                        case 'invalidmail':
                            $msg .= 'Adresse email invalide';
                            break;
                        case 'invalidphone':
                            $msg .= 'Numéro de téléphone invalide';
                            break;
                        case 'mailtaken':
                            $msg .= 'Le mail est déja utilisé';
                            break;
                        case 'passwordsdontmatch':
                            $msg .= 'Les mots de passe ne correspondent pas';
                            break;
                        case 'mailtaken':
                            $msg .= 'Adresse email déjà utilisée';
                            break;
                        default:
                            $msg .= 'Erreur lors de l\'inscription';
                            break;
                    }

                    echo $msg . '</div>';
                }

            ?>

            <h2 class="text-2xl font-semibold text-center text-primary-green mb-6">Inscription</h2>

            <!-- Nom et Prénom en Flex (responsive) -->
            <div class="flex flex-col sm:flex-row sm:space-x-4">
                <div class="flex-1 flex flex-col">
                    <label for="firstName" class="text-sm font-semibold text-gray-600">Prénom</label>
                    <input type="text" id="firstName" name="firstName" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Votre prénom" required aria-required="true" aria-labelledby="firstName">
                </div>
                <div class="flex-1 flex flex-col mt-4 sm:mt-0">
                    <label for="lastName" class="text-sm font-semibold text-gray-600">Nom</label>
                    <input type="text" id="lastName" name="lastName" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Votre nom" required aria-required="true" aria-labelledby="lastName">
                </div>
            </div>

            <!-- Nom d'utilisateur -->
            <div class="flex flex-col">
                <label for="username" class="text-sm font-semibold text-gray-600">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Nom d'utilisateur" required aria-required="true" aria-labelledby="username">
            </div>

            <!-- Email en Flex -->
            <div class="flex flex-col sm:flex-row sm:space-x-4">
                <div class="flex-1 flex flex-col">
                    <label for="user_mail" class="text-sm font-semibold text-gray-600">Adresse email</label>
                    <input type="email" id="user_mail" name="user_mail" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Email" required aria-required="true" aria-labelledby="user_mail">
                </div>
            </div>

            <!-- Mot de passe et confirmation en Flex -->
            <div class="flex flex-col sm:flex-row sm:space-x-4">
                <div class="flex-1 flex flex-col">
                    <label for="user_password" class="text-sm font-semibold text-gray-600">Mot de passe</label>
                    <input type="password" id="user_password" name="user_password" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Mot de passe" required aria-required="true" aria-labelledby="user_password">
                </div>
                <div class="flex-1 flex flex-col mt-4 sm:mt-0">
                    <label for="confirmpassword" class="text-sm font-semibold text-gray-600">Confirmer le mot de passe</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Confirmer le mot de passe" required aria-required="true" aria-labelledby="confirmpassword">
                </div>
            </div>

            <!-- Adresse et Pays en Flex (responsive) -->
            <div class="flex flex-col sm:flex-row sm:space-x-4">
                <div class="flex-1 flex flex-col">
                    <label for="pays" class="text-sm font-semibold text-gray-600">Pays</label>
                    <input type="text" id="pays" name="pays" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Votre pays" required aria-required="true" aria-labelledby="pays">
                </div>
                <div class="flex-1 flex flex-col mt-4 sm:mt-0">
                    <label for="adresse" class="text-sm font-semibold text-gray-600">Adresse </label>
                    <input type="text" id="adresse" name="adresse" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Votre adresse" aria-labelledby="adresse">
                </div>
            </div>

            <!-- Numéro de téléphone -->
            <div class="flex flex-col">
                <label for="phone" class="text-sm font-semibold text-gray-600">Numéro de téléphone </label>
                <input type="text" id="phone" name="phone" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Numéro de téléphone" aria-labelledby="phone">
            </div>

            <!-- Case à cocher pour être un professionnel -->
            <div class="flex items-center">
                <input type="checkbox" id="isProfessional" name="isProfessional" class="mr-2" aria-labelledby="isProfessionalLabel">
                <label id="isProfessionalLabel" for="isProfessional" class="text-sm font-semibold text-gray-600">Je suis un professionnel</label>
            </div>

            <!-- Champs pour le professionnel (affiché si la case est cochée) -->
            <div id="companyFields" class="space-y-4 hidden">
                <div class="flex flex-col sm:flex-row sm:space-x-4">
                    <div class="flex-1 flex flex-col">
                        <label for="company_name" class="text-sm font-semibold text-gray-600">Nom de l'entreprise</label>
                        <input type="text" id="company_name" name="company_name" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Nom de l'entreprise" aria-labelledby="company_name">
                    </div>
                    <div class="flex-1 flex flex-col">
                        <label for="company_address" class="text-sm font-semibold text-gray-600">Adresse de l'entreprise</label>
                        <input type="text" id="company_address" name="company_address" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Adresse de l'entreprise" aria-labelledby="company_address">
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="company_phone" class="text-sm font-semibold text-gray-600">Numéro de téléphone de l'entreprise</label>
                    <input type="text" id="company_phone" name="company_phone" class="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2" placeholder="Numéro de téléphone de l'entreprise" aria-labelledby="company_phone">
                </div>

                <p class="text-xs text-gray-500 mt-2">Le processus pour être reconnu en tant qu'entreprise peut prendre un certain temps.</p>
            </div>

            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit" class="w-full bg-primary-green text-white py-3 rounded-md mt-4" aria-label="Soumettre le formulaire d'inscription">S'inscrire</button>

            <div class="mt-4 text-center">
                <a href="./login.php" class="text-sm text-primary-green hover:text-gray-600" aria-label="Page de connexion">Déjà un compte ? Connectez-vous</a>
            </div>
        </form>
    </div>

</main>


<script>
    // Logique pour afficher/masquer les champs d'entreprise selon la case à cocher
    const isProfessionalCheckbox = document.getElementById('isProfessional');
    const companyFields = document.getElementById('companyFields');

    isProfessionalCheckbox.addEventListener('change', () => {
        if (isProfessionalCheckbox.checked) {
            companyFields.classList.remove('hidden');
        } else {
            companyFields.classList.add('hidden');
        }
    });
</script>


<?php
require_once "./components/footer.php";
?>
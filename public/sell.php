<?php
require_once "./components/htmlstart.php";
require_once "./components/header.php";

if (!isset($_SESSION["user"])) {
    header("location: ./home.php");
    die();
}

$user = $_SESSION["user"];
$professionalDetails = $_SESSION["professionalDetails"];

$isProfessional = false;

if ($professionalDetails != null) {
    $isProfessional = true;
}
?>

<main class="bg-primary-beige min-h-screen flex items-center justify-center py-8">
    <div class="container max-w-lg mx-auto bg-neutral-off-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-primary-green mb-4 text-center">Create Annonce</h1>
        <form action="process_add_annonce.php" method="post" enctype="multipart/form-data">
            <div class="form-group mb-4">
                <label for="image" class="block text-primary-green text-sm font-bold mb-2">Images:</label>
                <input type="file" id="image" name="image[]" class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" multiple required onchange="previewImages(event)">
            </div>
            <div id="imagePreview" class="flex flex-wrap gap-2 mb-4"></div>

            <!-- Livesearch function -->
            <div class="form-group mb-4 relative">
                <label for="title" class="block text-primary-green text-sm font-bold mb-2">Nom du produit:</label>
                <input type="text" id="title" name="title" class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" placeholder="Nom du produit" onkeyup="showResult(this.value)" required>
                <div class="livesearch absolute top-full left-0 mt-2 w-full bg-neutral-900 shadow-lg p-4 space-y-4 hidden"></div>
            </div>


            <div class="form-group mb-4">
                <div class="form-group mb-4">
                    <label for="condition" class="block text-primary-green text-sm font-bold mb-2">Condition:</label>
                    <select id="condition" name="condition" class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="new">New</option>
                        <option value="like_new">Like new</option>
                        <option value="good">Good</option>
                        <option value="acceptable">Acceptable</option>
                        <option value="damaged">Damaged</option>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="author" class="block text-primary-green text-sm font-bold mb-2">Auteur:</label>
                    <input type="text" id="author" name="author" class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" placeholder="Auteur" required>
                </div>
                <label for="description" class="block text-primary-green text-sm font-bold mb-2">Description:</label>
                <textarea id="description" name="description" class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" placeholder="Description du produit" required></textarea>
            </div>
            <div class="form-group mb-4">
                <label for="price" class="block text-primary-green text-sm font-bold mb-2">Price:</label>
                <input type="number" id="price" name="price" class="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" placeholder="Prix en euros" required>
            </div>
            <div class="flex justify-end">
                <button class="px-4 py-2 bg-primary-green text-neutral-off-white font-semibold rounded-md hover:brightness-110" type="submit">Submit</button>
            </div>
        </form>
    </div>

</body>


</main>
    <?php
    require_once "./components/footer.php";
    ?>

<script>
    function previewImages(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'h-24 w-24 object-cover rounded-md';
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    }


    function showResult(texte) {
        if (texte.length == 0) {
            document.querySelector(".livesearch").innerHTML = "";
            document.querySelector(".livesearch").style.border = "0px";
            document.querySelector(".livesearch").classList.add('hidden');
            return;
        }

        document.querySelector(".livesearch").classList.remove('hidden');

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector(".livesearch").innerHTML = this.responseText;
                document.querySelector(".livesearch").style.border = "1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET", "../process/process_annoncesearch.php?q=" + texte, true);
        xmlhttp.send();
    }

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('livesearch-item')) {
            document.getElementById('title').value = event.target.dataset.title;
            document.getElementById('author').value = event.target.dataset.author;
            document.querySelector(".livesearch").classList.add('hidden');
        }
    });
</script>
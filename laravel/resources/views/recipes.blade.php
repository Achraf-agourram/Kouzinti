<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kouzinti - Toutes les recettes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        chef: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            500: '#f97316',
                            600: '#ea580c',
                            900: '#7c2d12',
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <i class="ph ph-cooking-pot text-3xl text-chef-500"></i>
                    <span class="font-bold text-2xl text-gray-900">Cui<span class="text-chef-500">Zone</span></span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/home" class="text-gray-500 hover:text-chef-600 transition">Accueil</a>
                    <a href="/recipes" class="font-medium text-chef-500 transition">Explorer</a>
                    <a href="/myrecipes" class="text-gray-500 hover:text-chef-500 transition">Mes Recettes</a>
                </div>

                <div class="flex items-center gap-4">
                    <button onclick="document.getElementById('addRecipeModal').showModal()" class="hidden md:flex items-center gap-2 bg-chef-500 text-white px-4 py-2 rounded-full hover:bg-chef-600 transition shadow-lg shadow-chef-500/30">
                        <i class="ph ph-plus-bold"></i> Créer une recette
                    </button>
                    <div class="h-10 w-10 text-center pt-1 rounded-full bg-green-200 border-2 border-white shadow overflow-hidden cursor-pointer" title="{{ auth()->user()->fullName }}">
                        {{ strtoupper(substr(auth()->user()->fullName, 0, 2)) }}
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <header class="relative bg-chef-50 pt-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            <form action="/searchRecipe" method="get" class="max-w-2xl mx-auto bg-white p-2 mb-2 rounded-full shadow-xl flex items-center border border-gray-100">
                <i class="ph ph-magnifying-glass text-xl text-gray-400 ml-4"></i>
                <input name="titleToSearch" type="text" placeholder="Rechercher une recette (ex: Lasagnes, Tiramisu...)" class="flex-1 p-3 outline-none text-gray-700 placeholder-gray-400 rounded-full">
                <button class="bg-gray-900 text-white px-6 py-3 rounded-full font-medium hover:bg-gray-800 transition">Chercher</button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" id="recettes">
        
        <div class="flex flex-wrap gap-3 mb-10 justify-center">
            <a href="/recipes" class="px-5 py-2 rounded-full bg-gray-900 text-white font-medium shadow-md">Tout voir</a>
            @foreach ($categories as $category)
                <a href="/category/{{ $category->categoryTitle }}" class="px-5 py-2 rounded-full bg-white text-gray-600 border border-gray-200 hover:border-chef-500 hover:text-chef-500 transition">{{ $category->categoryImage }} {{ $category->categoryTitle }}</a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($recipes as $recipe)
                <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 flex flex-col h-full relative group">
    
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $recipe->image }}" alt="{{ $recipe->recipeTitle }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                        
                        @if(auth()->user()->id == $recipe->user_id)
                            <div class="absolute top-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition duration-300">
                                <a href="editRecipe/{{ $recipe->id }}" 
                                class="p-2 bg-white/90 backdrop-blur text-chef-500 rounded-full shadow-md hover:bg-chef-500 hover:text-white transition-colors" 
                                title="Modifier la recette">
                                    <i class="ph-bold ph-pencil-simple"></i>
                                </a>

                                <form action="/deleteRecipe" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?');">
                                    @csrf
                                    <button type="submit" name="recipeToDelete" value="{{ $recipe->id }}"
                                            class="p-2 bg-white/90 backdrop-blur text-red-500 rounded-full shadow-md hover:bg-red-500 hover:text-white transition-colors" 
                                            title="Supprimer la recette">
                                        <i class="ph-bold ph-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-semibold text-chef-500 uppercase tracking-wide">{{ $recipe->category->categoryTitle }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $recipe->recipeTitle }}</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $recipe->recipeDescription }}</p>
                        
                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="text-xs text-center pt-1 w-6 h-6 rounded-full bg-yellow-200" title="{{ $recipe->user->fullName }}">
                                    {{ strtoupper(substr($recipe->user->fullName, 0, 2)) }}
                                </div>
                                <span class="text-xs font-medium text-gray-600">{{ $recipe->user->fullName }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-400 text-sm">
                                <span class="flex items-center gap-1 hover:text-chef-500 cursor-pointer">
                                    <i class="ph ph-chat-circle"></i> {{ $recipe->comments_count }}
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
            
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex items-center justify-center gap-2 mb-4">
                <i class="ph ph-cooking-pot text-2xl text-chef-500"></i>
                <span class="font-bold text-xl">Cui<span class="text-chef-500">Zone</span></span>
            </div>
            <p class="text-gray-400 text-sm mb-6">Partagez l'amour de la cuisine, un plat à la fois.</p>
        </div>
    </footer>

    <dialog id="addRecipeModal" class="p-0 rounded-2xl shadow-2xl backdrop:bg-gray-900/50 w-full max-w-lg open:animate-fade-in scroll-smooth">
        <div class="bg-white p-6 md:p-8 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Nouvelle Recette</h3>
                <button onclick="document.getElementById('addRecipeModal').close()" class="text-gray-400 hover:text-gray-600">
                    <i class="ph ph-x text-2xl"></i>
                </button>
            </div>
            
            <form action="/addRecipe" method="post" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Titre de la recette</label>
                    <input type="text" name="title" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none transition" placeholder="Ex: Gratin Dauphinois" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description de la recette</label>
                    <input type="text" name="description" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none transition" placeholder="Une petite description" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select name="category" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none bg-white">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->categoryTitle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image (URL)</label>
                        <input name="image" type="url" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none" placeholder="https://...">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ingrédients</label>
                    <div class="flex gap-2 mb-2">
                        <input list="ingredients-suggestions" id="ingredientInput" type="text" name="ingredients[]"
                            class="flex-1 border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none" 
                            placeholder="Ex: Tomates, Farine..." onkeypress="handleEnter(event, addIngredient)">
                        
                        <button type="button" onclick="addIngredient()" class="bg-gray-900 text-white px-4 rounded-lg hover:bg-gray-700 transition">
                            <i class="ph ph-plus font-bold"></i>
                        </button>
                    </div>

                    <datalist id="ingredients-suggestions">
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->ingredientTitle }}">
                        @endforeach
                    </datalist>

                    <div id="ingredientsList" class="flex flex-wrap gap-2 min-h-[40px] p-2 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <span class="text-gray-400 text-sm italic self-center px-2">Aucun ingrédient ajouté</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Étapes de préparation</label>
                    <div class="flex gap-2 mb-2">
                        <input id="stepInput" type="text" name="steps[]"
                            class="flex-1 border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none" 
                            placeholder="Décrivez l'étape ici..." onkeypress="handleEnter(event, addStep)">
                        
                        <button type="button" onclick="addStep()" class="bg-gray-900 text-white px-4 rounded-lg hover:bg-gray-700 transition">
                            <i class="ph ph-plus font-bold"></i>
                        </button>
                    </div>

                    <ol id="stepsList" class="list-decimal list-inside space-y-2 bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300 min-h-[60px]">
                        <span class="text-gray-400 text-sm italic px-2">Aucune étape ajoutée</span>
                    </ol>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="document.getElementById('addRecipeModal').close()" class="flex-1 py-3 text-gray-700 font-medium hover:bg-gray-100 rounded-lg transition">Annuler</button>
                    <button type="submit" class="flex-1 py-3 bg-chef-500 text-white font-bold rounded-lg hover:bg-chef-600 transition shadow-lg shadow-chef-500/30">Publier la recette</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>

        const ingredientInput = document.getElementById('ingredientInput');
        const ingredientsListContainer = document.getElementById('ingredientsList');
        let ingredients = [];

        function addIngredient() {
            const value = ingredientInput.value.trim();
            if (value) {
                ingredients.push(value);
                ingredientInput.value = '';
                renderIngredients();
                ingredientInput.focus();
            }
        }

        function removeIngredient(index) {
            ingredients.splice(index, 1);
            renderIngredients();
        }

        function renderIngredients() {
            ingredientsListContainer.innerHTML = '';
            if (ingredients.length === 0) {
                ingredientsListContainer.innerHTML = '<span class="text-gray-400 text-sm italic self-center px-2">Aucun ingrédient ajouté</span>';
                return;
            }

            ingredients.forEach((ing, index) => {
                const tag = document.createElement('div');
                tag.className = 'flex items-center gap-2 bg-chef-100 text-chef-900 px-3 py-1 rounded-full text-sm font-medium animate-fade-in';
                tag.innerHTML = `
                    <input type="text" class="bg-chef-100 outline-none" name="ingredients[]" value="${ing}" readonly>
                    <button type="button" onclick="removeIngredient(${index})" class="text-chef-500 hover:text-red-600">
                        <i class="ph-bold ph-x"></i>
                    </button>
                `;
                ingredientsListContainer.appendChild(tag);
            });
        }

        const stepInput = document.getElementById('stepInput');
        const stepsListContainer = document.getElementById('stepsList');
        let steps = [];

        function addStep() {
            const value = stepInput.value.trim();
            if (value) {
                steps.push(value);
                stepInput.value = '';
                renderSteps();
                stepInput.focus();
            }
        }

        function removeStep(index) {
            steps.splice(index, 1);
            renderSteps();
        }

        function renderSteps() {
            stepsListContainer.innerHTML = '';
            if (steps.length === 0) {
                stepsListContainer.innerHTML = '<span class="text-gray-400 text-sm italic px-2">Aucune étape ajoutée</span>';
                return;
            }

            steps.forEach((step, index) => {
                const li = document.createElement('li');
                li.className = 'flex justify-between items-start gap-3 p-2 bg-white rounded shadow-sm border border-gray-100 animate-fade-in group';
                li.innerHTML = `
                    <div class="flex gap-3">
                        <span class="bg-gray-900 text-white h-6 w-6 flex items-center justify-center rounded-full text-xs flex-shrink-0 mt-0.5">${index + 1}</span>
                        <input class="text-gray-700 bg-white text-sm outline-none" name="steps[]" value="${step}" readonly>
                    </div>
                    <button type="button" onclick="removeStep(${index})" class="text-gray-400 hover:text-red-500 opacity-0 group-hover:opacity-100 transition">
                        <i class="ph-bold ph-trash"></i>
                    </button>
                `;
                stepsListContainer.appendChild(li);
            });
        }

        function handleEnter(event, callback) {
            if (event.key === 'Enter') {
                event.preventDefault();
                callback();
            }
        }
    </script>
</body>
</html>
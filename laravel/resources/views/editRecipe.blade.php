<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la recette</title>
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
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <script>
        var ingredients = [];

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


    <div class="p-0 rounded-2xl shadow-2xl backdrop:bg-gray-900/50 w-full max-w-lg open:animate-fade-in scroll-smooth">
        <div class="bg-white p-6 md:p-8 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Modifier Recette</h3>
                <a href="/recipes" class="text-gray-400 hover:text-gray-600">
                    <i class="ph ph-x text-2xl"></i>
                </a>
            </div>
            
            <form action="/editRecipe" method="post" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Titre de la recette</label>
                    <input type="text" name="title" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none transition" placeholder="Ex: Gratin Dauphinois" value="{{ $recipeToEdit->recipeTitle }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description de la recette</label>
                    <input type="text" name="description" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none transition" placeholder="Une petite description" value="{{ $recipeToEdit->recipeDescription }}" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select name="category" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none bg-white">
                            <option value="{{ $recipeToEdit->category->id }}" selected>{{ $recipeToEdit->category->categoryTitle }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->categoryTitle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image (URL)</label>
                        <input name="image" type="url" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none" placeholder="https://..." value="{{ $recipeToEdit->image }}">
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
                        <script>
                            const ingredientInput = document.getElementById('ingredientInput');
                            const ingredientsListContainer = document.getElementById('ingredientsList');
                        </script>

                        @foreach ($recipeToEdit->ingredients as $ing)
                            <script>
                                ingredientInput.value = "{{ $ing->ingredientTitle }}";
                                addIngredient();
                            </script>
                        @endforeach
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
                        <script>
                            const stepInput = document.getElementById('stepInput');
                            const stepsListContainer = document.getElementById('stepsList');
                            var steps = [];
                        </script>

                        @foreach ($recipeToEdit->steps as $step)
                            <script>
                                stepInput.value = "{{ $step->stepDescription }}";
                                addStep();
                            </script>
                        @endforeach
                    </ol>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="document.getElementById('addRecipeModal').close()" class="flex-1 py-3 text-gray-700 font-medium hover:bg-gray-100 rounded-lg transition">Annuler</button>
                    <button type="submit" class="flex-1 py-3 bg-chef-500 text-white font-bold rounded-lg hover:bg-chef-600 transition shadow-lg shadow-chef-500/30">Publier la recette</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
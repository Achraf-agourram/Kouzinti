<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CuiZone - Partagez vos saveurs</title>
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
                    <a href="#" class="text-chef-600 font-medium">Accueil</a>
                    <a href="#recettes" class="text-gray-500 hover:text-chef-500 transition">Explorer</a>
                    <a href="#" class="text-gray-500 hover:text-chef-500 transition">Mes Recettes</a>
                </div>

                <div class="flex items-center gap-4">
                    <button onclick="document.getElementById('addRecipeModal').showModal()" class="hidden md:flex items-center gap-2 bg-chef-500 text-white px-4 py-2 rounded-full hover:bg-chef-600 transition shadow-lg shadow-chef-500/30">
                        <i class="ph ph-plus-bold"></i> Créer une recette
                    </button>
                    <div class="h-10 w-10 rounded-full bg-gray-200 border-2 border-white shadow overflow-hidden cursor-pointer">
                        <img src="https://ui-avatars.com/api/?name=Chef+User&background=random" alt="Profil">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <header class="relative bg-chef-50 pt-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                Révélez le <span class="text-transparent bg-clip-text bg-gradient-to-r from-chef-500 to-yellow-500">Chef</span> qui est en vous.
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-10">
                Rejoignez notre communauté de passionnés. Partagez vos créations, découvrez des saveurs inédites et échangez vos meilleures astuces.
            </p>

            <!--div class="max-w-2xl mx-auto bg-white p-2 rounded-full shadow-xl flex items-center border border-gray-100">
                <i class="ph ph-magnifying-glass text-xl text-gray-400 ml-4"></i>
                <input type="text" placeholder="Rechercher une recette (ex: Lasagnes, Tiramisu...)" class="flex-1 p-3 outline-none text-gray-700 placeholder-gray-400 rounded-full">
                <button class="bg-gray-900 text-white px-6 py-3 rounded-full font-medium hover:bg-gray-800 transition">Chercher</button>
            </div-->

            <div class="grid grid-cols-2 gap-4 pb-4 max-w-4xl mx-auto mt-12">
                <div class="bg-white/60 backdrop-blur p-4 rounded-xl border border-white shadow-sm">
                    <div class="text-2xl font-bold text-chef-600">{{ $recipesTotal }}</div>
                    <div class="text-sm text-gray-500">Recettes publiées</div>
                </div>
                <div class="bg-white/60 backdrop-blur p-4 rounded-xl border border-white shadow-sm">
                    <div class="text-2xl font-bold text-chef-600">850</div>
                    <div class="text-sm text-gray-500">Chefs actifs</div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" id="recettes">
        
        <div class="flex flex-wrap gap-3 mb-10 justify-center">
            <button class="px-5 py-2 rounded-full bg-gray-900 text-white font-medium shadow-md">Tout voir</button>
            @foreach ($categories as $category)
                <button class="px-5 py-2 rounded-full bg-white text-gray-600 border border-gray-200 hover:border-chef-500 hover:text-chef-500 transition">{{ $category->categoryImage }} {{ $category->categoryTitle }}</button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($recipes as $recipe)
                <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $recipe->image }}" alt="{{ $recipe->recipeTitle }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-semibold text-chef-500 uppercase tracking-wide">{{ $recipe->category->categoryTitle }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $recipe->recipeTitle }}</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $recipe->recipeDescription }}</p>
                        
                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="text-xs text-center pt-1 w-6 h-6 rounded-full bg-yellow-200" title="{{ $recipe->user->fullName }}">{{ strtoupper(substr($recipe->user->fullName, 0, 2)) }}</div>
                                <span class="text-xs font-medium text-gray-600">{{ $recipe->user->fullName }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-400 text-sm">
                                <span class="flex items-center gap-1 hover:text-chef-500 cursor-pointer"><i class="ph ph-chat-circle"></i>0</span>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
            
        </div>

        <div class="text-center mt-12">
            <button class="text-chef-600 font-medium hover:underline flex items-center justify-center mx-auto gap-2">
                Charger plus de recettes <i class="ph ph-arrow-down"></i>
            </button>
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

    <dialog id="addRecipeModal" class="p-0 rounded-2xl shadow-2xl backdrop:bg-gray-900/50 w-full max-w-lg open:animate-fade-in">
        <div class="bg-white p-6 md:p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Nouvelle Recette</h3>
                <button onclick="document.getElementById('addRecipeModal').close()" class="text-gray-400 hover:text-gray-600">
                    <i class="ph ph-x text-2xl"></i>
                </button>
            </div>
            
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Titre de la recette</label>
                    <input type="text" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none" placeholder="Ex: Gratin Dauphinois">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none bg-white">
                            <option>Entrée</option>
                            <option>Plat Principal</option>
                            <option>Dessert</option>
                            <option>Boisson</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image (URL)</label>
                        <input type="url" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none" placeholder="https://...">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ingrédients</label>
                    <textarea rows="3" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none" placeholder="- 200g de farine..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Étapes de préparation</label>
                    <textarea rows="4" class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-chef-500 outline-none" placeholder="1. Préchauffez le four..."></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="document.getElementById('addRecipeModal').close()" class="flex-1 py-3 text-gray-700 font-medium hover:bg-gray-100 rounded-lg transition">Annuler</button>
                    <button type="submit" class="flex-1 py-3 bg-chef-500 text-white font-bold rounded-lg hover:bg-chef-600 transition shadow-lg shadow-chef-500/30">Publier</button>
                </div>
            </form>
        </div>
    </dialog>

</body>
</html>
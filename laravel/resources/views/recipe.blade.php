<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Recette - Kouzinti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
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
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="/recipes" class="flex items-center gap-2">
                <i class="ph ph-arrow-left text-xl text-gray-500 hover:text-chef-500"></i>
                <span class="font-bold text-xl">Retour</span>
            </a>
            <div class="font-bold text-xl"><span class="text-chef-500">Kouzinti</span></div>
            <div class="w-10"></div> </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">{{ $recipe->recipeTitle }}</h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-6">
                {{ $recipe->recipeDescription }}
            </p>
        </div>

        <div class="relative w-full h-64 md:h-96 rounded-3xl overflow-hidden shadow-xl mb-12 group">
            <img src="{{ $recipe->image }}" 
                 class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Cheesecake">
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-16">
            
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="ph ph-basket text-chef-500"></i> Ingrédients
                    </h3>
                    <ul class="space-y-4">
                        @foreach ($recipe->ingredients as $ing)
                            <li class="flex items-start gap-3 pb-3 border-b border-gray-50 last:border-0">
                                <i class="ph-fill ph-check-circle text-chef-500 mt-1"></i>
                                <span class="text-gray-700">{{ $ing->ingredientTitle }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <i class="ph ph-cooking-pot text-chef-500"></i> Préparation
                </h3>
                
                <div class="space-y-8">
                    @foreach ($recipe->steps as $step)
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-chef-500 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-chef-500/20">{{ $step->stepOrder }} </div>
                            <div>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ $step->stepDescription }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <hr class="border-gray-200 my-12">

        <!--section class="max-w-3xl mx-auto" id="comments">
            <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-2">
                Discussion <span class="text-sm font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded-full">23</span>
            </h3>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-10 flex gap-4">
                <img src="https://ui-avatars.com/api/?name=User&background=random" class="w-10 h-10 rounded-full hidden sm:block">
                <div class="flex-1">
                    <textarea class="w-full border-gray-200 border rounded-xl p-4 focus:ring-2 focus:ring-chef-500 outline-none resize-none text-sm" rows="3" placeholder="Donnez votre avis sur cette recette..."></textarea>
                    <div class="flex justify-between items-center mt-3">
                        <span class="text-xs text-gray-400">Connecté en tant que <strong>Chef User</strong></span>
                        <button class="bg-gray-900 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-chef-500 transition">Publier</button>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                
                <article class="flex gap-4">
                    <img src="https://ui-avatars.com/api/?name=Sophie+L&background=random" class="w-10 h-10 rounded-full border border-white shadow-sm">
                    <div class="flex-1">
                        <div class="bg-gray-50 p-4 rounded-2xl rounded-tl-none">
                            <div class="flex justify-between items-baseline mb-1">
                                <h5 class="font-bold text-gray-900 text-sm">Sophie L.</h5>
                                <span class="text-xs text-gray-400">Il y a 2 heures</span>
                            </div>
                            <p class="text-gray-700 text-sm">Un vrai délice ! J'ai remplacé les fraises par des framboises et c'était tout aussi bon. Merci pour le partage !</p>
                        </div>
                        <div class="flex gap-4 mt-2 ml-2">
                            <button class="text-xs text-gray-500 hover:text-chef-500 font-medium">Répondre</button>
                            <button class="text-xs text-gray-500 hover:text-red-500 font-medium flex items-center gap-1">
                                <i class="ph ph-heart"></i> 5
                            </button>
                        </div>
                    </div>
                </article>

                <article class="flex gap-4">
                    <img src="https://ui-avatars.com/api/?name=Thomas+B&background=random" class="w-10 h-10 rounded-full border border-white shadow-sm">
                    <div class="flex-1">
                        <div class="bg-gray-50 p-4 rounded-2xl rounded-tl-none">
                            <div class="flex justify-between items-baseline mb-1">
                                <h5 class="font-bold text-gray-900 text-sm">Thomas B.</h5>
                                <span class="text-xs text-gray-400">Hier</span>
                            </div>
                            <p class="text-gray-700 text-sm">Est-ce qu'on peut utiliser du beurre demi-sel pour la base ?</p>
                        </div>
                         <div class="flex gap-4 mt-2 ml-2">
                            <button class="text-xs text-gray-500 hover:text-chef-500 font-medium">Répondre</button>
                            <button class="text-xs text-gray-500 hover:text-red-500 font-medium flex items-center gap-1">
                                <i class="ph ph-heart"></i> 1
                            </button>
                        </div>
                    </div>
                </article>

            </div>
            
            <div class="text-center mt-8">
                <button class="text-chef-600 text-sm font-medium hover:underline">Charger plus de commentaires</button>
            </div>
        </section-->

    </main>

</body>
</html>
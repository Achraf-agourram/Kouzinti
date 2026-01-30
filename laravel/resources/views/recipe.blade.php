<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Recette - CuiZone</title>
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
            <a href="index.html" class="flex items-center gap-2">
                <i class="ph ph-arrow-left text-xl text-gray-500 hover:text-chef-500"></i>
                <span class="font-bold text-xl">Retour</span>
            </a>
            <div class="font-bold text-xl">Cui<span class="text-chef-500">Zone</span></div>
            <div class="w-10"></div> </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="text-center mb-10">
            <span class="inline-block py-1 px-3 rounded-full bg-chef-100 text-chef-600 text-xs font-bold uppercase tracking-wide mb-3">
                🍰 Dessert
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">Cheesecake aux Fraises</h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-6">
                Le classique new-yorkais revisité avec un coulis de fraises fraîches du jardin et une base biscuitée croquante.
            </p>

            <div class="flex flex-wrap justify-center items-center gap-6 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name=Marc+D&background=random" class="w-8 h-8 rounded-full border border-gray-200">
                    <span class="font-medium text-gray-900">Par Marc D.</span>
                </div>
                <span class="hidden md:inline text-gray-300">|</span>
                <div class="flex items-center gap-1">
                    <i class="ph-fill ph-clock text-chef-500 text-lg"></i>
                    <span>45 min</span>
                </div>
                <div class="flex items-center gap-1">
                    <i class="ph-fill ph-users text-chef-500 text-lg"></i>
                    <span>4 Personnes</span>
                </div>
                <div class="flex items-center gap-1">
                    <i class="ph-fill ph-fire text-chef-500 text-lg"></i>
                    <span>Facile</span>
                </div>
            </div>
        </div>

        <div class="relative w-full h-64 md:h-96 rounded-3xl overflow-hidden shadow-xl mb-12 group">
            <img src="https://images.unsplash.com/photo-1565958011703-44f9829ba187?auto=format&fit=crop&w=1200&q=80" 
                 class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Cheesecake">
            
            <button class="absolute top-4 right-4 bg-white p-3 rounded-full shadow-lg text-gray-400 hover:text-red-500 transition hover:scale-110">
                <i class="ph-fill ph-heart text-2xl"></i>
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-16">
            
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="ph ph-basket text-chef-500"></i> Ingrédients
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 pb-3 border-b border-gray-50 last:border-0">
                            <i class="ph-fill ph-check-circle text-chef-500 mt-1"></i>
                            <span class="text-gray-700">200g de biscuits sablés</span>
                        </li>
                        <li class="flex items-start gap-3 pb-3 border-b border-gray-50 last:border-0">
                            <i class="ph-fill ph-check-circle text-chef-500 mt-1"></i>
                            <span class="text-gray-700">100g de beurre fondu</span>
                        </li>
                        <li class="flex items-start gap-3 pb-3 border-b border-gray-50 last:border-0">
                            <i class="ph-fill ph-check-circle text-chef-500 mt-1"></i>
                            <span class="text-gray-700">600g de fromage frais</span>
                        </li>
                        <li class="flex items-start gap-3 pb-3 border-b border-gray-50 last:border-0">
                            <i class="ph-fill ph-check-circle text-chef-500 mt-1"></i>
                            <span class="text-gray-700">150g de sucre en poudre</span>
                        </li>
                        <li class="flex items-start gap-3 pb-3 border-b border-gray-50 last:border-0">
                            <i class="ph-fill ph-check-circle text-chef-500 mt-1"></i>
                            <span class="text-gray-700">3 oeufs</span>
                        </li>
                        <li class="flex items-start gap-3 pb-3 border-b border-gray-50 last:border-0">
                            <i class="ph-fill ph-check-circle text-chef-500 mt-1"></i>
                            <span class="text-gray-700">250g de fraises</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <i class="ph ph-cooking-pot text-chef-500"></i> Préparation
                </h3>
                
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-chef-500 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-chef-500/20">1</div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Préparer la base</h4>
                            <p class="text-gray-600 leading-relaxed">
                                Émiettez les biscuits sablés dans un bol. Ajoutez le beurre fondu et mélangez jusqu'à obtenir une texture sableuse humide. Tassez ce mélange au fond d'un moule à charnière.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-chef-500 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-chef-500/20">2</div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">La crème</h4>
                            <p class="text-gray-600 leading-relaxed">
                                Dans un grand saladier, battez le fromage frais avec le sucre jusqu'à ce que le mélange soit lisse. Ajoutez les œufs un par un en mélangeant bien entre chaque ajout.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-chef-500 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-chef-500/20">3</div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Cuisson</h4>
                            <p class="text-gray-600 leading-relaxed">
                                Versez la préparation sur la base biscuitée. Enfournez à 160°C pendant 50 minutes. Laissez refroidir complètement avant de démouler. Ajoutez les fraises sur le dessus avant de servir.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-gray-200 my-12">

        <section class="max-w-3xl mx-auto" id="comments">
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
        </section>

    </main>

</body>
</html>
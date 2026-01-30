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

        <section class="max-w-3xl mx-auto" id="comments">
            <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-2">
                Discussion <span class="text-sm font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ $recipe->comments_count }}</span>
            </h3>

            <form method="post" action="/addComment" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-10 flex gap-4">
                @csrf
                <div class="h-10 w-10 text-white text-center pt-1 rounded-full bg-blue-500 border-2 border-white shadow overflow-hidden cursor-pointer" title="{{ auth()->user()->fullName }}">
                        {{ strtoupper(substr(auth()->user()->fullName, 0, 2)) }}
                </div>
                <div class="flex-1">
                    <textarea name="comment" class="w-full border-gray-200 border rounded-xl p-4 focus:ring-2 focus:ring-chef-500 outline-none resize-none text-sm" rows="3" placeholder="Donnez votre avis sur cette recette..."></textarea>
                    <div class="flex justify-between items-center mt-3">
                        <span class="text-xs text-gray-400">Connecté en tant que <strong>{{ auth()->user()->fullName }}</strong></span>
                        <button name="recipeToComment" value="{{ $recipe->id }}" class="bg-gray-900 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-chef-500 transition">Publier</button>
                    </div>
                </div>
            </form>

            <div class="space-y-8">
                
                @foreach ($recipe->comments as $comment)
                    <div class="flex gap-4" id="comment-{{ $comment->id }}">
                        <div class="h-10 w-10 text-white text-center pt-1 rounded-full bg-blue-500 border-2 border-white shadow overflow-hidden cursor-pointer" title="{{ auth()->user()->fullName }}">
                            {{ strtoupper(substr($comment->user->fullName, 0, 2)) }}
                        </div>
                        <div class="flex-1">
                            <div class="bg-gray-50 p-4 rounded-2xl rounded-tl-none">
                                <div class="flex justify-between items-baseline mb-1">
                                    <h5 class="font-bold text-gray-900 text-sm">{{ $comment->user->fullName }}</h5>
                                </div>
                                <p class="text-gray-700 text-sm" id="comment-text-{{ $comment->id }}">{{ $comment->commentContent }}</p>

                                <form action="/editComment" method="post" id="edit-form-{{ $comment->id }}" class="hidden mt-2">
                                    @csrf
                                    <input type="hidden" name="recipeToEdit" value="{{ $recipe->id }}">
                                    <textarea name="editedComment" rows="2" class="w-full bg-white border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-chef-500 outline-none">{{ $comment->content }}</textarea>
                                    <div class="flex justify-end gap-2 mt-2">
                                        <button type="button" onclick="toggleEdit('{{ $comment->id }}')" class="text-xs text-gray-500 hover:text-gray-700">Annuler</button>
                                        <button type="submit" name="commentToEdit" value="{{ $comment->id }}" class="text-xs bg-chef-500 text-white px-3 py-1 rounded-md hover:bg-chef-600">Enregistrer</button>
                                    </div>
                                </form>
                            </div>

                            @if ($comment->user->id === Auth::id())
                                <div class="flex justify-between items-center mt-2 ml-2">

                                    <div class="flex gap-3 opacity-100 transition-opacity duration-200">
                                        
                                        <button type="button" onclick="toggleEdit('{{ $comment->id }}')" class="text-xs text-gray-400 hover:text-chef-500 flex items-center gap-1" title="Modifier">
                                            <i class="ph-bold ph-pencil-simple"></i>
                                        </button>

                                        <form method="post" action="/deleteComment" onsubmit="return confirm('Supprimer ce commentaire ?');">
                                            @csrf
                                            <input type="hidden" name="recipeToDelete" value="{{ $recipe->id }}">
                                            <button type="submit" name="commentToDelete" value="{{ $comment->id }}" class="text-xs text-gray-400 hover:text-red-600 flex items-center gap-1" title="Supprimer">
                                                <i class="ph-bold ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach


            </div>
        </section>

    </main>

    <script>
        function toggleEdit(commentId) {
            const textElement = document.getElementById(`comment-text-${commentId}`);
            const formElement = document.getElementById(`edit-form-${commentId}`);
            
            if (formElement.classList.contains('hidden')) {
                textElement.classList.add('hidden');
                formElement.classList.remove('hidden');
                formElement.querySelector('textarea').focus();
            } else {
                textElement.classList.remove('hidden');
                formElement.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
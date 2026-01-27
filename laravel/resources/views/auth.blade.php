<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Kouzinti</title>
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
<body class="bg-gray-50 h-screen w-full flex overflow-hidden font-sans">

    <div class="hidden md:flex w-1/2 bg-chef-900 relative justify-center items-center overflow-hidden">
        
        <div class="relative z-10 text-center text-white px-10">
            <i class="ph ph-cooking-pot text-6xl mb-4 text-chef-500"></i>
            <h2 class="text-4xl font-bold mb-4">Rejoignez Kouzinti</h2>
            <p class="text-lg text-gray-200">Partagez vos recettes, inspirez les autres et construisez votre carnet de cuisine numérique.</p>
        </div>
    </div>

    <div class="w-full md:w-1/2 flex flex-col justify-center items-center bg-white p-8 md:p-12 overflow-y-auto">
        
        <div class="md:hidden mb-8 text-center">
            <div class="flex items-center justify-center gap-2 text-chef-500">
                <i class="ph ph-cooking-pot text-3xl"></i>
                <span class="font-bold text-2xl text-gray-900">Cui<span class="text-chef-500">Zone</span></span>
            </div>
        </div>

        <div class="w-full max-w-md space-y-8">
            
            <div id="login-box" class="animate-fade-in">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900">Bon retour parmi nous !</h2>
                    <p class="mt-2 text-sm text-gray-600">Entrez vos identifiants pour accéder à vos recettes.</p>
                </div>

                <form class="mt-8 space-y-6" method="post" action="/login">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Adresse Email</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ph ph-envelope text-gray-400"></i>
                                </div>
                                <input type="email" name="email" id="email" required class="pl-10 block w-full border-gray-300 border rounded-lg p-3 focus:ring-chef-500 focus:border-chef-500 outline-none sm:text-sm" placeholder="chef@exemple.com">
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between">
                                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            </div>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ph ph-lock-key text-gray-400"></i>
                                </div>
                                <input type="password" name="password" id="password" required class="pl-10 block w-full border-gray-300 border rounded-lg p-3 focus:ring-chef-500 focus:border-chef-500 outline-none sm:text-sm" placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-chef-500 hover:bg-chef-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-chef-500 transition shadow-lg shadow-chef-500/30">
                        Se connecter
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Pas encore de compte ?
                    <button onclick="toggleForms()" class="font-medium text-chef-600 hover:text-chef-500">
                        Créer un compte gratuitement
                    </button>
                </p>
            </div>

            <div id="register-box" class="hidden animate-fade-in">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900">Créer un compte</h2>
                    <p class="mt-2 text-sm text-gray-600">Commencez votre voyage culinaire dès aujourd'hui.</p>
                </div>

                <form class="mt-8 space-y-4" method="post" action="/register">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input type="text" name="fullName" required class="mt-1 block w-full border-gray-300 border rounded-lg p-3 focus:ring-chef-500 focus:border-chef-500 outline-none" placeholder="Paul Bocuse">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Adresse Email</label>
                        <input type="email" name="email" required class="mt-1 block w-full border-gray-300 border rounded-lg p-3 focus:ring-chef-500 focus:border-chef-500 outline-none" placeholder="chef@exemple.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" name="password" required class="mt-1 block w-full border-gray-300 border rounded-lg p-3 focus:ring-chef-500 focus:border-chef-500 outline-none" placeholder="••••••••">
                        <p class="text-xs text-gray-500 mt-1">Au moins 8 caractères</p>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-chef-500 hover:bg-chef-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-chef-500 transition shadow-lg shadow-chef-500/30">
                        S'inscrire
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Déjà membre ?
                    <button onclick="toggleForms()" class="font-medium text-chef-600 hover:text-chef-500">
                        Se connecter
                    </button>
                </p>
            </div>

        </div>
    </div>

    <script>
        function toggleForms() {
            const loginBox = document.getElementById('login-box');
            const registerBox = document.getElementById('register-box');

            if (loginBox.classList.contains('hidden')) {
                // Afficher Login
                loginBox.classList.remove('hidden');
                registerBox.classList.add('hidden');
            } else {
                // Afficher Register
                loginBox.classList.add('hidden');
                registerBox.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
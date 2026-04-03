<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement réussi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <div class="text-green-600 text-6xl mb-4">✓</div>
        <h1 class="text-2xl font-bold mb-2">Paiement réussi !</h1>
        <p class="text-gray-600 mb-4">Merci pour votre achat.</p>
        <a href="{{ url('/') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Retour à l'accueil</a>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement annulé</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <div class="text-red-600 text-6xl mb-4">✗</div>
        <h1 class="text-2xl font-bold mb-2">Paiement annulé</h1>
        <p class="text-gray-600 mb-4">Vous avez annulé la transaction.</p>
        <a href="{{ route('payment.form') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Réessayer</a>
    </div>
</body>
</html>
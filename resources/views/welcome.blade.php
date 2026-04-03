
</html><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement en ligne</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Effectuer un paiement</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payment.process') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="amount" class="block text-gray-700 font-medium mb-2">Montant *</label>
                <input type="number" name="amount" id="amount" step="1" min="100"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('amount') }}" required>
                <p class="text-sm text-gray-500 mt-1">Montant minimum : 100 (FCFA)</p>
            </div>

            <div class="mb-4">
                <label for="currency" class="block text-gray-700 font-medium mb-2">Devise *</label>
                <select name="currency" id="currency"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="XOF">XOF (Franc CFA)</option>
                    <option value="XAF">XAF (Franc CFA)</option>
                    <option value="CDF">CDF (Franc congolais)</option>
                    <option value="GNF">GNF (Franc guinéen)</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium mb-2">Téléphone</label>
                <input type="text" name="phone" id="phone"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('phone') }}" placeholder="Ex: 22997000000">
                <p class="text-sm text-gray-500 mt-1">Requis pour un paiement Mobile Money</p>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('email') }}" placeholder="exemple@domaine.com">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="2"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                Procéder au paiement
            </button>
        </form>
    </div>
</body>
</html>